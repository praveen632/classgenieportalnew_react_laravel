var myApp = angular.module("myApp", []);
myApp.controller('changepasswordController', function ($scope,$window, $http, $timeout) {

//change password
    $scope.change_password = function () {
        var data = {
            password: $('#currpassword').val(),
            newpassword: $('#newpassword').val(),
            confirmpassword: $('#cfmpassword').val(),
            member_no: $('#member_no').val()
        };

        
            $http.post('/change_password', data).then(function (response) {
                if (response.data.status == 'Failure') {
                    alert('password not match');
                    $('#newpassword').val('');
                    $('#cfmpassword').val('');
                    $('#currpassword').val('');
                } else if (response.data.status == 'Success') {
                    var msg = 'Profile changed Successfully';
                    $(".alert").html(msg);
                    $(".alert").show().delay(500).fadeOut();
                     $('#newpassword').val('');
                    $('#cfmpassword').val('');
                    $('#currpassword').val('');
                }
            }, function (error_response) {
                $('#newpassword').val('');
                $('#cfmpassword').val('');
                $('#currpassword').val('');
            });
        
    },
            /*function to upload image here*/
            $scope.thumbnail = {
                dataUrl: 'adsfas'
            };
    $scope.fileReaderSupported = window.FileReader != null;
    $scope.photoChanged = function (files) {
        $scope.img = true;
        if (files != null) {
            var file = files[0];
            if ($scope.fileReaderSupported && file.type.indexOf('image') > -1) {
                $timeout(function () {
                    var fileReader = new FileReader();
                    fileReader.readAsDataURL(file);
                    fileReader.onload = function (e) {
                        $timeout(function () {
                            $scope.thumbnail.dataUrl = e.target.result;
                        });
                    }
                });
            }
        }
    };


    //Edit Profile
    $scope.change_profile = function () {

        var imageData = $scope.thumbnail.dataUrl;
        var data = {
            teacher_name: $('#teacher_name').val(),
            age: $('#age').val(),
            memberno: $('#member_no').val(),
            image: imageData
        };
        loader.block = '#loader_container';
        loader.position = 'bottom';
        loader.mode = 'block';
        if ($('#edit_profile').valid()) {
        ajaxloader.loadURL('/img_upload',data, function (res) {
             if (res.status == 'Failure') {
                alert('Something went wrong');
                $('#teacher_name').val();
            } else if (res.status == 'Success') {                
                var msg = 'Profile changed Successfully';
                $(".alert").html(msg);
                $(".alert").show().delay(500).fadeOut();
                $window.location.reload();
            }
        }, function (error_response) {
            $('#teacher_name').val();
        });
         }
    }


    /*...............change school info..........*/
    
    $scope.changeSchoolInfo = function () {
        if ($("#schoolinfo").valid()){ 
        if (typeof $('#school_name').val() != 'undefined') {
            var school_name = $('#school_name').val();
        }

        if (typeof $('#web_url').val() != 'undefined') {
            var web_url = $('#web_url').val();
        }

        if (typeof $('#school_id').val() != 'undefined') {
            var school_id = $('#school_id').val();
        }

        if (typeof $('#school_address').val() != 'undefined') {
            var school_address = $('#school_address').val();
        }

        if (typeof $('#school_city').val() != 'undefined') {
            var school_city = $('#school_city').val();
        }

        if (typeof $('#school_state').val() != 'undefined') {
            var school_state = $('#school_state').val();
        }

        if (typeof $('#school_country').val() != 'undefined') {
            var school_country = $('#school_country').val();
        }

        if (typeof $('#pin_code').val() != 'undefined') {
            var pin_code = $('#pin_code').val();
        }

        if (typeof $('#school_phone').val() != 'undefined') {
            var school_phone = $('#school_phone').val();
        }

        var data = {
            school_name: school_name,
            web_url: web_url,
            address: school_address,
            city: school_city,
            state: school_state,
            country: school_country,
            pincode: pin_code,
            phone: school_phone,
            school_id: school_id
        }; 
        ajaxloader.loadURL(api_url+'schools/school_update?token=aforetechnical@321!', data, function (res) {
            //var resp = JSON.parse(resp);

            if (res.status == 'Failure') {
                alert('Something went wrong');
                $('#teacher_name').val();
            } else if (res.status == 'Success') {
                var msg = 'School info updated Successfully';
                $(".alert").html(msg);
                $(".alert").show().delay(500).fadeOut();
            }
        }, function (error_response) {
           $('#teacher_name').val();
        });

    }
}

});