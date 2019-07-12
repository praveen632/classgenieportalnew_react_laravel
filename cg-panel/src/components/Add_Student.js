import React from 'react';
import ItemService from '../services/ItemService';
import axios from 'axios';
import config from '../assets/json/config.json';

class AddStudentBox extends React.Component {

  constructor(props)
  {
    super(props);
   
  }


  render() {
  	
    return (
      
		<div id={'TextBoxDiv'+ this.props.keyChild} key={'TextBoxDiv'+ this.props.keyChild}>
		    <label  key={'label'+ this.props.keyChild}>Student {this.props.keyChild} : </label>			   
		    <input  key={'stInput'+ this.props.keyChild} type="text" className="form-control add_student" name={'student'+ this.props.keyChild} ref={'student'+ this.props.keyChild} onChange={this.props.parentObj.handleChange}  onBlur={this.props.parentObj.handleBlur} />
		    <button key={'rmButton'+ this.props.keyChild} className={this.props.notLastElement + " remove " + this.props.classForRemove} onClick={this.props.parentObj.removeOption} >-</button>
		    <p className="text-danger">{this.props.errorMessage}</p>
		</div>
       
    );
  }

}

class Add_Student extends React.Component {

    constructor(props) {
        super(props);        
        this.state = {
            noOfField:[1],
            name_list:[],
            message_list:[],
            showAddButton : '',
            showRemoveButton : 'hide',
            submissionClass:'hide',
            duplicateOn:[]
        }
        this.handleChange = this.handleChange.bind(this)
        this.handleBlur   = this.handleBlur.bind(this)
        this.handleSubmit = this.handleSubmit.bind(this)
		this.removeOption = this.removeOption.bind(this)
		this.addOption 	  = this.addOption.bind(this)		
    }

    componentWillMount() {
    	const stateCopy = Object.assign({}, this.state);
        stateCopy.message_list['student1'] = '';     
        this.setState(stateCopy);
    }

    handleChange(event) {
        const name = event.target.name;
        const stateCopy = Object.assign({}, this.state); //creating copy of object
        stateCopy.name_list[name] = event.target.value; //updating value
        this.setState(stateCopy);
    }

    handleBlur(event) {

        const name = event.target.name;
        const stateCopy = Object.assign({}, this.state); 
        stateCopy.duplicateOn = ''      
        const student_details = this.state.name_list;
        const currArray = this.state.noOfField;
        for(var k=1; k<=currArray.length; k++)
		{
			
			if(event.target.value && event.target.value == student_details['student'+k] && name != ('student'+k) )
			{
				//stateCopy.name_list[name] = '';
				//stateCopy.duplicateOn = name;
				stateCopy.message_list[name] = 'Duplicate value not allowed.';	
			}			
					
		}
		this.setState(stateCopy);
		
    }

    addOption(event){

    	const currArray = this.state.noOfField;
    	currArray.push(1);
    	const messageName = 'student'+ currArray.length;

    	const stateCopy = Object.assign({}, this.state);
        stateCopy.message_list[messageName] = '';
        stateCopy.noOfField = currArray; 
        this.setState(stateCopy);
    	
    	if(currArray.length >= 10)
    	{    		
    		this.setState({showAddButton : 'hide'});
    	}
    	if(currArray.length >= 2)
    	{    		
    		this.setState({showRemoveButton : ''});
    	}    	
    	event.preventDefault();
    }
    removeOption(event){

		const currArray = this.state.noOfField;
		currArray.pop();
		this.setState({noOfField:currArray});
		if(currArray.length < 10)
    	{    		
    		this.setState({showAddButton : ''});
    	}
    	if(currArray.length < 2)
    	{    		
    		this.setState({showRemoveButton : 'hide'});
    	}
		event.preventDefault();
	}
    handleSubmit(e) {
        e.preventDefault();        
		const currArray = this.state.noOfField;
		const student_data_list = [];
		const student_details = this.state.name_list;
		var invalidForm  = '';
		const stateCopy = Object.assign({}, this.state);              
        
		for(var k=1;k<=currArray.length;k++)
		{
			if(!student_details['student'+k])
			{
				invalidForm = true;
				stateCopy.message_list['student'+k] = 'This is required field.';
			}
			else
			{
				stateCopy.message_list['student'+k] = '';
			}	
					
	   		var student_data = {
	            name: student_details['student'+k],
	            class_id: this.props.class_id          
	        };
	        student_data_list.push(student_data); 
		}
		
		if(invalidForm)
		{	
			this.setState(stateCopy);		
			return false;
		}
 		
        axios.post(config.api_url+':'+config.port+'/addstudent/multiple',{data:JSON.stringify(student_data_list),token:config.api_token})
	      .then(function (response) {	      	
	      	

			if(response.data.status == 'Success')
			{	
				this.setState({submissionClass:''});
				setTimeout(function() { this.props.parentObj.changeStep('view',this.props.class_id,this.props.class_name); }.bind(this), 2000);		            
			    	  
				
			}
			else
			{
				alert('We are unable to add.');	           		
			}

	      }.bind(this))
	      .catch(function (error) {

	      });	     

    }
	render(){	
		const currObj = this;
		//const currArray = this.state.noOfField;
		//const totalElement = currArray.length;
		const totalElement = this.state.noOfField.length;	
		return(			
				<div class="col-md-9  admin-content">
					<div class="teacher-m">
						<h3 class="panel-title">Add Student</h3>
					</div>
					<div class={ this.state.submissionClass + ' alert alert-success'} ><strong>Student record has been added successfully.</strong></div>
		        <div className="input_fields_wrap">
		            <div className="row">
		                <div className="col-md-3">
		                    <button className={"add "+this.state.showAddButton} onClick={this.addOption} >+</button></div>
		            </div>
		            {this.state.noOfField.map(function(item, index) { return (

			        	<AddStudentBox key={index+1} keyChild={index+1} parentObj={currObj} classForRemove={currObj.state.showRemoveButton} notLastElement={totalElement<=(index+1) ? '' : 'hide' } errorMessage={currObj.state.message_list['student'+ (index + 1)]}/>

					) })}
		            <input name="classId" id="classId" value="" type="hidden"/>
		            <input name="classname" id="classname" value="" type="hidden"/>
		            <div className="login-bottom login-bottom1 submit-bootm">
		                <div className="submit new_submit">
		                    <input className="btn btn-primary" value="Save" type="button" onClick={this.handleSubmit}/>
		                </div>
		                <div className="clear"></div>
		            </div>

		        </div>
			    
			</div>
		);
	}
}

export default Add_Student;