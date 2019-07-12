import React, { Component } from 'react';
import {Link} from 'react-router-dom';
import axios from 'axios';
import ItemService from '../services/ItemService';
import config from '../assets/json/config.json';
class Edit_Teacher extends Component {
   
    constructor(props){
    	super(props);
    	this.ItemService = new ItemService();
    	this.state = {value: '' };
    	this.handleChange = this.handleChange.bind(this);
    	this.handleSubmit = this.handleSubmit.bind(this);
    }

    componentDidMount(){    	
    	let query = new URLSearchParams(this.props.location.search);
    	let member_no = query.get('member_no');
	    axios.get(config.api_url+':'+config.port+'/teacher/databyid_portal?member_no='+member_no+'&token='+config.api_token)
	    .then(response => {
	      this.setState({ value: response.data.user_list['0']});	      
	    })
	    .catch(function (error) {
	       window.global.fclog(error);
	    })
   }

  handleChange(event) {
  	 const stateCopy = Object.assign({}, this.state);    //creating copy of object
	 stateCopy.value['type'] = event.target.value;
     this.setState(stateCopy);
  }

  handleSubmit(event){
  	 event.preventDefault(); 
  	 let query = new URLSearchParams(this.props.location.search);
     let member_no = query.get('member_no');  
     let type = this.state.value.type;
     let school_id = this.state.value.school_id;
     axios.post(config.api_url+':'+config.port+'/teacher/updateportalTeacherById', {
		        type: type,
		        member_no: member_no,
		        school_id: school_id,
		        token:config.api_token		        
		     })
		    .then(response => { 		    	
		      	   if(response.data.userStatus == 'exist'){
                      alert('Principal/Viceprincipal already exit!!');
                       window.location.href = '/#/teachermanagement';
		      	   }else{
                        alert('Record updated successfully!');
      	               window.location.href = '/#/teachermanagement';
		      	   }		      	    
		      })
		      .catch(function (error) {
		        window.global.fclog(error);
		      });
  }

   render(){
   	  return(
			<section  class="about-section  text-center   privacy-mar">
			<div class="container">
			<div class="">
				<div class="about-feat text-left about-left">
				<div class="col-lg-12 col-md-12  col-xs-12">
					<div class="col-md-9  admin-content">
					<div class="teacher-m list-margin">
						<h3 class="panel-title">Edit Teacher</h3>
					</div>
					<form className="form-label  form-horizontal" onSubmit={this.handleSubmit} >
							<div class="form-group">
							<label class="control-label col-sm-3" htmlFor="name">Teacher name:</label>
							<div className="col-sm-9">
							<input type="text" value={this.state.value.name} onChange={this.handleChange}  className="form-control" readonly="readonly"/></div>
							<div className="clear"></div>
						</div>
						<div class="form-group">
							<label class="control-label col-sm-3" htmlFor="name">Email:</label>
							<div className="col-sm-9">
							<input type="text" value={this.state.value.email} onChange={this.handleChange}  className="form-control" readonly="readonly"/></div>
							<div className="clear"></div>
						</div>
						<div class="form-group">
							<label class="control-label col-sm-3" htmlFor="name">Member No:</label>
							<div className="col-sm-9">
							<input type="text" value={this.state.value.member_no} onChange={this.handleChange}  className="form-control" readonly="readonly"/></div>
							<div className="clear"></div>
						</div>
						<div class="form-group">
							<label class="control-label col-sm-3" htmlFor="name">Status:</label>
							<div className="col-sm-9">
							<input type="text" value={this.state.value.status} onChange={this.handleChange}  className="form-control" readonly="readonly"/></div>
							<div className="clear"></div>
						</div>
						<div class="form-group">
								<label className="control-label col-sm-3" for="grade">Role:</label>
									<div className="col-sm-9">
									<select name = "type" className="form-control selectnew_grade" onChange={this.handleChange} ng-model="type" required="true">
										<option value="">Role</option>
										<option value="2">Teacher</option>
										<option value="1">Principal</option>
										<option value="5">Vice Principal</option>
									</select>
									</div>
								<div className="clear"></div>
							</div>
							<div className="form-group">												               
								<div className="col-sm-offset-3 col-sm-9">
									<button type="Update" className="btn btn-primary editButton" ng-disabled="form_data.$invalid">Save</button>&nbsp;&nbsp;&nbsp;
									<Link type="Cancle" to="./teachermanagement" className="btn btn-primary" ng-disabled="form_data.$invalid">Cancle</Link>
								</div>												
							</div>										    
						</form>
					</div>
					</div>
				</div>
			</div>
			</div>
			</section>
   	  	);
   }
}

export default Edit_Teacher;