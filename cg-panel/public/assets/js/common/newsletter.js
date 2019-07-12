var myApp = angular.module("myApp", []);
 myApp.controller('newletterController', function($scope, $http) {
         $scope.submitNewsletter = function(){
      	 $http.post('/newsletter', {email_id:$('#email').val()}).then(function(response){
      	 	 if(typeof response.data != 'undefined'){
      	 	    alert(response.data.success_msg);
              $('#email').val('');
            	}
      	 }, function (error_response){
             console.log(error_response);
             $('#email').val('');
      	 });
      }
  });