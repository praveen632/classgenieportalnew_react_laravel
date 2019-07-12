import React, { Component } from 'react';
import axios from 'axios';
import config from '../assets/json/config.json';

class ItemService{
	
	sendData(data) {
	     axios.post(config.api_url+':'+config.port+'/api/applicant_details', {
	     	name: data
	     })
	     .then(function (response) {
		      window.global.fclog(response);
		      alert('Record successfully added');
		      window.location.href = '/';
		  })
	     .catch(function (error) {
		    window.global.fclog(error);
		 });
	}

	deleteData(id){
		    axios.delete(config.api_url+':'+config.port+'/api/applicant_details/'+id)
		      .then(response => { 
		      	    window.global.fclog(response);
		      	    alert('Record deleted successfully!');
      	            window.location.href = '/';
		      })
		      .catch(function (error) {
		        window.global.fclog(error);
		      });

        }

      updateData(data, id){
		     axios.put(config.api_url+':'+config.port+'/api/applicant_details/'+id, {
		        name: data
		     })
		    .then(response => { 
		      	    window.global.fclog(response);
		      	    alert('Record updated successfully!');
      	            window.location.href = '/';
		      })
		      .catch(function (error) {
		        window.global.fclog(error);
		      });
	  }

          
}

export default ItemService;