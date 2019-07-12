import React, { Component } from 'react';
import ReactDOM from 'react-dom';
import axios from 'axios';
import UserManagement from '../services/UserManagement';
import RoleDdl from './common/RoleDdl';
import ForgotPasswordCss from '../assets/css/forgot_password.css';
import Encryption from '../assets/js/common/encryption.js';

class ForgotPasswordUpdate extends Component {
	constructor(props)
	{
		super(props);
		this.usermanagement = new UserManagement();	
		this.state 				= {};		
		this.handleInputChange = this.handleInputChange.bind(this);
		this.forgotUpdate = this.forgotUpdate.bind(this);
		this.state.data = {};		 	
	}

	handleInputChange(event){
		//this.setState({data: event.target.value});
		const name = event.target.name;  
	    const stateCopy = Object.assign({}, this.state);    //creating copy of object
	    stateCopy.data[name] = event.target.value;                        //updating value
	    this.setState(stateCopy);
	}
	forgotUpdate(event){
		event.preventDefault();
		let query = new URLSearchParams(this.props.location.search)
        let token = query.get('token')
        let email = Encryption.decrypt(token);
        this.usermanagement.ForgotPasswordUpdate(this.state.data,email);
	}

	ComponentWillMount(){	
		this.setState({ email_id:'abc' });
	}


	render(){
		return(
			<div>
			 <div className="loginmodal-container  margintop_forgot">
			  <span className="reset-head">Reset Password</span>
			  <form  method="post" onSubmit={this.forgotUpdate.bind(this) }>
                  <div className="form_forgotp">
				<input type="password" name="pass"    id="pass" placeholder="Password" onChange={this.handleInputChange.bind(this) } />
				</div>
				    <div className="form_forgotp">
				<input type="password" name="cpass" id="cpass" placeholder="Type your new password again" onChange={this.handleInputChange.bind(this) } required />
				</div>
				<input type="hidden" name="email_id"  id="email_id" value={this.state.email_id} />
				<input type="submit" name="Reset Password" className="login loginmodal-submit  forgot-btnp" value="Reset Password"  />
			  </form>			 
	    </div>
	     <div className="clear">&nbsp;</div>
	    </div>

		);
	}
}
export default ForgotPasswordUpdate;