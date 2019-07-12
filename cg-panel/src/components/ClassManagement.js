import React from 'react';
import ReactDOM from 'react-dom';
import InnerTopMenuWrap from './common/InnerTopMenu';
import InnerLeftMenuWrap from './common/InnerLeftMenu';
import { Link } from 'react-router-dom';
import AddClass from './AddClass';
import ClassList from './ClassList';

class ClassManagement extends React.Component {
  constructor(props)
  {
    super(props);
    this.state     = {};    
    this.state.step   = "addClass";
    this.switchingComponent = this.switchingComponent.bind(this);
    this.handleTabChange    = this.handleTabChange.bind(this)
  }

  handleTabChange(event) 
  {
    const tabName = event.target.title;
    switch(tabName){
      case 'addClass':
        this.setState({step:'addClass'});
      break;

      case 'classList':
          this.setState({step:'classList'});
        break;
    }
    
  }

  switchingComponent()
   {   
     const tabName = this.state.step;
     if(tabName === 'addClass')
     {
      return <AddClass />;
     }
     else if(tabName === 'classList')
     {
      return <ClassList parentObj={this}/>;
     }     
     else
     {       
       return <AddClass />;
     }    
   }

   render() {
    let leftMenuArray = [
                          {name:'Add class',type:'tab',href:'', menuClass:'resp-tab-item', tabName:'addClass'},
                          {name:'Class list',type:'tab',href:'', menuClass:'resp-tab-item', tabName:'classList'}                          
                        ];
    let leftMenuStr = JSON.stringify(leftMenuArray);
     
      return (          
        <section  className="about-section  text-center privacy-mar">
      <div className="container">
        <div className="">
          <div className="about-feat text-left about-left">
            <div className="col-lg-12 col-md-12  col-xs-12">
              <div className="feature-list featured-right">
              <InnerTopMenuWrap/>               
                <div>
                <div className="alert alert-success" style={{ 'display': 'none'}}>
                   <strong>Success!</strong>
                  </div>
                  <div className="row">
                    <div className="col-md-3">
                    <ul className="nav nav-pills nav-stacked admin-menu"  > 
                       <InnerLeftMenuWrap menuList={leftMenuStr} forClick={this.handleTabChange}/>
                       </ul>
                    </div>
                    <div className="resp-tabs-container col-md-9 col-xs-12 clear-left" id="middleContainer">
                          {this.switchingComponent()}
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

export default ClassManagement;