$(document).ready(function(){
var school_name = '';
loaddata(school_name);
$('input#school_name').keyup(function(){
var school_name = $('#school_name').val();
loaddata(school_name);
});
$('#school_name').blur(function(){
var school_name = $('#school_name').val();
   loaddata(school_name);
});
});
function loaddata(school_name){
	   ajaxloader.type = "GET";   
	   ajaxloader.load("teacherstatus/list", function(msg, cparams){	
	        var resp_data; 
		        resp_data = msg;
		        $("#res_data").html(resp_data);
		       },null,{'school_name':school_name});
			}
function update_teacher_status(member_no){

    	ajaxloader.type = "GET";       
	    ajaxloader.load("deactivate_teacher_status/"+member_no, function(msg, cparams){	 
             $('#ttt').fadeOut(10);
	 		 $('#ttt').removeClass('blur-in');
	 		 $('#ttt').addClass('blur-out');
	 		 $school_name = msg;         	 
         	 loaddata($school_name);    
       	 },null,{'member_no':member_no});
         	 $('div').remove('.modal-backdrop');
     }
     function close_div(){
				$('#ttt').fadeOut(10);
	 		 	$('#ttt').removeClass('blur-in');
	 		 	$('#ttt').addClass('blur-out');   
	 		 	$('div').remove('.modal-backdrop');c
	 		 	loaddata();
}

function getDeactivate(member_no){
	    $(".modal-content").html("Do you want to deactivate Teacher."+'   &nbsp;&nbsp;    '+'<button class="btn btn-primary" onclick=update_teacher_status('+member_no+');>Yes</button>'+'   &nbsp;      '+'<button class="btn btn-danger" onclick=close_div();>No</button>');      	     
		$('#ttt').removeClass("modal fade");	
		$('#ttt').addClass("modal fade bs-example-modal-lg"+' ' + member_no);
		$('.modal-content').attr('member_no', member_no);
}


// function getActivate(member_no){
// 		$(".modal-content").html("Do you want to activate Teacher."+'   &nbsp;&nbsp;    '+'<button class="btn btn-primary" onclick=activate_teacher_status('+member_no+');>Yes</button>'+'   &nbsp;      '+'<button class="btn btn-danger" onclick=close_div();>No</button>');      	     
// 	$('#ttt').removeClass("modal fade");	
// 	$('#ttt').addClass("modal fade bs-example-modal-lg"+' ' + member_no);
// 	$('.modal-content').attr('member_no', member_no);
// }


// function activate_teacher_status(member_no){
//     	ajaxloader.type = "POST";       
// 	    ajaxloader.load("activate_teacher_status/"+member_no, function(msg, cparams){	 
            
// 	         $('#ttt').fadeOut(10);
// 	 		 $('#ttt').removeClass('blur-in');
// 	 		 $('#ttt').addClass('blur-out');
// 	 		 $school_name = msg;         	 
//          	 loaddata($school_name);    
//        	 },null,{'member_no':member_no});
//          	 $('div').remove('.modal-backdrop');
//      }