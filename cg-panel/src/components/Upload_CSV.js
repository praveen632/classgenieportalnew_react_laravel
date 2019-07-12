import React, { Component } from 'react';
import ItemService from '../services/ItemService';
import axios, { post } from 'axios';
import config from '../assets/json/config.json';

class Upload_CSV extends Component{	
	constructor(props){
		super(props);
		this.state = {value:''}
		this.state ={
		      file:'',
		      image:null
		    }
		    this.onFileChange = this.onFileChange.bind(this)
		    this.handleSubmit = this.handleSubmit.bind(this)		    
		   }

     onFileChange(e) {
		this.setState({image:e.target.files[0]});
	}

     handleSubmit(e){   
        e.preventDefault()       
        var url = config.api_url+':'+config.port+'/classinfo/studentcsvPortal?token='+config.api_token;     	
    	var configHeader = {
			headers: {
			'content-type': 'multipart/form-data'
			}
		}
		const formData = new FormData();
		formData.append('upload_file',this.state.image);
		formData.append('class_id',this.props.class_id);
	    formData.append('token',config.api_token)	   
	    axios.post(url, formData, configHeader)
	      .then(function(response){
	      	if(response.data.status == 'Success')
	      	{
				alert('Student add Successfully!!');				
				this.props.parentObj.changeStep('view',this.props.class_id,this.props.class_name);
	      	}
	      	else
	      	{
	      		alert('We are unable to Upload!!');
	      	}
	      }.bind(this))
	  
   } 
	render(){		
		return(			
				<div class="col-md-9  admin-content">
					<div class="teacher-m">
						<h3 class="panel-title">Upload Student List</h3>
					</div>
				<form className="form-label  form-horizontal" onSubmit={this.handleSubmit}>
				    <div className="form-group">
				        <div className="col-sm-9">
						    <input type="file" className="form-control" name="image" id="image" onChange={this.onFileChange} />		                   
		                    </div>
				        <div className="clear"></div>
				    </div>		           			       
					<div className="form-group">
		            	<label className="control-label">&nbsp;</label>	               
		                <div className="col-sm-9" id="loader_container" htmlFor="name">
		                     <input type="submit" value="Submit" className="btn btn-primary"/>
		                </div>
		                <div className="clear"></div>
		            </div>		    
				</form>
			</div>
		);
	}
}

export default Upload_CSV;