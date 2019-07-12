var myApp = angular.module("myApp", []);
myApp.controller('teacherManageController', function ($scope, $location, $http, $window, $timeout) {

    /*function to delete teacher...................*/
    $scope.teacher_delete = function (teacher_id) {
        var data = {
            teacher_id: teacher_id
        };
        var r = confirm("Are you sure wants to delete?");       
        if (r === true) {
            $http.post('/remove_teacher', data).then(function (response) {
                if (response.data.status == 'Failure') {
                    alert('Something went wrong');
                    //$('#teacher_name').val();
                } else if (response.data.status == 'Success') {
                    var msg = 'Teacher deleted Successfully';
                    $(".alert").html(msg);
                    $(".alert").show().delay(500).fadeOut();
                    $window.location.href = '/teachermanagement';
                }
            }, function (error_response) {
                console.log(error_response);
            });
        }
    },
            /*function to change status of teacher...................*/
            $scope.change_status = function (member_no, flag) {
                var data = {
                    member_no: member_no,
                    flag: flag
                };
                 $http.post('/change_status', data).then(function (response) {
                   
                    if (response.data.status == 'Failure') {
                        alert('Something went wrong');
                        //$('#teacher_name').val();
                    } else if (response.data.status == 'Success') {
                        var msg = 'Status changed Successfully';
                        $(".alert").html(msg);
                        $(".alert").show().delay(500).fadeOut();
                        $window.location.href = '/teachermanagement';
                    }
                }, function (error_response) {
                    console.log(error_response);
                    //$('#teacher_name').val();
                });


            },
            /*function to get teacher details...................*/

            $scope.getDataById = function (teacherId) {
                var data = {
                    teacher_id: teacherId
                };
                $http.post('/getTeacherById', data).then(function (response) {                    
                    if (response.data.status == 'Success') {
                        if (response.data.userDetails[0].status == '1') {
                            var status = 'Active';
                        } else {
                            var status = 'Deactive';
                        }
                        $scope.teacher_name = response.data.userDetails[0].name;
                        $scope.email = response.data.userDetails[0].email;
                        $scope.schoolId = response.data.userDetails[0].school_id;
                        $scope.member_number = response.data.userDetails[0].member_no;
                        $scope.status = status;
                        $scope.hiddenValue = teacherId;
                        $scope.type = response.data.userDetails[0].type;
                    } else if (response.data.statusText == 'ok') {

                        console.log(response.data.statusText);
                    }
                }, function (error_response) {
                    console.log(error_response);
                    //$('#teacher_name').val();
                });
            },
            /*function to update role of user...................*/

            $scope.saveDetails = function () {
                var data = {
                    type: $scope.type,
                    id: $scope.hiddenValue,
                    school_id: $scope.schoolId
                }
                $http.post('/updateTeacherById', data).then(function (response) {
                    if (response.data.userStatus == 'exist') {
                        $scope.exist = 'exist';
                        $('#profileMessage1').show();
                        $scope.message = 'User type already exist for this school!';
                        return false;
                    } else {
                        $('#profileMessage1').hide();
                        $('#profileMessage').show();
                        $scope.message = 'User type updated successfully';
                        $window.location.href = '/teachermanagement';

                    }


                }, function (error_response) {
                    console.log(error_response);
                    //$('#teacher_name').val();
                });
            }


});