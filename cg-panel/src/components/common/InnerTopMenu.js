import React, { Component } from 'react';
import ReactDOM from 'react-dom';
import {Link } from 'react-router-dom';


class InnerTopMenu extends React.Component {

  constructor(props)
  {
    super()
   
  }
  render() {
    return (     
       
       <Link to={this.props.href} activeClassName="active"><i className={this.props.iconClass}></i>{this.props.name}</Link>
    );
  }

}


class InnerTopMenuWrap extends React.Component {
  
  render() {
    return (  
        <ul className="nav nav-tabs  nav-color" role="tablist">
        <li role="presentation" className="active">
          <a key="0" href="#/accountsetting"  >
          <i className="fa fa-cog"></i>Account settings</a>
        </li>
        <li role="presentation">
          <a  key="1" href="#/classmanagement">
          <i className="fa fa-wrench"></i>Class management</a>
        </li>
        <li role="presentation">
          <a  key="2" href="#/teachermanagement">
          <i className="fa fa-cog"></i>Teacher management</a>
        </li>
        </ul>

    );
  }
}


export default InnerTopMenuWrap;