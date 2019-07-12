import React, { Component } from 'react';
import axios from 'axios';
import config from '../assets/json/config.json';

class SchoolService{
	
	updateData(data){

		axios.post(config.api_url+':'+config.port+'/schools/school_update', data)
		.then(response => { 

			if (response.data.status == 'Failure') {

                alert('Something went wrong');
              
            } else if (response.data.status == 'Success') {
                //var msg = 'School info updated Successfully';
                alert('School info updated Successfully');
                //$(".alert").html(msg);
                //$(".alert").show().delay(500).fadeOut();
            }
		})
		.catch(function (error) {
			window.global.fclog(error);
		});
	}

          
}

export default SchoolService;