import React, { Component } from 'react';
import ReactDOM from 'react-dom';
import languageJson from '../assets/json/language.json';
import configJson from '../assets/json/config.json';


class HeaderMenu extends React.Component {
  constructor(props)
  {
    super(props);
    this.state = {};
    this.state.menu = {};   
    this.state.menu = languageJson.english;   
    const userName = localStorage.getItem('loggedInUser');    
    localStorage.setItem('configJson', JSON.stringify(configJson));
    this.logout = this.logout.bind(this);    
  }

  componentDidMount() {   
    let currLocation = window.location.pathname;
    let hashLocation = window.location.hash;
    hashLocation     = hashLocation.substr(1);
    let loggedInUser   = JSON.parse(localStorage.getItem('loggedInUser'));
    if(!loggedInUser)
    {
      loggedInUser = {};
    }

    let restrictedArea = configJson.restrictedArea;
    if( !loggedInUser.id && restrictedArea.indexOf(hashLocation) != -1)
    {   
      window.location.hash = '/login'; 
    } 
  }

  logout()
  {     
    localStorage.removeItem('loggedInUser');  
  }
   render() {
    const configJson      = JSON.parse(localStorage.getItem('configJson'));    
    let loggedInUser   = JSON.parse(localStorage.getItem('loggedInUser'));
    if(!loggedInUser)
    {
       loggedInUser = {};
    }
   
      return ( 
            <nav className="navbar navbar-default main-nav navbar-fixed-top">
              <div className="container">
                <div className="navbar-header">
                  <button type="button"  className="navbar-toggle collapsed" data-toggle="collapse" data-target="#nav-clps" aria-expanded="false">
                  <span className="sr-only">Toggle navigation</span>
                  <span className="icon-bar"></span>
                  <span className="icon-bar"></span>
                  <span className="icon-bar"></span>
                  </button>
                  <a className="navbar-brand" href="/"><img src="assets/images/logo/logo11.png" alt="logo" /></a>
                </div>
                <div className="collapse navbar-collapse" id="nav-clps">
                  <ul className="nav navbar-nav navbar-right">
                  
                    <li><a  href={ this.state.menu.HOME }>Home</a></li>
                    <li><a href={ this.state.menu.ABOUT }>About</a></li>
                    <li><a href={ this.state.menu.FEATURES }>Feature</a></li>
                    <li><a href={"http://"+ (configJson.envMode == 'production' ? 'blog' : 'stagingblog') + ".classgenie.in/"} target="_blank">Blog</a></li>
                    <li><a href={"http://"+ (configJson.envMode == 'production' ? 'faq' : 'stagingfaq') + ".classgenie.in/"} target="_blank">Faq's</a></li>
                    <li><a href={ this.state.menu.CONTACT }>Contact</a></li>
                  
                    { (loggedInUser.id > 0) ? <li><a  onClick={ this.logout.bind(this) } href="/#/login"><button type="text" className='login-t'>Logout</button></a></li> : <li><a  href='/#/login'><button type="text" className='login-t'> Teacher Login </button></a></li> }
                  
                  </ul>
                
                </div>
              </div>
            </nav>
      );
   }
}

class HeaderDefault extends React.Component {
   render() {	    
      return ( 
      	<header className="header pageRow overflow-visible fixed-header">
            <div className="wrapper">
                <div className="header-outer">
                    <div className="header-inner">
                        <HeaderMenu/>
                    </div>
                </div>
            </div>
        </header>
        
      );
   }
}



class HeaderWrapper extends Component {
   render() {
      return (
         <div>
           <HeaderDefault/>        
         </div>
      );
   }
}
export default HeaderWrapper;