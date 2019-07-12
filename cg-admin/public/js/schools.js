var items_per_page,num_display_entries,items_per_page,num_entries,start=0;
$(document).ready(function(){
items_per_page = $('#items_per_page').val();
	 num_display_entries = $('#num_display_entries').val();
	 loaddata(0,items_per_page,'ready');

	 $('input#school_name').keyup('click',function(){
	  var school_name = $('#school_name').val();
	  	loaddata(0,items_per_page,'ready',school_name);  

       //loadSearchdata(school_name);
       });

     // select filter
     $('#filter').on('change', function(){
     	var filter = $(this).val();
        loaddata_filter(0,items_per_page,'ready',filter); 
        initPagination(); 
        });

      });

   // selet data by filter
  function loaddata_filter(start,per_page,event_type,filter){
  	   loader.block = '#loading';
       ajaxloader.type = "GET";       
	   ajaxloader.load("schools/list", function(msg, cparams){
	   
	          var resp_data = msg.split('~');
              num_entries = resp_data[0];
              $("#Datatable").html(resp_data[1]);
		      if(event_type == 'ready'){
		        	  initPagination();
      				}		       	    
		       },null,{'start':start,'filter':filter, 'per_page':per_page, 'sort_by':$('#sort').val()});
			}

function loadSearchdata(school_name){
	   loader.block = '#loading';
       ajaxloader.type = "GET";       
	   ajaxloader.load("schools/list_search/"+school_name, function(msg, cparams){	 
	             $("#Datatable").html(msg);		       	    
		       });
			}

function loaddata(start,per_page,event_type,school_name){
	   loader.block = '#loading';
       ajaxloader.type = 'GET';       
	   ajaxloader.load("schools/list", function(msg, cparams){
	   
	          var resp_data = msg.split('~');
              num_entries = resp_data[0];
              $("#Datatable").html(resp_data[1]);
		      if(event_type == 'ready'){
		        	  initPagination();
      				}		       	    
		       },null,{'start':start,'school_name':school_name, 'per_page':per_page, 'sort_by':$('#sort').val()});
			}



function pageselectCallback(page_index, jq, event_type){
      	start = page_index*items_per_page
		if(typeof event_type == 'undefined')
       		loaddata(start,items_per_page,event_type)
    	return false;
  }

  function initPagination() {
  	$("#Pagination").pagination(num_entries, {
		num_display_entries: num_display_entries,
		items_per_page:items_per_page,
		callback: pageselectCallback
	});
 }

function open_div(email,school_id){
	   ajaxloader.type = "GET";       
	    ajaxloader.load("update_school/"+school_id, function(msg, cparams){	   	
      		 $('#ttt').fadeOut(10);
	 		 $('#ttt').removeClass('blur-in');
	 		 $('#ttt').addClass('blur-out');   
       	 },null,{'school_id':school_id});           
         	  $('div').remove('.modal-backdrop');
         	  
         	  setTimeout(function() { sendmail(email); }, 300);
         	  
         	  setTimeout(function() { loaddata(0,items_per_page,'ready'); }, 300);
         	}
            
function close_div(){
				$('#ttt').fadeOut(10);
	 		 	$('#ttt').removeClass('blur-in');
	 		 	$('#ttt').addClass('blur-out');   
	 		 	$('div').remove('.modal-backdrop');
				loaddata(0,items_per_page,'ready');	 		 	
}

function destroy(school_id){

	if(confirm("Are you sure you want to delete this?")){
        ajaxloader.type = "GET";
	    ajaxloader.load("delete_school/"+school_id, function(msg, cparams){	   	
      		 $('#ttt').fadeOut(10);
	 		 $('#ttt').removeClass('blur-in');
	 		 $('#ttt').addClass('blur-out');   
       	 },null,{'school_id':school_id});           
         	  $('div').remove('.modal-backdrop');         	 
         	 loaddata(0,items_per_page,'ready');
    }
    else{
        return false;
    }
	
}
function sendmail(email){
		ajaxloader.type = "GET"; 
	   	ajaxloader.load("sendmail_school/"+email, function(msg, cparams){
				  loaddata(0,items_per_page,'ready');
   		  		}
     ,null,{'email':email});  	   
	}
	
function getApproved(id){
	 	ajaxloader.type = "GET";	 	
	   	ajaxloader.load("get_email/"+id, function(msg, cparams){
	   	  	var email = JSON.stringify(msg);
	   	if(confirm("Are you sure you want to approve this school?")){
             onclick=open_div(email,id);
		    }
		    else{
		        onclick=close_div();
		    }
           }
          ,null,{'id':id});	
}

  	function views(school_id){  		
	ajaxloader.type = "GET";
	ajaxloader.load("views_school/"+school_id, function(msg, cparams){	   
	//console.log('hrtrr');	
	$('#ajaxData').html(msg);
});
}

