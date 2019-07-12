
// $(document).ready(function(e){

getdata = function(){ajaxloader.load("searchcontent/list", function(msg, cparams){
    $('#datatable').html(msg);
},null);}
//   });
     



function getsearchData()
{

 var name  = document.getElementById('name').value;
 var title = document.getElementById('title').value;
 var url   = document.getElementById('url').value;
 var where  = name+','+title+','+url;
 if(where == '')
 {
   where = 'list';
 }
ajaxloader.load("searchcontent/"+where, function(msg, cparams){
    $('#datatable').html(msg);
    //fclog(cparams);
},null);


}




