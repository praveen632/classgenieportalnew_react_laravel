var myApp = angular.module("myApp", []);
 myApp.controller('forgotPasswordController', function($scope, $http) {
      $scope.submitforgotpasswordForm = function(){
      	     if($('#pass').val() == $('#cpass').val()){
			 $http.post('/forgot_password',{'password':$('#pass').val(), 'email_id':$('#email_id').val()}).then(function(response){
				 if(typeof response.data != 'undefined'){
					alert(response.data.success_msg);
					$('#pass').val('');					
				    $('#cpass').val('');
				  	callemailapi(response.data.email_id, '12', response.data.mail_url);  
            }
			 }, function (error_response){
				 console.log(error_response);
			 });
			}else{
				alert("Password Not Match");
				$('#pass').val('');					
				$('#cpass').val('');
			}
    }

 //call sendmail after submit contactform 
 function callemailapi(email_id, id, mailUrl){
  var url = mailUrl+'?email='+email_id+'&id='+id+'&token=aforetechnical@321!';
  
  
  $http.get(url).then(function(response){
       if(typeof response.data != 'undefined')
            {
              alert(response.data.status);
             }
         }, function (error_response)
           {
             console.log(error_response);
           })
       }
    });