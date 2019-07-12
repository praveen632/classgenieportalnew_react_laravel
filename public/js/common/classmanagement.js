var myApp = angular.module("myApp", ['base64','angularUtils.directives.dirPagination']);
myApp.directive('fileReader', function () {
    return {
        scope: {
            fileReader: "="
        },
        link: function (scope, element) {
            $(element).on('change', function (changeEvent) {
                var files = changeEvent.target.files;
                if (files.length) {
                    var r = new FileReader();
                    r.onload = function (e) {
                        var contents = e.target.result;
                        // console.log(e);
                        var csvval = e.target.result.split("\n");
                        //$rootScope.scvData = csvval;              
                        scope.$apply(function () {
                            scope.fileReader = csvval;
                        });
                    };
                    r.readAsText(files[0]);
                }
            });
        }
    };
});

myApp.controller('classmanagement', function ($scope, $http, $sce, $compile, $base64, $element, $attrs) {
    $scope.choices = [{id: 'choice1'}];
    $scope.pageCount = 1; 
    var page_size = 5;  


    loadStudentList = function(classId,classname){
        //loader.block = '#allList';
        
        $http.get('/studentListPortal?page_number='+$scope.pageCount+'&classId='+classId).then(function (response) {     
                       $scope.status_success = response.data.status;  
                       $scope.totalLength = (response.data.studentList).length; 
                       console.log($scope.totalLength);                                   
                    if (((response.data.studentList).length) > 0) {
                        $scope.students = response.data.studentList;  
                        $scope.class_name_students =  classname;                 
                        $scope.reslength = (response.data.studentList).length;
                        
                    }  
                })

    }

    $scope.classmanage = function () {
        $scope.member_number = $('#member_no').val();
        var data = {
            class_name: $scope.className,
            grade: $scope.grade,
            teacher_ac_no: $('#member_no').val(),
            
        };
        if ($("#classmanagement").valid()) {
            $http.post('/add_class', data).then(function (response) {
                if (response.data.status == 'Failure') {
                    alert('You cannot add more than 10 classes');
                    $('#className').val('');
                    $('#grade').val('');
                } else if (response.data.status == 'Success') {
                    $('#className').val('');
                    $('#grade').val('');
                    $(".alert").html('Class added successfully').show().delay(2000).fadeOut();
                    $scope.classlist($scope.member_number);
                } else {
                    $('#className').val('');
                    $('#grade').val('');
                    $(".alert").html(response.data.status).show().delay(2000).fadeOut();
                    return false;
                } 
            }, function (error_response) {
                console.log(error_response);
                $('#className').val('');
                $('#grade').val('');
            });
        }
    },
            // To  Get class List 
            $scope.classlist = function (member_no) {
                $('#hideandshow').hide();                
                $http.get(api_url + 'classinfo/dashboard?token=aforetechnical@321!&teacher_ac_no=' + member_no + '').then(function (response) {
 
                    if (((response.data.user_list).length) > 0) {
                        var reslength = (response.data.user_list).length;
                        var ids = response.data.user_list[0].id;
                        var td = '<div id="class_hide_show"> <h3>Class List</h3> <table class="table table-striped table-responsive table-hover" ng-controller="classmanagement"><thead>';
                        td += '<tr><th>Class Name</th><th>Grade</th><th>Status</th><th>Upload CSV</th><th>Student List</th></tr></thead><tbody>';
                        for (var i = 0; i < reslength; i++) {
                            var t = response.data.user_list[i].class_id;
                            $scope.classId = t;
                            $scope.classname = response.data.user_list[i].class_name;
                            //alert(t);return; ng-click = "studentList()
                            td += '<tr><td>' + response.data.user_list[i].class_name
                            td += '</td>';
                            td += '<td>' + (response.data.user_list[i].grade)
                            td += '<td>' + '<a href="javascript:void(0);" onclick = add_student("' + t + '","' + $scope.classname + '")>Add Student</a>'
                            td += '</td>'
                            td += '<td>' + '<a href="javascript:void(0);" onclick = addstudent("' + t + '","' + $scope.classname + '")>Upload CSV</a>'
                            td += '<td>' + '<a href="javascript:void(0);" onclick = studentList("' + t + '","' + $scope.classname + '")>View</a>'                           
                            td += '</td>'
                            td += '</td><tr>';
                        }
                        td += '</tbody></table></div>';
                        $('div#allList').html(td);
                        $('#load_more').hide();
                    } else {
                         $('#allList').html('<table class="table table-striped table-responsive" style="margin-top: 22px;"><tr><td style="text-align:center;">Recods not found!</td></tr></table>');   
                   
                    }
                })

            }

/* get student list */
 
studentList = function (classId,classname) {
    loadStudentList(classId,classname);
    $scope.showStatus = "show";
// console.log(classId+''+classname);
     $scope.classi = classId;
     $scope.classn = classname;
     $('#class_hide_show').hide();
     setTimeout(function() {
    $("#hideandshow").show()
}, 500);
//$('#hideandshow').fadeIn();



} 


            

//insert student through csv upload
    addstudent = function (id,classname) {
        $('#hideandshow').hide();
        var data = {
            id: id,
             classname:classname
        };
        $http.post('/upload_studentlist', data).then(function (response) {
            if (response.data != "") {
                // alert(response.data);//return;
                $scope.studentlist = response.data;
                $('div#allList').html('<br>' + $scope.studentlist);
                $compile($("div#allList"))($scope);
            }
        },
                function (error_response) {
                    console.log(error_response);

                });

    };
//insert student through text box one by one

    add_student = function (id,classname) {
         $('#hideandshow').hide();
        var data = {
            id: id,
            classname:classname
        };
        $http.post('/add_student', data).then(function (response) {
            if (response.data != "") {
                $scope.studentlist = response.data;
                $('div#allList').html('<br>' + $scope.studentlist);
                $compile($("div#allList"))($scope);
            }
        },
                function (error_response) {
                    console.log(error_response);

                });

    };

    /*funtion to add multiple students  here       */
    $scope.addMultipleStudent = function () { 
        $('#hideandshow').hide();
        $scope.data1 = [];
        $scope.students = [];
        for (var i = 0; i < $scope.choices.length; i++) {
            $scope.data1.push({name: $scope.choices[i].name, class_id: $('#classId').val()});
            $scope.students.push($scope.choices[i].name);
        }
         var sorted_arr = $scope.students.sort();  
         var results = [];  
        for (var i = 0; i < sorted_arr.length - 1; i++) {  
            if (sorted_arr[i + 1] == sorted_arr[i]) {  
                results.push(sorted_arr[i]);  
            }  
        } 
        if(results.length > 0){ 
        alert("Duplicate value:  " + results + ' ' + 'are not allowed');  
        return false;
    }
        var data1 = JSON.stringify($scope.data1);
        ajaxloader.loadURL(api_url + 'addstudent/multiple?token=aforetechnical@321!', {data: data1}, function (res) {
              
            if (res.status == 'Failure') {
                alert("Sorry! " + res.names + ' name are already exist'); 
                return false;
            } else if (res.status == 'Success') {               
                var msg = 'Students added Successfully';
                alert($('input.form-control').val());
                $(".alert").html(msg);
                $(".alert").show().delay(500).fadeOut();
                $('#student_hide').hide();
                studentList($('#classId').val(),$('#classname').val());
                              
              }
        }, function (error_response) {
            console.log(error_response);
            $('#teacher_name').val();
        });

    }


    $scope.check_unique_student = function(){
          var student_arr = [];
          for (var i = 0; i < $scope.choices.length; i++) {
            student_arr.push($scope.choices[i].name);
        }
        for (var i = 0; i < student_arr.length; i++) {
            if(student_arr[i+1] === student_arr[i]){

            }
        }


    }



    



    /*funtion to add more text fields here       */
    $scope.addNewChoice = function () {
        var newItemNo = $scope.choices.length + 1;
        if (newItemNo > 9) {
            alert('You can add only 10 fields');
            return false;
        }
        $scope.choices.push({'id': 'choice' + newItemNo});        

    };

    /*funtion to remove text fields here       */
    $scope.removeChoice = function () {
        var lastItem = $scope.choices.length - 1;
        if (lastItem == 0) {
            alert('Add atleast one field');
            return false;
        }
        $scope.choices.splice(lastItem);
    };

    /* protoType function to remove duplicacy from array*/
    Array.prototype.unique= function ()
    {
    return this.reduce(function(previous, current, index, array)
    {
      previous[current.toString()+typeof(current)]=current;
     return array.length-1 == index ? Object.keys(previous).reduce(function(prev,cur)
       {
          prev.push(previous[cur]);
          return prev;
       },[]) : previous;
   }, {});
    };


    function findDuplicates(data) { 
        var result = [];
        data.forEach(function(element, index) {   
            if (data.indexOf(element, index + 1) > -1) {     
                if (result.indexOf(element) === -1) {
                    result.push(element);
                }
            }
        }); 
        return result;
    }
 
    $scope.uploadCsv = function () {
        $('#hideandshow').hide();
        var arr = [];
        var fileData = $scope.fileContent;
        var classId = $('#classId').val();
        if (typeof fileData != "undefined") {
            var duplicateData = findDuplicates(fileData);
            var fileData  = fileData.unique();
            if(duplicateData.length > 1){
                values = 'values';
            }else{
             values = 'value';
         }
            if(duplicateData.length > 0){
                alert(duplicateData.toString() + ' '+values+ ' are duplicates first remove then upload.');  
               return false;
           }else{
            if (fileData.length > 0) {                
                angular.forEach(fileData, function (value, key) {                     
                    if (value != "") {
                        arr.push({name: value, class_id: classId});
                    }
                });
                var data1 = JSON.stringify(arr);                
                ajaxloader.loadURL(api_url + 'addstudent/multiple?token=aforetechnical@321!', {data: data1}, function (res) {
                    //var resp = JSON.parse(resp);
                    //console.log(res);
                    if (res.status == 'Failure') {
                        alert("Sorry! " + res.names + ' name are already exist'); 
                        return false;
                    } else if (res.status == 'Success') {
                        var msg = 'List data added Successfully';
                        $(".alert").html(msg);
                        $(".alert").show().delay(500).fadeOut();
                        $('#upload_csv_hide').hide();
                        studentList($('#classId').val(),$('#classname').val());
                    }
                }, function (error_response) {
                    console.log(error_response);
                    $('#teacher_name').val();
                });

            }
        }
    } else {
        alert('Please upload csv file.');
        return false;
    }

}

});







