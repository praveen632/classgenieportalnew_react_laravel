import React from 'react';
import ReactDOM from 'react-dom';
import {HashRouter as Router, Route} from 'react-router-dom';

import AddItem from './components/AddItem';
import IndexItem from './components/IndexItem';
import EditItem from './components/EditItem';

import FooterWrapper from './components/Footer';
import HeaderWrapper from './components/Header';
import Login from './components/Login';
import UserDashboard from './components/UserDashboard';
import ClassManagement from './components/ClassManagement';
import TeacherManagement from './components/TeacherManagement';
import ForgotPasswordUpdate from './components/ForgotPasswordUpdate';
import Message from './components/Message';
import Edit_Teacher from './components/Edit_Teacher';
import Add_Student from './components/Add_Student';
import Upload_CSV from './components/Upload_CSV';
import Student_List from './components/Student_List';


class AppRouter extends React.Component {
   render() {
      return (
         <Router>
            <div>   
				<Route exact path='\/login' component={Login} />
				<Route exact path='\/accountsetting' component={UserDashboard} />
				<Route exact path='\/classmanagement' component={ClassManagement} />
				<Route exact path='\/teachermanagement' component={TeacherManagement} />
            <Route exact path='\/forgotpasswordupdate' component={ForgotPasswordUpdate} /> 
            <Route exact path='\/message' component={Message} />
            <Route exact path='\/edit_teacher' component={Edit_Teacher} /> 
            <Route exact path='\/add_student' component={Add_Student} /> 
            <Route exact path='\/upload_csv' component={Upload_CSV} /> 
            <Route exact path='\/student_list' component={Student_List} /> 
            </div>
         </Router>
      );
   }
}

ReactDOM.render(<HeaderWrapper />, document.getElementById('header'));
ReactDOM.render(<AppRouter />, document.getElementById('main'));
ReactDOM.render(<FooterWrapper />, document.getElementById('footer'));

