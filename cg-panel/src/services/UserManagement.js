import React, { Component } from 'react';
import axios from 'axios';
import querystring from 'querystring';
import config from '../assets/json/config.json';


class UserManagement{
	forgotPassword(data){
		    var id    = '';
            var param = '';
		if(data.indexOf('@') != '-1' )
            {   param = 'email';
                id    = '10';
            }else{
                param = 'username';
                id    = '17';
            } 

		axios.get(config.api_url+':'+config.port+'/sendmail?email='+data+'&id='+id+'&token='+config.api_token)
	     .then(function (response) {
		      window.global.fclog(response);		     
		      alert('Success! your reset password link sent to your email Id');
		      window.location.href = '#/login';
		  })
	     .catch(function (error) {
		    window.global.fclog(error);
		 });
	}

	ForgotPasswordUpdate(data, email){
		if(data['pass'] == data['cpass']){
			let abc = { headers: {'Content-Type': 'application/json'}};
			let dataparam = {
	     	password: data['pass'],
	     	confirm_password: data['cpass'],	
	     	email : email,
	     	token: config.api_token
	     	}
			
		 axios.post(config.api_url+':'+config.port+'/forgetpassword', dataparam)
	     .then(function (response) {
		      window.global.fclog(response);
		      alert('Record successfully added');
		      //window.location.href = '/';
		  })
	     .catch(function (error) {
		    window.global.fclog(error);
		 });
	 }else{
       alert("Password Not Match");
	 }
	}

	change_password(data){

		axios.post(config.api_url+':'+config.port+'/changepassword/update', data)
		.then(response => { 

			if (response.data.status == 'Failure') {

                alert(response.data.comments);
              
            } else if (response.data.status == 'Success') {

                alert('Profile changed Successfully');                
            }
		})
		.catch(function (error) {
			window.global.fclog(error);
		});
	}
}
export default UserManagement;