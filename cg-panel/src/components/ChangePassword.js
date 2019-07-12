import React, { Component } from 'react';
import UserService from '../services/UserManagement';
import axios from 'axios';
import config from '../assets/json/config.json';

import Form from 'react-validation/build/form';
import Input from 'react-validation/build/input';
import Button from 'react-validation/build/button';

class ChangePassword extends Component{	
	constructor(props){
		super(props);
		this.state = {loggedInUser:{},item:{}};		
		this.state.UserService = new UserService();
		this.change_password =this.change_password.bind(this);
		this.handleChange =this.handleChange.bind(this);
	}

	componentWillMount(){
    	let loggedInUser   = JSON.parse(localStorage.getItem('loggedInUser'));
    	if(!loggedInUser)
	    {
	       loggedInUser = {};
	    }
	   this.setState({loggedInUser:loggedInUser});
	}

	handleChange(event) {
		const name = event.target.name;  
	    const stateCopy = Object.assign({}, this.state);    //creating copy of object
	    stateCopy.item[name] = event.target.value;                        //updating value
	    this.setState(stateCopy);
	}  
	
	change_password(event)
	{	
		 var password_data = {
        	password: this.state.item.currpassword,
            newpassword: this.state.item.newpassword,
            confirmpassword: this.state.item.cfmpassword,
            member_no: this.state.loggedInUser.member_no,
            token:config.api_token
	    }; 
	    this.state.UserService.change_password(password_data);		
	    event.preventDefault();
	    return false;
	}
	
	render(){		
		const required = (value, props) => {
		  if (!value.toString().trim().length) {
		    // We can return string or jsx as the 'error' prop for the validated Component
		    return <label className="text-danger">{props.placeholder} is required</label>;
		  }
		};

		const password = (value, props, components) => {		 
		  if (value !== components['newpassword'][0].value) {
		    return <label className="text-danger">New Password and Confirm Password are not equal.</label>
		  }
		};

		return(
	

<div class="col-md-9  admin-content">
<div class="teacher-m list-margin">
	<h3 class="panel-title">Change password</h3>
</div>
<form className="form-label  form-horizontal" onSubmit={this.change_password} >
<div class="form-group">
		<label class="control-label col-sm-3" htmlFor="name">Current password:</label>
		<div className="col-sm-9">
		<input className="form-control" name="currpassword" id="currpassword" placeholder="Current password"  type="password"  onChange={this.handleChange} required /></div>
		<div className="clear"></div>
	</div>
	<div class="form-group">
		<label class="control-label col-sm-3" htmlFor="name">New password:</label>
		<div className="col-sm-9">
		<input className="form-control" name="newpassword" id="newpassword" placeholder="New password" type="password"   onChange={this.handleChange} required /></div>
		<div className="clear"></div>
	</div>
	<div class="form-group">
		<label class="control-label col-sm-3" htmlFor="name">Confirm password:</label>
		<div className="col-sm-9">
		<input className="form-control" name="cfmpassword" id="cfmpassword" placeholder="Confirm password"  type="password"  onChange={this.handleChange} required /></div>
		<div className="clear"></div>
	</div>
	
	<input name="member_no" id="member_no" value={this.state.loggedInUser.member_no} type="hidden"/>
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

export default ChangePassword;