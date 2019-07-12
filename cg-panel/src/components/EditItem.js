import React, { Component } from 'react';
import {Link} from 'react-router-dom';
import axios from 'axios';
import ItemService from '../services/ItemService';
import config from '../assets/json/config.json';

class EditItem extends Component {
   
    constructor(props){
    	super(props);
    	this.ItemService = new ItemService();
    	this.state = {value: '' };
    	this.handleChange = this.handleChange.bind(this);
    	this.handleSubmit = this.handleSubmit.bind(this);
    }

    componentDidMount(){
	    axios.get(config.api_url+':'+config.port+'/api/applicant_details/'+this.props.match.params.id)
	    .then(response => {
	      this.setState({ value: response.data});
	    })
	    .catch(function (error) {
	       window.global.fclog(error);
	    })
   }


  handleChange(event) {
     this.setState({value: event.target.value});
  }

  handleSubmit(event){
  	 event.preventDefault();
     this.ItemService.updateData(this.state.value,this.props.match.params.id);
  }

   render(){
   	  return(
   	  	     <div className="container">
   	  	           <form onSubmit={this.handleSubmit}>
		              <label>
		                <input type="text" value={this.state.value.name} onChange={this.handleChange}  className="form-control"/>
		              </label><br/>
		              <input type="submit" value="Update" className="btn btn-primary"/>
		              <Link to="/" className="btn btn-info">Cancel</Link>
		           </form>
   	  	     </div>
   	  	);
   }

}

export default EditItem;