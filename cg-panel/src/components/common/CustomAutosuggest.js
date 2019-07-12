import React from 'react';
import ReactDOM from 'react-dom';
import axios from 'axios';


import Autosuggest from 'react-autosuggest';


/* ---------- */
/*    Data    */
/* ---------- */

const autoSearchData = [];



/* ----------- */
/*    Utils    */
/* ----------- */

// https://developer.mozilla.org/en/docs/Web/JavaScript/Guide/Regular_Expressions#Using_Special_Characters
function escapeRegexCharacters(str) {
  return str.replace(/[.*+?^${}()|[\]\\]/g, '\\$&');
}

/* --------------- */
/*    Component    */
/* --------------- */



function renderSuggestion(suggestion) {
  return (
    <span>{suggestion.name}</span>
  );
}

class CustomAutosuggest extends React.Component {
  constructor(props) {
    super(props);

    this.state = {
      value: this.props.selectedValue,
      suggestions: [],
      isLoading: false,
      key:0
    };
    
    this.lastRequestId = null;
    this.getSuggestionValue = this.getSuggestionValue.bind(this);
  }
  
  loadSuggestions(value) {
    // Cancel the previous request
    if (this.lastRequestId !== null) {
      clearTimeout(this.lastRequestId);
    }
    
    this.setState({
      isLoading: true
    });
         axios.get(this.props.ajaxUrl+'?'+this.props.searchParam+'='+value+'&token='+this.props.token)
	      .then(function (response) {  				
        let returnDataList = [];
        let dataParam = this.props.dataParam;
        if(dataParam)
        {
            returnDataList = response.data[dataParam];
        }
        else
        {
           returnDataList = response.data;
        }
        if(returnDataList.length)
        {
          const returnData = [];
          for (var i = 0; i < returnDataList.length; i++){
            let nameStr = '';
            let keyStr = '';
            for (var k = 0; k < this.props.forName.length; k++){

              let keyName = this.props.forName[k];
              nameStr += returnDataList[i][keyName] + ' ';
            }

            for (var l = 0; l < this.props.forKey.length; l++){

              let keyName = this.props.forKey[l];
              keyStr += returnDataList[i][keyName] + ' ';
            }

            nameStr = nameStr.trim();
            keyStr  = keyStr.trim();
            returnData.push({name:nameStr, key:keyStr})
          }
         
  			 this.setState({
  		        isLoading: false,
  		        suggestions: returnData
  		      });
        }
        else
        {
          this.setState({
              isLoading: false,
              suggestions: []
            });
           this.props.parentObject.searchReturn({key:0,text:value});
        }

	      }.bind(this))
	      .catch(function (error) {	       
	      	

	      }.bind(this));

    }
  //}

  onChange = (event, { newValue }) => {
    this.setState({
      value: newValue
    });
  };
    
  onSuggestionsFetchRequested = ({ value }) => {
    this.loadSuggestions(value);
  };

  onSuggestionsClearRequested = () => {
    this.setState({
      suggestions: []
    });
  };

  getSuggestionValue(suggestion) {

  this.props.parentObject.searchReturn({key:suggestion.key,text:suggestion.name});
  this.setState({key: suggestion.key}); 
  return suggestion.name;
}

  render() {
    const { value, suggestions, isLoading } = this.state;
    const inputProps = {
      placeholder: this.props.placeHolder,
      value,
      onChange: this.onChange
    };
    const status = (isLoading ? 'Loading...' : 'Type to load suggestions');
    return (
      <div>        
        <Autosuggest 
          suggestions={suggestions}
          onSuggestionsFetchRequested={this.onSuggestionsFetchRequested}
          onSuggestionsClearRequested={this.onSuggestionsClearRequested}
          getSuggestionValue={this.getSuggestionValue}
          renderSuggestion={renderSuggestion}
          inputProps={inputProps} />
          <input type="hidden" value={this.state.key}/>
      </div>
    );
  }
}

export default CustomAutosuggest;
