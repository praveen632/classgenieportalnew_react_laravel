import React, { Component } from 'react';
import SchoolService from '../services/SchoolService';
import axios from 'axios';
import config from '../assets/json/config.json';
import validator from 'react-validation';
import Form from 'react-validation/build/form';
import Input from 'react-validation/build/input';
import Button from 'react-validation/build/button';

class EditSchool extends Component{	
	constructor(props){
		super(props);
		this.state = {items:''};
		this.state.SchoolService = new SchoolService();
		this.changeSchoolInfo = this.changeSchoolInfo.bind(this);
		this.handleChange = this.handleChange.bind(this);
	}
    
    componentWillMount(){
    	let loggedInUser   = JSON.parse(localStorage.getItem('loggedInUser'));
    	if(!loggedInUser)
	    {
	       loggedInUser = {};
	    }
    	let school_id = loggedInUser.school_id;
		axios.get(config.api_url+':'+config.port+'/schools/school_details?school_id='+school_id+'&token='+config.api_token)
		.then(
			response => { window.global.fclog(response);
			window.global.fclog(config);
		this.setState({ items: response.data.school_details[0] });
		})
		.catch(function (error) {
		window.global.fclog(error);
		})
    } 

	handleChange(event) {
		const name = event.target.name;  
	    const stateCopy = Object.assign({}, this.state);    //creating copy of object
	    stateCopy.items[name] = event.target.value;                        //updating value
	    this.setState(stateCopy);
	}  
    
   changeSchoolInfo(event)
   {   		
   		let school_details = this.state.items;
		//this.form.showError(school_details.school_name, <span>API error</span>);
   		var school_data = {
            school_name: school_details.school_name,
            web_url: school_details.web_url,
            address: school_details.address,
            city: school_details.city,
            state: school_details.state,
            country: school_details.country,
            pincode: school_details.pincode,
            phone: school_details.phone,
            school_id: school_details.school_id,
            token:config.api_token
        }; 
        this.state.SchoolService.updateData(school_data);
        event.preventDefault();
   }

	render(){
		const required = (value, props) => {
		  if (!value.toString().trim().length) {
		    // We can return string or jsx as the 'error' prop for the validated Component
		    return <p>{props.placeholder} is required</p>;
		  }
		};
		let school_details = this.state.items;
		return(		
			<div class="col-md-9  admin-content">
			<div class="teacher-m list-margin">
				<h3 class="panel-title">Edit school details</h3>
			</div> 
			<form className="form-label  form-horizontal" id="schoolinfo"  onSubmit={this.changeSchoolInfo} ref={c => { this.form = c }} >

			<div class="form-group">
					<label class="control-label col-sm-3" htmlFor="name">School:</label>
					<div className="col-sm-9">
					<input className="form-control"  placeholder="School name" name="school_name" id="school_name" value={school_details.school_name} type="text" onChange={this.handleChange} validations={[required]} /></div>
					<div className="clear"></div>
				</div>
				<div class="form-group">
					<label class="control-label col-sm-3" htmlFor="name">Web Url:</label>
					<div className="col-sm-9">
					<input  className="form-control" placeholder="web url" name="web_url" id="web_url" value={school_details.web_url} type="text" onChange={this.handleChange} /></div>
					<div className="clear"></div>
				</div>
				<div class="form-group">
					<label class="control-label col-sm-3" htmlFor="name">Address:</label>
					<div className="col-sm-9">
					<input  className="form-control" placeholder=" School address" name="address" id="address" value={school_details.address} type="text" onChange={this.handleChange} /></div>
					<div className="clear"></div>
				</div>
				<div class="form-group">
					<label class="control-label col-sm-3" htmlFor="name">City:</label>
					<div className="col-sm-9">
					<input  className="form-control" placeholder="School City" name="city" id="city" value={school_details.city} type="text"  onChange={this.handleChange} /></div>
					<div className="clear"></div>
				</div>
				<div class="form-group">
					<label class="control-label col-sm-3" htmlFor="name">State:</label>
					<div className="col-sm-9">
					<input  className="form-control"  placeholder="School State" name="state" id="state" value={school_details.state} type="text"  onChange={this.handleChange} /></div>
					<div className="clear"></div>
				</div>
				<div class="form-group">
					<label class="control-label col-sm-3" htmlFor="name">Country:</label>
					<div className="col-sm-9">
					<input className="form-control" placeholder="Pin Code" name="country" id="country" value={school_details.country} type="text"  onChange={this.handleChange} /></div>
					<div className="clear"></div>
				</div>
				<div class="form-group">
					<label class="control-label col-sm-3" htmlFor="name">Pin Code:</label>
					<div className="col-sm-9">
					<input className="form-control" placeholder="Pin Code" name="pincode" id="pincode" value={school_details.pincode} type="text"  onChange={this.handleChange} /></div>
					<div className="clear"></div>
				</div>
				<div class="form-group">
					<label class="control-label col-sm-3" htmlFor="name">Phone:</label>
					<div className="col-sm-9">
					<input className="form-control" placeholder="Phone" name="phone" id="phone" value={school_details.phone} type="text"  onChange={this.handleChange} /></div>
					<div className="clear"></div>
				</div>	
				<input className="form-control" placeholder="school_Id" name="school_id" id="school_id" value={school_details.school_id} type="hidden"   />
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

export default EditSchool;