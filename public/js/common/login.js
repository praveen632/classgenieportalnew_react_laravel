var myApp = angular.module("myApp", []);
 myApp.controller('signupController', function($scope, $http) {
         // signup


         $scope.submitSignup = function(){
             var txtAllowSearch = $('#txtAllowSearch').val();
             var data = { 
                        name:$('#name').val(),
                        email:$('#email_signup').val(),
                        password:$('#password_signup').val(),
                        phone:$('#phone').val(),
                        usertype:$('#role').val(),
                        school:$('#txtAllowSearch').val()
                       }
                              
           if ($("#signup").valid()){    
             // check school is valid or not
             if($('#txtAllowSearch').val() == ""){
              alert('Please Add school in School List');
              $('#school').val('');
              return false;
             }          
                    
             $http.post('/signup', data).then(function(response){ 
              if(response.data.status == 'Failure'){
                 alert('Email already Exist');
                 $('#email_signup').val('');
              }else if(response.data.status == 'Success') {
                 window.location.assign("/accountsetting");
                 //window.location.href = ("/accountsetting");
              }
         }, function (error_response){
             console.log(error_response);
             $('#email').val('');
         });
      }
    }


    $scope.checkUser = function(){
      var data = {
        'role':$('#role').val(),
        'school_id':$('#txtAllowSearch').val()
    }
    if($('#role').val() == 1){
      var textd = 'Principal';
    }else{
       var textd = 'Vice principal';
    }
   $http.post('/checkUser', data).then(function(response){
              if(response.data.status == 'Failure'){                
              }else if(response.data.status == 'success') {                
               if(response.data.existStatus == 'exist'){
               $('#school-error').show().html(textd+' already exist for this school!');
               $('#school').val('');
               $('#role').val('');
               $('#txtAllowSearch').val('');
               }else{
                $('#school-error').hide();
               }
              }
         }, function (error_response){
            
             
         });
    }

    /* Auto complete for country list*/

    $scope.getAutoComplteData = function(){
    var countryVal = $('#country').val();
    if(countryVal){
      data = {countryId:countryVal};
    } 
   // console.log(data);
    $http.post('/countries', data).then(function(response){ 
              if(response.data.status == 'Failure'){
                
              }else if(response.data.status == 'Success') {
                $scope.name =   response.data.countries;
                //console.log($scope.name);
                var txt = '<ul id="country-list" style="padding-left: 0px;">';
                angular.forEach($scope.name,function(item,index){
     txt += '<li style="list-style:none;border:1px solid #eee; width: 324px;border-radius:4px;" onclick = selectCountry("' + item.country_name + '")>' + item.country_name + '</li>';                
                });
                txt += '</ul>';
                $('#suggesstion-box').html(txt);

              }
         }, function (error_response){
             console.log(error_response);
             
         });


    };
       selectCountry = function(id){
       $("#country").val(id);
       $("#suggesstion-box").hide();
       }

  /* forgot password function*/

 $scope.forgotPassword = function ()
        {  
            
            var id    = '';
            var param = '';
            if($scope.email.indexOf('@') != '-1' )
            {   param = 'email';
                id    = '10';
            }else{
                param = 'username';
                id    = '17';
            }  
            ajaxloader.load(api_url +'sendmail?token=aforetechnical@321!'+ '&'+param+'=' + $scope.email + '&id=' + id, function (res) {
           resp = JSON.parse(res);
           if(resp.status == 'Success'){
               var msg = 'Success! your reset password link sent to your email Id';
                $(".alert").html(msg);
                $(".alert").show().delay(2000).fadeOut();
                setTimeout(function(){
                $('#myModal12').modal('hide');
                }, 2000);
                 

          }else{
            var msg = 'Your email Id is not registered';
            $(".alert").html(msg);

          }
            
        });

 

                    

            //$scope.show();
        };



   /// signin
    $scope.submitSignin = function(){
           var data = { 
                       email:$('#email_signin').val(),
                       password:$('#password_signin').val(),
                       };
           if($("#signin").valid()){  
             $http.post('/signin', data).then(function(response){ 
              if(response.data.status == 'Failure'){
                 alert('Wrong Email or password');
                 $('#email_signin').val('');
                 $('#password_signin').val('');
              }else if(response.data.status == 'Success') {
                window.location.assign("/accountsetting");
             }
         }, function (error_response){
             console.log(error_response);
             $('#email_signin').val('');
             $('#password_signin').val('');
         });
      }
    };

    $scope.onchangeSchoolserch = function(){
            var schoolname = $('#school').val();
            $("#txtAllowSearchID").css("display", "none");
            var availableTags = [];
            
             //alert(api_url+'schools/search'+'?school_name='+schoolname+'&token=aforetechnical@321!');
          $http.get(api_url+'schools/search'+'?school_name='+schoolname+'&token=aforetechnical@321!').then(function(response){
             var data1 = JSON.parse(JSON.stringify(response.data.school_list));
             for(var i=0;i<data1.length;i++){
                availableTags.push({"id": data1[i]['school_id'], "label": data1[i]['school_name'] + ' ' + data1[i]['city'] + ' ' + data1[i]['state']});
               }
          $( ".autocomplete-1" ).autocomplete({
                  source: availableTags,
                  response: function(event, ui) {
                      // ui.content is the array that's about to be sent to the response callback.
                      if (ui.content.length === 0) {
                           var noResult = { value:"Nodata",label:"No results found" };
                           //$("#school").val("");
                           //$("#txtAllowSearchID").val("Nodata");
                           $("#txtAllowSearchID").css("display", "block");
                      }else{
                           $("#txtAllowSearchID").css("display", "none");
                      } 
                  },
                 
                  select: function (event, ui) {
                  $("#school").val(ui.item.label);
                  $("#txtAllowSearch").val(ui.item.id);  // save selected id to hidden input
                    }
                  });
         });
    };

     $scope.getschool = function(school_name, school_id){
      var school_name = school_name;
      var school_id = school_id; 
      $('#school').val(school_name);
      $('#school').attr('data-id',school_id); 
      $('#autocomplete').hide();
    };


    $scope.submitSchool = function(){
          var data = { 
                       school_name:$('#school_name').val(),
                       address:$('#address').val(),
                       city:$('#city').val(),
                       state:$('#state').val(),
                       country:$('#country').val(),
                       pincode:$('#pincode').val(),
                       phone:$('#phone').val(),
                       email_id:$('#email').val(),
                       web_url:$('#web_url').val()
                      };
          //var url = api_url+'schools/addschoolslist'+'?token=aforetechnical@321!';
          /*if($("#schoolinfo").valid()){  
             $http.post('/school_detail', data).then(function(response){ 
              if(response.data.status == 'Failure'){
                 alert('Wrong Email or password');
                 //$('#email_signin').val('');
                 //$('#password_signin').val('');
              }else if(response.data.status == 'Success') {
               // window.location.assign("/accountsetting");
             }
         }, function (error_response){
             console.log(error_response);
             //$('#email_signin').val('');
             //$('#password_signin').val('');
         });
      }
      // } else{
      //   alert();
      // } */
     /* $.ajax({
     type: "POST",
     url: "http://162.243.117.156:3000/schools/addschoolslist?token=aforetechnical@321!",
     data: {city:'kss'},
     dataType:'json',
     success: function(msg)
      {
       console.log(msg);
      }
     });  {city:'kss'} */
 //alert(JSON.stringify(data));
      if($("#schoolinfo").valid()){
      ajaxloader.loadURL(api_url+'schools/addschoolslistportal'+'?token=aforetechnical@321!', data, function(res){
          if(res.teacher_list != ""){
             var list = JSON.parse(JSON.stringify(res.teacher_list));
             //console.log(list[0].school_name);
             $("#signup input[name=school]").val(list[0].school_name);
             $("#signup input[name=txtAllowSearch]").val(list[0].school_id);
             $('#myModal').modal('hide');
             $("#txtAllowSearchID").css("display", "none");
           }
       });     
     }
   }

 



  });