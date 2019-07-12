import React from 'react';



const required = (value, props) => {
  if (!value.toString().trim().length) {
    // We can return string or jsx as the 'error' prop for the validated Component
    return <p className="error">{props.placeholder} is required.</p>;
  }
};

const email = (value, props) => {
	/*
  if (!validator.isEmail(value)) {
  
     return <p className="error">{props.placeholder} is not a valid email.</p>;
  }
  */
};

const lt = (value, props) => {
  // get the maxLength from component's props
  if (!value.toString().trim().length > props.maxLength) {
    // Return jsx
    return <p className="error">The value exceeded {props.maxLength} symbols.</p>
  }
};

