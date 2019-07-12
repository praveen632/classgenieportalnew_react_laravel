import React, { Component } from 'react';
import ReactDOM from 'react-dom';
import axios from 'axios';
import UserManagement from '../services/UserManagement';
import Encryption from '../assets/js/common/encryption.js';
import config from '../assets/json/config.json';
import ForgotPasswordCss from '../assets/css/forgot_password.css';

class Message extends Component {
	constructor(props)
	{
		super(props);
		this.state = {value: ''};
		let query = new URLSearchParams(this.props.location.search)
        let token = query.get('token')
        let member_no = query.get('member_no')
        let token_parent = query.get('token_parent')
        let query_str = '';
       	  if(token != '' && token != null && token != 'undifine'){
            query_str = 'token_student='+token;
          }else if(member_no != '' && member_no != null && member_no != 'undifine'){
             query_str = 'member_no='+member_no;
          }else if(token_parent != '' && token_parent != null && token_parent != 'undifine'){
            query_str = 'token_parent='+token_parent;
          }
          axios.get(config.api_url+':'+config.port+'/parent/message?'+query_str+'&token='+config.api_token)
		    .then(response => {
		    	 this.setState({ value: response.data});
		    })
		    .catch(function (error) {
		       window.global.fclog(error);
		    })
	}

	render(){
		return(
			<section id="pageTitleBox" className="pageRow paralax skew skew-bottom newbg " >
            <div className="wrapper">
             <div className="container">
                <div className="row">
                    <div className="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                        <h1 className="page-title ralewayLight whiteTxtColor titleWithIcon  msg_bottom">
                            Classgenie Message
                        </h1>
                        <div className="storelinks-container  margin-b-msg">
                            <div className="container">
                             <div className="center_block">
                              <div className="thnkyou_icon"><span class="glyphicon glyphicon-envelope"></span></div>
                                <p>{this.state.value.message}
                                </p>
                              </div>
                            </div>
                        </div>
                    </div>
                </div>
              </div>
            </div>
          <div className="skew_appended whiteSection"></div>
        </section>
		);
	}
}

export default Message;