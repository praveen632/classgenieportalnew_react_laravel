var myApp = angular.module("myApp", []);
 myApp.controller('contactusController', function($scope, $http) {
      $scope.submitcontactForm = function(){
      	 $http.post('/contactus', {email:$('#email').val(), name:$('#fullname').val(), message:$('#message').val(),}).then(function(response){
      	 	 if(typeof response.data != 'undefined'){
      	 	    alert(response.data.success_msg);
              $('#fullname').val('');         
              $('#email').val('');
              $('#message').val('');
              callemailapi(response.data.email, '2', response.data.mail_url);  
          	}
      	 }, function (error_response){            
      	 });
      }
  
//call sendmail after submit contactform 
 function callemailapi(email, id, mailUrl){
  var url = mailUrl+'?email='+email+'&id='+id+'&token=aforetechnical@321!';
  
  $http.get(url).then(function(response){
       if(typeof response.data != 'undefined')
            {
              alert(response.data.status);
             }
         }, function (error_response)
           {          
           })
       }
 });