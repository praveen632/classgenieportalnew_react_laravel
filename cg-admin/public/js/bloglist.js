
$(document).ready(function(){

	 loaddata();

});

function loaddata(){
       ajaxloader.type = "GET";       
	   ajaxloader.load("blogs_list", function(msg, cparams){
	   			var resp_data; 
		        resp_data= msg;
		        $("#res_data").html(resp_data);		       	    
		       });
			}

function destroy(blog_id){
	ajaxloader.type = "GET";
	ajaxloader.load("delete_blog/"+blog_id, function(msg, cparams){	   	
      		 $('#ttt').fadeOut(10);
	 		 $('#ttt').removeClass('blur-in');
	 		 $('#ttt').addClass('blur-out');   
       	 },null,{'blog_id':blog_id});           
         	  $('div').remove('.modal-backdrop');
         	 
         	setTimeout(function() { loaddata(); }, 300);
}			