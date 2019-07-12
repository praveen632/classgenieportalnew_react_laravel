$(document).ready(function(){
 
  // validate login Form on keyup and submit
       $("#signin").validate({         
    		rules: {
    				email_signin: {
    					       required: true,
                     email: true
    					     },
    				password_signin:{
                      required: true,
    				         } 	
    		       },
			  messages: {
    				email_signin:{
    				required: "Please enter Email Address",
    				      },
    			  password_signin:"Please enter Password", 

    	  		}
		    });
    
  // validate login Form on keyup and submit
       $("#signup").validate({
        rules: {
            name: {
                    required: true,
                   },
            email_signup:{
                    required: true,
                    email: true
                  },
            phone:{
                    required: true,                     
                    number:true,
                    minlength: 10,
                    maxlength: 10
                  }, 
            password_signup:{
                    required: true,
                  },
            role:{
                    required: true,
                  },          
            school:{
                    required: true,
                  },        
               },
      messages: {
             
            }
    });

//change password
$("#change_password").validate({
           rules: {
               newpassword: { 
                 required: true,
                    minlength: 6,
                    maxlength: 10,
               } , 
                   cfmpassword: { 
                    equalTo: "#newpassword",
                     minlength: 6,
                     maxlength: 10
               }
           },
     messages:{
         newpassword: { 
                 required:"the password is required"
               }
              }
       });

// validate on Edit Profile
       $("#edit_profile").validate({
        rules: {
            teacher_name: {
                    required: true,
                   }, 
              age: {
                    required: true,
                    number:true
                   },        
                    
               },
      messages: {
             
                   
           
            }
    });
       // validate on add class
       $("#classmanagement").validate({
        rules: {
            className: {
                    required: true,
                   },   
                    
               },
      messages: {
            name :"Please enter Name"         
           
            }
    });

     //popup form  validate add new school  

      $("#schoolinfo").validate({
         rules: {
            school_name: {
                    required: true,
                   },
            address:{
                    required: true,
                   },
            city:  {
                    required: true,
                   },                  
            state:  {
                    required: true,
                   },
            country:  {
                    required: true,
                   }, 
            pincode:{
                    required: true,
                    number: true
                   },
            phone :{
                    required: true,
                    number:true,
                    minlength: 10,
                    maxlength: 10
                   },
            email:{
                    required: true,
                    email: true
                   },
                         
              },
      messages: {
            
            }
       });





       //popup form  validate add new school  

      $("#schoolinfo_signup").validate({
         rules: {
            school_name: {
                    required: true,
                   },

                   email: {
                    required: true,
                    email:true
                   },
                    phone: {
                    required: true,
                    number:true,
                    minlength: 10,
                    maxlength: 10
                   },
                   pincode: {
                    required: true,
                    number:true,                    
                   },
            
           
                         
              },
      messages: {
            
            
            }
       });

}); 