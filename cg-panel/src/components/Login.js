import React, { Component } from 'react';
import ReactDOM from 'react-dom';
import axios from 'axios';
import RoleDdl from './common/RoleDdl';
import ForgotPassword from './ForgotPassword';
import AddSchool from './AddSchool';
import config from '../assets/json/config.json';
import {Link } from 'react-router-dom';

import CustomAutosuggest from './common/CustomAutosuggest';

class Login extends Component {

 constructor(props)
 {
  super(props);  
  this.state     = {};    
  this.state.step   = "login";
  this.state.userSignIn  = {};
  this.state.school_id  = 0;
  this.state.school_name  = '';
  this.state.dynamicClass  = 'wrap-login100';
  this.state.userSignIn  = {};
  this.handleChange   = this.handleChange.bind(this);
  this.handleInputChange  = this.handleInputChange.bind(this);  
  this.switchingComponent  = this.switchingComponent.bind(this); 
  this.submitSignup  = this.submitSignup.bind(this); 
  this.checkuser  = this.checkuser.bind(this);   
 }

 componentDidMount() {      
    let loggedInUser   = JSON.parse(localStorage.getItem('loggedInUser'));
    if(!loggedInUser)
    {
      loggedInUser = {};
    }    

    if( loggedInUser.id > 0 )
    {
      this.props.history.push('/accountsetting');      
    } 
    if(document.documentMode || /Edge/.test(navigator.userAgent))
    {
      this.setState({'dynamicClass':'wrap-login100 IE-name'});
    }
  }

 handleChange(event) 
 {
  const name = event.target.name;  
  const stateCopy = Object.assign({}, this.state);    //creating copy of object
  stateCopy.step = name;                        //updating value
  this.setState(stateCopy);  
 }

 handleInputChange(event) {
     const name = event.target.name;  
     const stateCopy = Object.assign({}, this.state);    //creating copy of object
     stateCopy.userSignIn[name] = event.target.value;                        //updating value
     this.setState(stateCopy);
   }

