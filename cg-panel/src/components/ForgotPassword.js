import React, { Component } from 'react';
import ReactDOM from 'react-dom';
import axios from 'axios';
import UserManagement from '../services/UserManagement';
import RoleDdl from './common/RoleDdl';


class ForgotPassword extends Component {
	constructor(props)
	{
		super(props);
		this.usermanagement = new UserManagement();		
		this.state 				= {};
		this.state.step 		= "login";
		this.handleForgot = this.handleForgot.bind(this);
		this.Loginchange = this.Loginchange.bind(this);
		this.state.email = '';		
	}

	handleForgot(event){
		this.setState({email: event.target.value});
	}
	
	submitForgot(event){
		event.preventDefault();
		var re = /^(([^<>()\[\]\\.,;:\s@"]+(\.[^<>()\[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
		if (!re.test(String(this.state.email).toLowerCase())) {
			alert(' Please Enter valid Email id');
			this.state.email = '';
			return false;
	  
		  }
		 this.usermanagement.forgotPassword(this.state.email);
	}

	Loginchange(event){
		window.location.reload(); 
	}

	render(){
		return(
				<div className="limiter">
				<div className="container-login100">
				<div className="wrap-login100">
					<form className="login100-form validate-form" name="signin" id="signin" method="post">
					<div className="forgot-p">
						<span className="login100-form-title p-b-26">
						Forgot Password
						</span>
						<p>You can reset your password here.</p>
					</div>
					<div className="wrap-input100 validate-input   m-b-23" >
						<input className="input100" name="email_signin" id="email_signin" placeholder="Email" required="" type="text" onChange={this.handleForgot.bind(this) }/>
					</div>
					<div className="container-login100-form-btn">
						<div className="wrap-login100-form-btn">
						<div className="login100-form-bgbtn"></div>
						<button className="login100-form-btn" onClick={this.submitForgot.bind(this) }>
						Reset Password
						</button>
						</div>
					</div>					
						<a class="for_log" onClick={this.Loginchange.bind(this) }>
						  Login
						</a>                   				
					</form>			
				</div>
				</div>
				</div>
		);
	}
}
export default ForgotPassword;