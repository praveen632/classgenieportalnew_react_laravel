import React from 'react';
import ReactDOM from 'react-dom';
import {Link } from 'react-router-dom';


class InnerLeftMenu extends React.Component {

  constructor(props)
  {
    super(props)
   
  }
  handleTabChange() 
  {
   

   console.log('last child');
    
  }
  render() {

    const tabName = this.props.tabName;
    return (

       
          ( this.props.menuType == 'tab') ?
          <li onClick={this.props.forClick()}  aria-controls={this.props.controlId} role="tab" title={this.props.tabName}><a title={this.props.tabName}><i className={this.props.menuClass}></i>{this.props.name}</a></li> 
          : <li><Link className={this.props.menuClass} aria-controls={this.props.controlId} role="tab" to={this.props.href} target="_blank" activeClassName="active"><i className={this.props.menuClass}></i>{this.props.name}</Link></li>
       

                 
       
       
    );
  }

}


class InnerLeftMenuWrap extends React.Component {
  
  constructor(props)
  {
    super(props)
   
  }

  handleTabChange() 
  {
   

   console.log('in child 2');
    
  }

  render() {
    let leftMenuArray = JSON.parse(this.props.menuList);   
    const clickFunction = () => this.props.forClick;
    return (      

      leftMenuArray.map(function(item, index){
        return (
         
            <InnerLeftMenu forClick = {clickFunction} name={item.name} menuType={item.type} href={item.href} controlId={'tab_item-'+index} menuClass={item.menuClass} tabName={item.tabName} key={index}/>
         
        )
      })
    	
    );
  }
}


export default InnerLeftMenuWrap;