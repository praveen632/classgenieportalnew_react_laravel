import React, { Component } from 'react';
import ItemService from '../services/ItemService';
import axios from 'axios';
import config from '../assets/json/config.json';

class AddClass extends Component{	
	constructor(props){
		super(props);
		this.state = {value:''}
		this.state ={
		      class_details:[]
		    }
		    this.handleChange = this.handleChange.bind(this)
		    this.handleSubmit = this.handleSubmit.bind(this)		    
		   }

      handleChange(event) {
	  	const name = event.target.name;  
	    const stateCopy = Object.assign({}, this.state);    //creating copy of object
	    stateCopy.class_details[name] = event.target.value;                        //updating value
	    this.setState(stateCopy);
	  }
    
     handleSubmit(e){   
        e.preventDefault();
        const userDetails  = JSON.parse(localStorage.getItem('loggedInUser'));  
        let abc = { headers: {'Content-Type': 'application/json'}};
        let dataparam = {
	     	teacher_ac_no: userDetails.member_no,
	     	school_id: ''+userDetails.school_id,	
	     	grade : this.state.class_details.grade,
	     	class_name: this.state.class_details.class_name,
	     	token: config.api_token
	     	}      
	    axios.post(config.api_url+':'+config.port+'/classinfo', dataparam) 
        .then(function (response) {          
        if(response.data.status == 'Failure'){
          alert('You are not added more then 10 class');          
        }
        else if(response.data.status == 'Success'){
           alert('Successfully Adding Class!!');
           window.location.reload();      
        }else if(response.data.error_msg == 'Teacher Under verification'){
          alert('Teacher Under verification');
        }else if(response.data.error_msg == 'School Under verification'){
          alert('School Under verification');
        }else if(response.data.error_msg == 'Duplicate Class'){
          alert('Class already exits');
        }else if(response.data.error_msg == 'You are nat join the school'){
          alert('You are nat join the school');
        }else if(response.data.error_msg == 'You are nat Adding more class'){
          alert('You are nat Adding more class');
        }
        }.bind(this))
        .catch(function (error) {         
            this.state.userSignIn = {};
        }.bind(this));
   } 

	render(){		
		return(
			<div class="col-md-9  admin-content">
					<div class="teacher-m list-margin">
						<h3 class="panel-title">Add Class</h3>
					</div>
				<form className="form-label  form-horizontal" onSubmit={this.handleSubmit} >
				   	<div class="form-group">
							<label class="control-label col-sm-3" htmlFor="name">Name:</label>
							<div className="col-sm-9">
							<input type="text" className="form-control" placeholder="Name" name="class_name"onChange={this.handleChange} type="text" required /></div>
							<div className="clear"></div>
						</div>
				    <div class="form-group">
                <label className="control-label col-sm-3" for="grade">Grade:</label>
                 <div className="col-sm-9">
                    <select className="form-control selectnew_grade" onChange={this.handleChange} name="grade" id="grade"  className="form-control" required="true">
                      <option value="">Choose a Grade</option>
                      <option value="1stclass">1st Class</option>
                      <option value="2ndclass">2nd Class</option>
                      <option value="3rdclass">3rd Class</option>
                      <option value="4thclass">4th Class</option>
                      <option value="5thclass">5th Class</option>
                      <option value="6thclass">6th Class</option>
                      <option value="7thclass">7th Class</option>
                      <option value="8thclass">8th Class</option>
                    </select>
                    </div>
                    <div className="clear"></div>
              </div>
		            <div className="form-group">
		            	<label className="control-label col-sm-3">&nbsp;</label>	               
		                <div className="col-sm-9" id="loader_container" htmlFor="name">
		                     <input type="submit" value="Submit" className="btn btn-primary"/>
		                </div>
		                <div className="clear"></div>
		            </div>				       
				    <div className="clear"></div>				    
				</form>
			</div>
		);
	}
}
export default AddClass;