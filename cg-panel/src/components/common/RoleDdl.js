import React, { Component } from 'react';
import ReactDOM from 'react-dom';
import axios from 'axios';


class RoleDdl extends React.Component {

  constructor(props)
  {
    super(props);
    this.state = {'role':[]};   
   
  }
  render() {
    return (
		<select className={this.props.classList} id={this.props.id} name={this.props.name} onChange={this.props.changeHandeler} value={this.props.value}>
			<option value="">Role</option>
			<option value="2">Teacher</option>
			<option value="1">Principal</option>
			<option value="5">Vice Principal</option>
		</select>
    );
  }
}


export default RoleDdl;