import React, { Component } from 'react';
import { Link } from 'react-router-dom';
import ItemService from '../services/ItemService';
import config from '../assets/json/config.json';

class AddItem extends Component{
    constructor(props){
        super(props);
        this.state = {item: ''};
        this.addItemService = new ItemService();
        this.handleChange = this.handleChange.bind(this);
        this.handleSubmit = this.handleSubmit.bind(this);
    }
    
    handleChange(event){
       this.setState({item: event.target.value});
    }
    
    handleSubmit(event){
    	event.preventDefault();
        this.addItemService.sendData(this.state.item);
    }

	render(){
		return(
			<div className="container">
                <div className="row">
                    <Link to="/">List Item</Link>
                </div>
			    <form onSubmit={this.handleSubmit}>
			         <label> 
			              <input type="text"  value={this.state.item} onChange={this.handleChange} className="form-control"/>
			        </label><br/>
			        <input type="submit" value="Submit" className="btn btn-primary"/>
                    <Link to="/" className="btn btn-info">Cancel</Link>
			    </form>
			</div>
		);
	}
}
export default AddItem;