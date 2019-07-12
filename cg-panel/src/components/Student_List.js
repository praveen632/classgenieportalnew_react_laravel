import React, {Component} from 'react';
import ItemService from '../services/ItemService';
import axios from 'axios';
import config from '../assets/json/config.json';

class Student_List extends Component {
    constructor(props) {
        super(props);                 
        this.state = {
            teacher: []
        }
        this.handlerChange = this.handlerChange.bind(this)       
    }

    componentWillMount() {
          axios.get(config.api_url+':'+config.port+'/classinfo/studentlistPortal?classId='+this.props.class_id+'&token='+config.api_token)
          .then(function (response) { 
          if(response.data.status == 'Failure'){//alert('');          
            }
            else if(response.data.status == 'Success'){
               this.setState({ teacher: response.data.student_list});           
            }
            }.bind(this))
            .catch(function (error) {         
                this.state.userSignIn = {};
            }.bind(this));
    }

   handlerChange(event){
    let student_name = event.target.value;
      axios.get(config.api_url+':'+config.port+'/classinfo/studentlistPortal?classId='+this.props.class_id+'&student_name='+student_name+'&token='+config.api_token)
      .then(function (response) {                  
            if(response.data.status == 'Failure'){         
            }
            else if(response.data.status == 'Success'){
               this.setState({ teacher: response.data.student_list});           
            }
            }.bind(this))
            .catch(function (error) {         
                this.state.userSignIn = {};
            }.bind(this)); 
   }

   render() {
        let curentObj = this;
        return (
                <div>
                <div class="row">
                <div class="col-md-12  admin-content">
                <div class="teacher-m">
                    <h3 class="panel-title">Student List</h3>
                </div>
                    <div style={{"float":"right","width":"30%"}}>
                    <input type="text" name="class_name" className="form-control" onChange={this.handlerChange}  placeholder="Search By Student Name.."/>
                    </div>
                    <div>
                        <table class="table table-bordered table-striped  mar-b">
                        <thead>
                            <tr>
                                <th>Student Name</th>
                                <th>Class Name</th>                        
                                <th>Student number</th>
                                <th>Parent number</th>
                            </tr>
                        </thead>
                        <tbody>               
                                {this.state.teacher.map(function(item, key) {                    
                                return (
                                <tr key = {key}>
                                <td>{item.stu_name}</td>
                                <td>{curentObj.props.class_name}</td>
                                <td>{item.student_no}</td>
                                <td>{item.parent_no}</td>
                                </tr>
                                )
                            })}
                        </tbody>
                        </table>
                    </div>
                </div>
                </div>
                </div>
                );
             }
}

export default Student_List;