import React, { Component } from 'react';
import ReactDOM from 'react-dom';
import SchoolService from '../services/SchoolService';
import axios from 'axios';
import config from '../assets/json/config.json';
import validator from 'react-validation';
import Form from 'react-validation/build/form';
import Input from 'react-validation/build/input';
import Button from 'react-validation/build/button';
import CustomAutosuggest from './common/CustomAutosuggest';
import './common/InputValidator.js';

class AddSchool extends Component{	
	constructor(props){
		super(props);
		this.state = {};
		this.state.school_details = {};	
		this.state.SchoolService = new SchoolService();
		this.submitSchool = this.submitSchool.bind(this);
		this.handleChange = this.handleChange.bind(this);			
	}

	handleChange(event) {
		const name = event.target.name;  
	    const stateCopy = Object.assign({}, this.state);    //creating copy of object
	    stateCopy.school_details[name] = event.target.value;                        //updating value
	    this.setState(stateCopy);
	}

	Loginchangeschool(event){
		window.location.reload(); 
	}

   submitSchool(event)
   { 		
   		let school_details = this.state.school_details;	
   		var school_data = {
            school_name: school_details.school_name,
            web_url: school_details.web_url,
            address: school_details.address,
            city: school_details.city,
            state: school_details.state,
            country: school_details.country_name,
            pincode: school_details.pincode,
            phone: school_details.phone,
            email: school_details.email,
            token:config.api_token
        };  		
 			 if(school_details.school_name == "" || school_details.school_name == undefined)
     		 {
						 alert('Please Enter the School name ');
						school_details.school_name = "";
						 return false;
			 }

		// 	  else if(school_details.address == "" || school_details.address == undefined)
		// 	 {
		// 			alert('Please Enter the School Address ');
		// 			// school_details.address = "";
		// 			return false;
		// }
		// else if(school_details.city == "" || school_details.city == undefined)
	  //  	{
		// 	 alert('Please Enter the city ');
		// 	 school_details.city = '';
		// 	 return false;
    //  }  
		//  else if(school_details.state == "" || school_details.state == undefined)
		//     {
	  //      	 alert('Please Enter the School Address ');
		// 				school_details.state = '';
	  //     	 return false;
		// 		}  
		// 		else if(school_details.country_name == "" || school_details.country_name == undefined)
		//     {
	  //      	 alert('Please Enter the country name ');
		// 				school_details.country_name = '';
	  //     	 return false;
		// 		} 	
      	// else if(!re.test(String( school_details.email	).toLowerCase()))
		    // {
	      //  	 alert('Please Enter the valid school email ');
				// 		school_details.country_name = '';
	      // 	 return false;
				// }
        axios.post(config.api_url+':'+config.port+'/schools/addschoolslistportal',school_data)
	      .then(function (response) {	      		
			if(response.data.teacher_list)
			{				            
			    const stateCopy = Object.assign({}, this.props.parentObject.state);    //creating copy of object
			    stateCopy.school_id = response.data.teacher_list[0].school_id;
			    stateCopy.school_name = response.data.teacher_list[0].school_name;   
			    stateCopy.step = 'signup';                      //updating value
			    this.props.parentObject.setState(stateCopy);
			}
			else if(response.data.error_code == 1)
			{
				alert(response.data.error_msg);	           		
			}
	      }.bind(this))
	      .catch(function (error) {

	      });
	      event.preventDefault();
   }

  searchReturn(country)
  {    
    const stateCopy = Object.assign({}, this.state);    //creating copy of object
	stateCopy.school_details['country_id'] = country.key; 
	stateCopy.school_details['country_name'] = country.text;                        
	this.setState(stateCopy);	
  }



