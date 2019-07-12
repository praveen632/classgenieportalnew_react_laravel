import React, { Component } from 'react';
import ItemService from '../services/ItemService';
import axios from 'axios';
import config from '../assets/json/config.json';

class EditProfile extends Component{	
	constructor(props){
		super(props);			
		this.state ={
			file:[],
			image:null
		}
		this.state.message = 'hide';
		this.handleChange = this.handleChange.bind(this)
		this.handleSubmit = this.handleSubmit.bind(this)		
		this.onFileChange = this.onFileChange.bind(this)
	}

	componentWillMount(){
		let loggedInUser   = JSON.parse(localStorage.getItem('loggedInUser'));
		if(!loggedInUser)
		{
		   loggedInUser = {};
		}
		let logValue = {teacher_name:loggedInUser.name, age:loggedInUser.age, phone:loggedInUser.phone,member_no:loggedInUser.member_no}
		const stateCopy = Object.assign({}, this.state);    //creating copy of object
		stateCopy.file = logValue;                        //updating value
		this.setState(stateCopy);		
	}

	handleChange(event) {
		const name = event.target.name;  
		const stateCopy = Object.assign({}, this.state);    //creating copy of object
		stateCopy.file[name] = event.target.value;                        //updating value
		this.setState(stateCopy);
	}

	onFileChange(e) {
		this.setState({image:e.target.files[0]});
	}  
    
   handleSubmit(event){  
    event.preventDefault();
    var currentObj = this;
    //when we upload image then need hit this API else other
    if(this.state.image)
    {
    	var url = config.api_url+':'+config.port+'/student/updateimage?token='+config.api_token;     	
    	var configHeader = {
			headers: {
			'content-type': 'multipart/form-data'
			}
		}
		const formData = new FormData();
		formData.append('upload_file',this.state.image);
	    formData.append('member_no',this.state.file.member_no)
	    formData.append('age',this.state.file.age);
	    formData.append('phone',this.state.file.phone)
	    formData.append('name',this.state.file.teacher_name)
	    formData.append('token',config.api_token)  	   
	    axios.post(url, formData, configHeader)
	      .then(function(response){
	      	if(response.data.status == 'Success')
	      	{
				let loggedInUser   = JSON.parse(localStorage.getItem('loggedInUser'));
				loggedInUser.name = response.data.name[0].name;
				loggedInUser.phone = response.data.name[0].phone;
				loggedInUser.age = response.data.name[0].age;
				loggedInUser.image = response.data.name[0].image;

				localStorage.setItem('loggedInUser', JSON.stringify(loggedInUser));
				currentObj.setState({message:''});
				setTimeout(function() { window.location.reload(); }, 1000);
	      	}
	      	else
	      	{
	      		alert('We are unable to update');
	      	}
	      }) 
    }
    else
    {
    	var url = config.api_url+':'+config.port+'/teacher/update'; 
    	
    	const data = {
	    	member_no : this.state.file.member_no,
	    	age : this.state.file.age,
	    	phone : this.state.file.phone,
	    	name : this.state.file.teacher_name,
	    	token : config.api_token
    	}   
	   
	    axios.post(url, data)
	      .then(function(response){

	      	if(response.data.status == 'Success')
	      	{
				let loggedInUser   = JSON.parse(localStorage.getItem('loggedInUser'));
				loggedInUser.name = response.data.user_list[0].name;
				loggedInUser.phone = response.data.user_list[0].phone;
				loggedInUser.age = response.data.user_list[0].age;
				localStorage.setItem('loggedInUser', JSON.stringify(loggedInUser));				
				currentObj.setState({message:''});				
				setTimeout(function() { window.location.reload(); }, 1000);
	      	}
	      	else
	      	{
	      		alert('We are unable to update');
	      	}
	      }) 		
    }
   }
   
	render(){		
		return(
			<div class="col-md-9  admin-content">
			<div class="teacher-m list-margin">
				<h3 class="panel-title">Edit profile</h3>
			</div>
			<div class={ this.state.message + ' alert alert-success'} ><strong>Profile has been updated successfully.</strong></div>
			<form className="form-label  form-horizontal" onSubmit={this.handleSubmit} >
			<div class="form-group">
					<label class="control-label col-sm-3" htmlFor="name">Name:</label>
					<div className="col-sm-9">
					<input type="text" className="form-control" placeholder="Name" name="teacher_name" id="teacher_name" value={this.state.file.teacher_name} onChange={this.handleChange} type="text" required /></div>
					<div className="clear"></div>
				</div>
				<div class="form-group">
					<label class="control-label col-sm-3" htmlFor="name">Age:</label>
					<div className="col-sm-9">
					<input type="text" className="form-control" placeholder="Age" name="age" id="age" value={this.state.file.age} onChange={this.handleChange} type="text" required/></div>
					<div className="clear"></div>
				</div>
				<div class="form-group">
					<label class="control-label col-sm-3" htmlFor="name">Cell Number:</label>
					<div className="col-sm-9">
					<input type="text" className="form-control" placeholder="Phone" name="phone" id="phone" value={this.state.file.phone}  type="text" onChange={this.handleChange} required /></div>
					<div className="clear"></div>
				</div>
				<div class="form-group">
					<label class="control-label col-sm-3" htmlFor="name">Profile Image:</label>
					<div className="col-sm-9">
					<input className="form-control" type="file" name="image" id="image" onChange={this.onFileChange} /></div>
					<div className="clear"></div>
				</div>

			<div className="form-group">
				<label className="control-label col-sm-3">&nbsp;</label>	               
				<div className="col-sm-9" id="loader_container" htmlFor="name">
					<input type="submit" value="Submit" className="btn btn-primary"/>
				</div>
				<div className="clear"></div>
			</div>				       
			<div className="clear"></div>				    
			</form>
			</div>
		);
	}
}

export default EditProfile;