import React from 'react';
import ReactDOM from 'react-dom';
import { Link } from 'react-router-dom';
import axios from 'axios';
import InnerTopMenuWrap from './common/InnerTopMenu';
import InnerLeftMenuWrap from './common/InnerLeftMenu';
import config from '../assets/json/config.json';
import { confirmAlert } from 'react-confirm-alert';
import 'react-confirm-alert/src/react-confirm-alert.css'


class TeacherManagement extends React.Component {
  constructor(props)
  {
    super(props);
    this.flag = {};
    this.state = {
      teacher: []
    };
    this.changeStatus  = this.changeStatus.bind(this); 
    this.DeleteData = this.DeleteData.bind(this);    
  }

  handleTabChange(event) 
  {
    const name = event.tabName;  
    const stateCopy = Object.assign({}, this.state);    //creating copy of object
    stateCopy.tabStep = name;                        //updating value
    this.setState(stateCopy);    
  }

  componentDidMount() {
    //import config from '../assets/json/config.json';const configJson  = JSON.parse(localStorage.getItem('configJson'));
    const userDetails  = JSON.parse(localStorage.getItem('loggedInUser'));
      axios.get(config.api_url+':'+config.port+'/schools/portal_teacherlist?school_id='+userDetails.school_id+'&token='+config.api_token)
      .then(function (response) {          
        if(response.data.status == 'Failure'){//alert('');          
        }
        else if(response.data.status == 'Success'){
           this.setState({ teacher: response.data.Teacher_list});           
        }

        }.bind(this))
        .catch(function (error) {         
            this.state.userSignIn = {};
        }.bind(this));
  }

 
changeStatus(e){    
   let member_no = e.member_no;
   if(e.status == 1){
      var flag = '2';
   }else{
      var flag = '0';
   }
   axios.get(config.api_url+':'+config.port+'/teacher/status?member_no='+member_no+'&flag='+flag+'&token='+config.api_token)
      .then(function (response) {          
        if(response.data.status == 'Failure'){
          alert('DataBase Error!!');          
        }
        else if(response.data.status == 'Success'){
           alert('Successfully Submit!!');
           window.location.reload();       
        }
        }.bind(this))
        .catch(function (error) {         
            this.state.userSignIn = {};
        }.bind(this));   
  }

  DeleteData(e){
    let member_no = e.member_no;    
confirmAlert({                          
      message: 'Are you sure to Delete this.',
      confirmLabel: 'Confirm',                        
      cancelLabel: 'Cancel',                             
      onConfirm: () => {     
       axios.post(config.api_url+':'+config.port+'/teacher/remove_teacher_portal', {
            member_no: member_no,           
            token:config.api_token            
         })
      .then(function (response) {          
        if(response.data.status == 'Failure'){
          alert('DataBase Error!!');          
        }
        else if(response.data.status == 'Success'){
           alert('Successfully Deleted!!');
           window.location.reload();      
        }
        }.bind(this))
        .catch(function (error) {         
            this.state.userSignIn = {};
        }.bind(this));
      },    
      onCancel: () => {},     
    })
  }
   render() {
    let leftMenuArray = [];
    let leftMenuStr = JSON.stringify(leftMenuArray);
     let currentObjv = this;
       return (      
      
<section  class="about-section  text-center   privacy-mar">
<div class="container">
  <div class="">
    <div class="about-feat text-left about-left">
      <div class="col-lg-12 col-md-12  col-xs-12">
        <div class="feature-list featured-right">
        <InnerTopMenuWrap/>    
          <div>
            <div class="row">
              <div class="col-md-12  admin-content">
              <div class="teacher-m">
                    <h3 class="panel-title">Teacher List</h3>
                  </div>
                  
                  <div>
                    <table class="table table-bordered table-striped  mar-b">
                      <thead>
                        <tr>
                          <th>Teacher Name</th>
                          <th>Email</th>
                          <th>Member Number</th>
                          <th>Status</th>
                          <th>Role</th>
                          <th>Remove</th>
                          <th>save</th>
                        </tr>
                      </thead>
                      <tbody>
                      {this.state.teacher.map(function(item, key) {            
                        return (         
                           <tr key = {key}>
                               <td>{item.name}</td>
                               <td>{item.email}</td>
                               <td>{item.member_no}</td>
                                 <td> {item.status == '1' ?
                               <button class="btn btn-primary" onClick={currentObjv.changeStatus.bind(this,item)}>Activate</button> :
                               <button onClick={currentObjv.changeStatus.bind(this,item)} className="btn btn-primary" data-
                              >Deactivate</button>}
                               </td>
                                <td>{(() => {
                                         switch (item.type) {
                                           case "1":   return "Principal";
                                           case "2": return "Teacher";
                                           case "5":  return "Vice Principal";          
                                         }
                                       })()}</td>
                                 <td><button type="button" onClick={currentObjv.DeleteData.bind(this,item)} id="" className="btn btn-danger"> <span className="glyphicon glyphicon-trash"></span></button></td>
                                 <td>
                                      <Link className="btn btn-primary" to={'edit_teacher?member_no='+item.member_no}><span className="glyphicon glyphicon-pencil"></span></Link>
                                 </td>
                              </tr>
                                   )})}              
                      </tbody>
                    </table>
                  </div>
          
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


export default TeacherManagement;