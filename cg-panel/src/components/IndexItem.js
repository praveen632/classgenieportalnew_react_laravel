import React, { Component } from 'react';
import { Link } from 'react-router-dom';
import ItemService from '../services/ItemService';
import axios from 'axios';
import TableRow from './TableRow';
import config from '../assets/json/config.json';

class IndexItem extends Component{
	
	constructor(props){
		super(props);
		this.state = {items:''}
	}
    
    componentDidMount(){
	      axios.get(config.api_url+':'+config.port+'/api/applicant_details')
	      .then(
	      	response => { window.global.fclog(response);
	      	window.global.fclog(config);
	        this.setState({ items: response.data });
	      })
	      .catch(function (error) {
	        window.global.fclog(error);
	      })
    }
    
    tabRow(){
        if(this.state.items instanceof Array){
            return this.state.items.map(function(object, i){
                 return <TableRow obj={object} key={i} />;
            })
        }
    }

	render(){
		return(
			<div className="container">
			    <div className="row">
			        <Link to="/add-item">Add Item</Link>
			    </div>
			    <table className="table table-striped">
	              <thead>
	                <tr>
	                  <td>ID</td>
	                  <td>Item</td>
	                </tr>
	              </thead>
	              <tbody>
               		   {this.tabRow()}
                  </tbody>
	            </table>
			</div>
		);
	}
}

export default IndexItem;