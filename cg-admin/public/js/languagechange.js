/* Div Hide and Show Onclich Event */
$(document).ready(function() {
      $('.nav-toggle').click(function(){
      var collapse_content_selector = $(this).attr('href');    
      var toggle_switch = $(this);
      $(collapse_content_selector).toggle(function(){

        if($(this).css('display')=='none'){
              toggle_switch.html('Add Menu');
        }else{
              toggle_switch.html('Delete Menu');
        }
      });
      });
 
/*  Div Elements Onchange Language */ 
 $('#Language').change(function(){
        var lang = $(this).val();
        loader.block = '.nav-toggle';
        ajaxloader.loadURL("lang_ajax",{"lang":lang},function (data){
        $(".engdiv").attr('disabled','disabled');
        $(".engdiv").hide();
        $("#LangDiv").html(data);
       });
    });
  }); 
