import React, { Component } from 'react';
import ReactDOM from 'react-dom';

class Footer extends React.Component {
   render() {
	   	var footerStyle = {
	   		visibility: 'visible', 
	   		animationDelay: '0.3s', 
	   		animationName: 'bounceIn'
	   	}
	   	var hideDisplay = {
	   		display: 'none'
	   	}
      return ( 
			<footer className=" text-center">
			<div className="container-fluid">
			<div className="col-lg-offset-3 col-lg-6">
				<img src="assets/images/logo2.png" alt="footerlogo" />
			</div>
			<div className="col-lg-offset-3 col-lg-6">
				<div className="socials">
				<a href="https://www.facebook.com/ClassGenie-638010236367664/?fref=ts" className="social"  target="_blank"><i className="fa fa-facebook"></i></a>
				<a href="https://twitter.com/classgenie" className="social"  target="_blank"><i className="fa fa-twitter"></i></a>
				<a href="https://plus.google.com/102188050452858159635" className="social" target="_blank"><i className="fa fa-google-plus"></i></a>
				<a href="https://www.linkedin.com/company/classgenie" className="social" target="_blank"><i className="fa fa-linkedin"></i></a>
				</div>
			</div>
			</div>
			<div className="privacy-footer">
			<div className="container">
				<div className="col-md-8">
				<p>All Right  Reserved 2018  Designed and Coded By Aforetech</p>
				
				</div>
				<div className="col-md-4">
				<a href="/privecy">  
				Privacy plociy    |
				</a>
				<a href="/terms">   
				Terms & Conditions
				</a>
				</div>
			</div>
			</div>
			</footer>
      );
   }
}
class FooterBottom extends Component {
   render() {
      return (
         <div>
            <h2>Footer bottom</h2>
         </div>
      );
   }
}

class FooterWrapper extends Component {
   render() {
      return (
         <div>
           <Footer/>           
         </div>
      );
   }
}
export default FooterWrapper;