	render(){
		const required = (value, props) => {
		  if (!value.toString().trim().length) {
		    // We can return string or jsx as the 'error' prop for the validated Component
		    return <p>{props.placeholder} is required</p>;
		  }
		};

		let forName = ['country_name'];
    	let forKey = ['id'];
		return(
			// <div className="login-top">
			//     <h3>School Details</h3>
			//    <Form name="schoolinfo" id="schoolinfo" onSubmit={this.submitSchool} noValidate="novalidate" ref={c => { this.form = c }}>
			// 	    <Input name="school_name" id="school_name" placeholder="School Name" type="text" onChange={this.handleChange} validations={[required]}/>
			// 	    <Input name="address" id="address" placeholder="School Address" type="text" onChange={this.handleChange} validations={[required]}/>
			// 	    <Input name="city" id="city" placeholder="School City" type="text" onChange={this.handleChange} validations={[required]}/>
			// 	    <Input name="state" id="state" placeholder="School State" type="text" onChange={this.handleChange} validations={[required]}/>
			// 	    <CustomAutosuggest parentObject={this} forName={forName} forKey={forKey} ajaxUrl={config.api_url+':'+config.port+'/schools/countries'} searchParam="countryName" token={config.api_token} placeHolder="Country" dataParam="countries" selectedValue=""/>
			// 	    <div id="suggesstion-box"></div>
			// 	    <Input name="pincode" id="pincode" placeholder="Pincode" type="text" onChange={this.handleChange} validations={[required]}/>
			// 	    <Input name="phone" id="phone" placeholder="Mobile Number" type="text"onChange={this.handleChange} validations={[required]}/>
			// 	    <Input name="email" id="email" placeholder="Email Address" type="text" onChange={this.handleChange}/>
			// 	    <Input name="web_url" id="web_url" placeholder="School Website" type="text" onChange={this.handleChange}/>
			// 	    <div className="login-bottom">
			// 	        <div className="submit new_submit">
			// 	              <Button  className="btn btn-primary">Save changes</Button>
			// 	        </div>
			// 	    </div>
			// 	</Form>
			// </div>

<div className="limiter">
<div className="container-login100">
  <div className="wrap-login100">
	<form className="login100-form validate-form" name="schoolinfo" id="schoolinfo" onSubmit={this.submitSchool} noValidate="novalidate" ref={c => { this.form = c }}>
	  <span className="login100-form-title p-b-26">
	    School Details
	  </span>
	  <div className="wrap-input100 validate-input   m-b-23">
		<input className="input100" name="school_name" id="school_name" placeholder="School Name" type="text" onChange={this.handleChange} validations={[required]}/>
		<span className="focus-input100"></span>
	  </div>
	  <div className="wrap-input100 validate-input   m-b-23">
		<input className="input100" name="address" id="address" placeholder="School Address" type="text" onChange={this.handleChange} validations={[required]}/>
		<span className="focus-input100" ></span>
	  </div>
	  <div className="wrap-input100 validate-input   m-b-23">
		<input className="input100" name="city" id="city" placeholder="School City" type="text" onChange={this.handleChange} validations={[required]}/>
		<span className="focus-input100" ></span>
	  </div>
	  <div className="wrap-input100 validate-input   m-b-23">
		<input className="input100" name="state" id="state" placeholder="School State" type="text" onChange={this.handleChange} validations={[required]}/>
		<span className="focus-input100" ></span>
	  </div>	  
	  <div className="wrap-input100 validate-input   m-b-23" >   
	    <CustomAutosuggest parentObject={this} forName={forName} forKey={forKey} ajaxUrl={config.api_url+':'+config.port+'/schools/countries'} searchParam="countryName" token={config.api_token} placeHolder="Country" dataParam="countries" selectedValue=""/>
	    <div id="suggesstion-box"></div>
	  </div>
	  <div className="wrap-input100 validate-input   m-b-23">
		<input className="input100" name="pincode" id="pincode" placeholder="Pincode" type="text" onChange={this.handleChange} validations={[required]}/>
		<span className="focus-input100" ></span>
	  </div>
	  <div className="wrap-input100 validate-input   m-b-23">
		<input className="input100" name="phone" id="phone" placeholder="Mobile Number" type="text"onChange={this.handleChange} validations={[required]}/>
		<span className="focus-input100" ></span>
	  </div>
	  <div className="wrap-input100 validate-input   m-b-23">
		<input className="input100" name="email" id="email" placeholder="Email Address" type="text" onChange={this.handleChange}/>
		<span className="focus-input100" ></span>
	  </div>
	  <div className="wrap-input100 validate-input   m-b-23">
		<input className="input100" name="web_url" id="web_url" placeholder="School Website" type="text" onChange={this.handleChange}/>
		<span className="focus-input100" ></span>
	  </div>
	  
	  <div className="container-login100-form-btn">
		<div className="wrap-login100-form-btn">
		  <div className="login100-form-bgbtn"></div>
		  <button className="login100-form-btn">
		  Save changes
		  </button>
		</div>
	  </div>
	  <div className="text-center p-t-115">			
	  <a onClick={this.Loginchangeschool.bind(this) }>
	     Login
	   </a>       
		  </div>
	</form>
  </div>
</div>
</div>

		);
	}
}

export default AddSchool;