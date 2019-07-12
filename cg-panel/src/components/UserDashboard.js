import React, {Component} from 'react';
import ReactDOM from 'react-dom';
import InnerTopMenuWrap from './common/InnerTopMenu';
import InnerLeftMenuWrap from './common/InnerLeftMenu';
import MyAccount from './MyAccount';
import EditProfile from './EditProfile';
import EditSchool from './EditSchool';
import ChangePassword from './ChangePassword';
import configJson from '../assets/json/config.json';

class UserDashboard extends React.Component {
  constructor(props)
  {
    super(props);
    this.handleTabChange = this.handleTabChange.bind(this); 
    localStorage.setItem('configJson', JSON.stringify(configJson));	
    
  }

  handleTabChange(event) 
  { 
    const tabName = event.target.title;    
    switch(tabName)
    {
      case 'editProfile':
        ReactDOM.render(<EditProfile />, document.getElementById('middleContainer'));
        break;

      case 'editSchool':
        ReactDOM.render(<EditSchool />, document.getElementById('middleContainer'));
        break;

      case 'changePassword':
        ReactDOM.render(<ChangePassword />, document.getElementById('middleContainer'));
        break;

      case 'myAccount':
        ReactDOM.render(<MyAccount />, document.getElementById('middleContainer'));       
        break;     
    }
    
  }
   render() {
	   const configJson = JSON.parse(localStorage.getItem('configJson'));
	  /*const prvurl =  "http://"+ (configJson.envMode == 'production' ? 'classgenie.in' : 'staging.classgenie.in') + "/privecy";
	 const termurl =  "http://"+ (configJson.envMode == 'production' ? 'classgenie.in' : 'staging.classgenie.in') + "/terms/"*/
    let leftMenuArray = [
                          {name:'My Account',type:'tab',href:'', menuClass:'glyphicon glyphicon-user', tabName:'myAccount'},
                          {name:'Edit profile',type:'tab',href:'', menuClass:'glyphicon glyphicon-edit', tabName:'editProfile'},
                          {name:'Edit School Info',type:'tab',href:'', menuClass:'glyphicon glyphicon-edit', tabName:'editSchool'},
                          {name:'Change password',type:'tab',href:'', menuClass:'glyphicon glyphicon-lock', tabName:'changePassword'},
                          /*{name:'Privacy policy',type:'link',href:prvurl, menuClass:'resp-tab-item', tabName:'privacy'},
                          {name:'Terms & Conditions',type:'link',href:termurl, menuClass:'resp-tab-item', tabName:'terms'}*/
                        ];
    let leftMenuStr = JSON.stringify(leftMenuArray);     
      return (      
            <section  className="about-section  text-center   privacy-mar">
            <div className="container">
              <div className="">
                <div className="about-feat text-left absout-left">
                  <div className="col-lg-12 col-md-12  col-xs-12">
                    <div className="feature-list featured-right">
                    <InnerTopMenuWrap/>
                      <div>
                        <div className="row">
                          <div className="col-md-3">
                            <ul className="nav nav-pills nav-stacked admin-menu"  >                        
                              <InnerLeftMenuWrap menuList={leftMenuStr} forClick={this.handleTabChange}/>
                               <li><a href={"http://"+ (configJson.envMode == 'production' ? 'classgenie.in' : 'staging.classgenie.in') + "/privecy"} target="_blank">Privacy policy</a></li>
                               <li><a href={"http://"+ (configJson.envMode == 'production' ? 'classgenie.in' : 'staging.classgenie.in') + "/terms"} target="_blank">Terms & Conditions</a></li>							  
                            </ul>
                          </div>                        
                              <div id="middleContainer">
                              <MyAccount />                                                    
                          </div>
                        </div>
                      </div>                 
                    </div>
                  </div>
                </div>
              </div>
            </div>        
          </section>
      );
   }
}
export default UserDashboard;