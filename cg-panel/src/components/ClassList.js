import React, { Component } from 'react';
import ReactDOM from 'react-dom';
import { Link } from 'react-router-dom';
import axios from 'axios';
import config from '../assets/json/config.json';
import StudentList from './Student_List';
import UploadCSV from './Upload_CSV';
import AddStudent from './Add_Student';

class ClassList extends Component{	
constructor(props) {
  super(props);  
  this.state = {
      class_list: [],
      step:'classList',
      class_id:null,
      class_name:null
  }
  this.handleChange       = this.handleChange.bind(this)
  this.handleSubmit       = this.handleSubmit.bind(this)
  this.switchingComponent = this.switchingComponent.bind(this)
  this.changeStep         = this.changeStep.bind(this)
}

switchingComponent()
{
  const tabName = this.state.step;
   if(tabName === 'add')
   {
      return <AddStudent class_id={this.state.class_id} class_name={this.state.class_name} parentObj={this} />
   }
   else if(tabName === 'upload')
   {
      return <UploadCSV class_id={this.state.class_id} class_name={this.state.class_name} parentObj={this}/>
   } 
   else if(tabName === 'view')
   {
      return <StudentList class_id={this.state.class_id} class_name={this.state.class_name} /> 
   }    
   else
   {     
     return this.classListForm();
   }
}

componentWillMount() {
    const userDetails = JSON.parse(localStorage.getItem('loggedInUser'));
    axios.get(config.api_url + ':' + config.port + '/classinfo/dashboard?teacher_ac_no=' + userDetails.member_no + '&token=' + config.api_token)
      .then(function(response) {
          if (response.data.status == 'Failure') {   
          } else if (response.data.status == 'Success') {
              this.setState({
                  class_list: response.data.user_list,                  
              });
          }
      }.bind(this))
      .catch(function(error) {
          this.state.userSignIn = {};
      }.bind(this));
}

componentDidMount()
{
   this.setState({step:'classList'});
}

handleChange(event) {
    const name = event.target.name;
    const stateCopy = Object.assign({}, this.state); //creating copy of object
    stateCopy.class_list[name] = event.target.value; //updating value
    this.setState(stateCopy);   
}

changeStep(stepVal,class_id, class_name) {
  this.setState({step:stepVal});
  this.setState({class_id:class_id});
  this.setState({class_name:class_name});
}

handleSubmit(e) {
    e.preventDefault() 
}

classListForm()
{
  const currObj = this;
  return( 
        <div>
        <div class="row">
        <div class="col-md-12  admin-content">
        <div class="teacher-m">
                <h3 class="panel-title">Class List</h3>
            </div>
            <div>
                <table class="table table-bordered table-striped  mar-b">
                <thead>
                    <tr>
                        <th>Class Name</th>
                        <th>Grade</th>
                        <th>Status</th>
                        <th>Upload CSV</th>
                        <th>Student List</th>
                    </tr>
                </thead>
                <tbody>               
                {this.state.class_list.map(function(item, key) { return (
                    <tr key={ key}>
                        <td>{item.class_name}</td>
                        <td>{item.grade}</td>
                        <td><a class="activate" onClick={()=>currObj.changeStep('add',item.class_id,item.class_name)}>Add Student</a></td>
                        <td><a class="activate" onClick={()=>currObj.changeStep('upload',item.class_id,item.class_name)}>Upload CSV</a></td>
                        <td><a class="activate" name="step" value="view" onClick={()=>currObj.changeStep('view',item.class_id,item.class_name)}>View</a></td>
                    </tr>
                    ) })}
                </tbody>
                </table>
            </div>
        </div>
        </div>
        </div>
  );
}

render(){
	let currentObjv = this;		
		return(			
      <div>{this.switchingComponent()}</div>    
		);
	}
}

export default ClassList;