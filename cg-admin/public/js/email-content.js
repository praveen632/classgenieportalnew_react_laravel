
var items_per_page,num_display_entries,items_per_page,num_entries,start;
 $(document).ready(function(){      
	 items_per_page = $('#items_per_page').val();
	 num_display_entries = $('#num_display_entries').val();
	 loadData(0,items_per_page,'ready');
	 $('#btnSearch').on('click', function(){
        loadData(0,items_per_page,'ready');
	 });
 });

 $(document).on("keypress", ".myText", function(e) {
     if (e.which == 13) {
         loadData(0,items_per_page,'ready');
     }
});

function loadData(start,per_page,event_type){
     loader.block = '#loading';
	   ajaxloader.type = "GET";
	   ajaxloader.load("searchemailcontent/list", function(msg, cparams){
     	        var resp_data = msg.split('~');
              num_entries = resp_data[0];
              $("#Datatable").html(resp_data[1]);
      				if(event_type == 'ready'){
      				   initPagination();
      				}
	   },null,{'start':start, 'per_page':per_page, 'id':$('#id').val(), 'type':$('#type').val(), 'subject':$('#subject').val(),'sort_by':$('#sort').val()});
 }

 function pageselectCallback(page_index, jq, event_type){
		start = page_index*items_per_page
		if(typeof event_type == 'undefined')
       		loadData(start,items_per_page,event_type)
    	return false;
  }

  function initPagination() {
	$("#Pagination").pagination(num_entries, {
		num_display_entries: num_display_entries,
		items_per_page:items_per_page,
		callback: pageselectCallback
	});
 }


//email content for add and edit
function editEmailContent(id)
{
 
      if(id == 'new')
       {

          window.location="emailcontent";

       }
      else
      {      
        var t = $('#'+id).children('td:first').text();
        window.location="emailcontent/"+id;
      }
}

executeExport = function(){
   $('#hid_export_id').val($('#id').val());
   $('#hid_export_type').val($('#type').val());
   $('#hid_export_subject').val($('#subject').val());
   $('#form_export').submit();
}
function sortData()
{
   if($('#sort').val() == 'D')
    {
      $('#sort').val('A');
    }
    else  if($('#sort').val() == 'A')
    {
       $('#sort').val('D');
    }
    loadData(0,items_per_page,'ready');
}

  