   submitSignin(event) {
    event.preventDefault();
      //  Check Validation befor api hits
    var re = /^(([^<>()\[\]\\.,;:\s@"]+(\.[^<>()\[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
		if (!re.test(String(this.state.userSignIn.email_signin).toLowerCase())) {
			alert(' Please Check Email And Password');
			this.state.userSignIn.email_signin = '';
			return false;
    }
      if (this.state.userSignIn.password_signin == undefined || this.state.userSignIn.password_signin=="") {
        alert(' Please Check Email And Password');
        this.state.userSignIn.password_signin = '';
        return false;
      
        }
    const configJson  = JSON.parse(localStorage.getItem('configJson'));       
     axios.get(configJson.api_url+':'+configJson.port+'/login?email='+this.state.userSignIn.email_signin+'&password='+this.state.userSignIn.password_signin+'&token='+configJson.api_token)
       .then(function (response) {         
          if(response.data.status == 'Failure'){ 
                 alert('Wrong Email or password');     
           }
            else if(response.data.status == 'Success'){
              localStorage.setItem('loggedInUser', JSON.stringify(response.data.user_list[0]));
              this.props.history.push('/accountsetting');
               window.location.reload(); 
              }
       }.bind(this))
       .catch(function (error) {        
         this.state.userSignIn = {};
       }.bind(this));
   }  

   switchingComponent()
   {   
   	 if(this.state.step === 'signup')
   	 {
   	 	return this.signupForm();
   	 } 
   	 else if(this.state.step === 'forgot')
   	 {
   	 	return <ForgotPassword />;
   	 }
     else if(this.state.step === 'addSchool')
     {
      return <AddSchool parentObject={this} />;
     }
   	 else
   	 {       
   	 	 return this.loginForm();
   	 }
   }

   checkuser(){
    var datas = { 
      school_id:this.state.school_id,
      role:this.state.userSignIn.role,      
    }
    if (datas.role == 1 || datas.role == 5) {
     axios.get(config.api_url+':'+config.port+'/schools/checkuser?role='+datas.role+'&school_id='+datas.school_id+'&token='+config.api_token)
    .then(function (response) {         
      if(response.data.existStatus == 'exist'){
        alert("Principal/Viceprincipal Already Exist");
      }else{       
       return true;
      }
    })
    .catch(function (error) {
      this.state.userSignIn = {};
    });
  }else{
        return true;
      }
  }
 
  submitSignup(event)
  {
    event.preventDefault(); 
    var letter = /^[a-zA-Z '.-]+$/;
    var re = /^(([^<>()\[\]\\.,;:\s@"]+(\.[^<>()\[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
     var password =this.state.userSignIn.password_signup;
     var phoneno = /^\d{10}$/;
    // console.log(this.state.userSignIn.password_signup);  
    var data = { 
      name:this.state.userSignIn.name,
      email:this.state.userSignIn.email_signup,
      password:this.state.userSignIn.password_signup,
      phone:this.state.userSignIn.phone,
      usertype:this.state.userSignIn.role,
      school:this.state.school_id,
      token:config.api_token
    }
         // check Name is valid or not
    if(this.state.userSignIn.name == "" || this.state.userSignIn.name == undefined)
    {
      alert('Please Enter the Valid name ');
      this.state.userSignIn.name = '';
      return false;
    }
   
      // check school is valid or not
      else if(this.state.school_id == "" || this.state.school_id == 0)
      {
        alert('Please Add school in School List');
        this.state.school_name = '';
        return false;
      }

          // check Email is valid or not
         else if (!re.test(String(this.state.userSignIn.email_signup).toLowerCase()))
          {
            alert('Please Enter the Valid Email ');
            this.state.userSignIn.email_signup = '';
            return false;
          }
         

          // check Mobile length
          else  if (this.state.userSignIn.phone== "" || this.state.userSignIn.phone == undefined)
        {
       alert( 'Mobile Number must be 10 digits',);
        this.state.userSignIn.phone = '';
           return false;
         } 


     // check Password length
          else  if (this.state.userSignIn.password_signup < 6 || this.state.userSignIn.password_signup == undefined)
         {
             alert('Password must be at least 6 characters long.');
             this.state.userSignIn.password_signup = '';
               return false;
         }
    
     

  
    this.checkuser();
    axios.post(config.api_url+':'+config.port+'/teacher/'+'?flag=portal', data)
    .then(function (response) {         
      if(response.data.status == 'Failure'){
        alert('Email already Exist');
      }
      else if(response.data.status == 'Success'){
       localStorage.setItem('loggedInUser', JSON.stringify(response.data.user_list[0])); 
       window.location.reload();      
      }

    })
    .catch(function (error) {
    });
  }
 loginForm()
 {  
  return (
          <div className="limiter">
          <div className="container-login100">
            <div className={this.state.dynamicClass}>
              <form className="login100-form validate-form" name="signin" id="signin" method="post">
                <span className="login100-form-title p-b-26">
                Login
                </span>
                <div className="wrap-input100 validate-input   m-b-23" >
                  <input className="input100" name="email_signin" id="email_signin" placeholder="Email" required="" type="text" onChange={this.handleInputChange.bind(this) }/>
                </div>
                <div className="wrap-input100 validate-input">
                  <span className="btn-show-pass">
                  <i className="zmdi zmdi-eye"></i>
                  </span>
                  <input className="input100" name="password_signin" id="password_signin" placeholder="Password" required="" type="password"  onChange={this.handleInputChange.bind(this) }/>
                </div>
                <div className="text-right p-t-8 p-b-31">
                  <a onClick={this.handleChange.bind(this) } name="forgot" style={{cursor:'pointer'}}>
                  Forgot password?
                  </a>
                </div>
                <div className="container-login100-form-btn">
                  <div className="wrap-login100-form-btn">
                    <div className="login100-form-bgbtn"></div>
                    <button className="login100-form-btn"  onClick={this.submitSignin.bind(this) }>
                      Login 
                    </button>         
                  </div>
                </div>
                <div className="text-center p-t-115">
                  <span className="txt1">
                  Don’t have an account?
                  </span>
                  <button> 
                  <a onClick={this.handleChange.bind(this) }  name="signup" className="txt2">Sign up now</a> 
                  </button>        
                </div>
              </form>
            </div>
          </div>
          </div>

  );
 }

  searchReturn(school)
  {
    this.setState({'school_id':school.key,'school_name':school.text});   
  }

 signupForm()
 {
    var hideDisplay = {
      display: 'none'
    }
    var showDisplay = {
      display: ''
    } 
    let forName =['school_name', 'city', 'state'];
    let forKey =['school_id']; 
   
  return (  
      <div className="limiter">
      <div className="container-login100">
        <div className="wrap-login100  mar45">
          <form className="login100-form validate-form" name="signup" id="signup" method="post" onSubmit={this.submitSignup}>
            <span className="login100-form-title p-b-26">
            Sign Up for Free
            </span>
            <div className="wrap-input100 validate-input   m-b-23">
              <input className="input100" value={this.state.userSignIn.name} name="name" id="name" placeholder="Your Name" required="" type="text" onChange={this.handleInputChange}/>
            </div>
            <div className="wrap-input100 validate-input  m-b-23">        
              <RoleDdl key="role" id="role" value={this.state.userSignIn.role} name="role" classList="form-control selectnew" changeHandeler={this.handleInputChange}  className="form-control" />
            </div>
            <div className="wrap-input100 validate-input   m-b-23" >   
              <CustomAutosuggest className="input100" parentObject={this} forName={forName} forKey={forKey} ajaxUrl={config.api_url+':'+config.port+'/schools/search'} searchParam="school_name" token="aforetechnical@321!" placeHolder="School Name" dataParam="school_list" selectedValue={this.state.school_name}/>
              <label id="school-error" className="error" htmlFor="school" style={hideDisplay}></label>
                <div id="txtAllowSearchID" className="txtAllowSearchID" style={ (this.state.school_id == 0 && this.state.school_name!='') ? showDisplay : hideDisplay }>
                    <a onClick={this.handleChange.bind(this) } name="addSchool"  style={{cursor:'pointer'}}>Add New School</a>
                </div>
             </div>
            <div className="wrap-input100 validate-input   m-b-23">
              <input className="input100" value={this.state.userSignIn.email_signup} name="email_signup" id="email_signup" placeholder="Email" required="" type="text" onChange={this.handleInputChange}/>
            </div>
            <div className="wrap-input100 validate-input   m-b-23">
              <input className="input100" value={this.state.userSignIn.phone} name="phone" id="phone" placeholder="Mobile" required="" type="text" onChange={this.handleInputChange}/>
            </div>
            <div className="wrap-input100 validate-input">
              <span className="btn-show-pass">
              <i className="zmdi zmdi-eye"></i>
              </span>
              <input className="input100" name="password_signup" id="password_signup" placeholder="Password" required="" type="password" onChange={this.handleInputChange}/>
             </div>
            <div className="container-login100-form-btn">
              <div className="wrap-login100-form-btn">
                <div className="login100-form-bgbtn"></div>
                <button className="login100-form-btn">
                Sign up
                </button>
              </div>
            </div>
            <div className="text-center p-t-115">
                  <span className="txt1">
                  If you are already signup please login
                  </span>
                  <button> 
                  <a onClick={this.handleChange.bind(this) }  className="txt2">Login now</a> 
                  </button>        
                </div>
          </form>
        </div>
      </div>
      </div>
  );
 }

 render() {  
   return (             
    <div id= "middleContainer">{this.switchingComponent()}</div>              
   );
 }
}
export default Login;