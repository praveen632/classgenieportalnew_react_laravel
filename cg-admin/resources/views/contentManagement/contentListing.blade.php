@extends('layouts.dashboard')
@section('content')
       <div class="row">
        <div class="col-xs-12">
          <div class="box">
            <div class="box-header">
              <h3 class="box-title">Content Management</h3>&nbsp&nbsp<button type="button" class="btn btn-success search_btn-add   add_newbtn" onclick="editContent(this.id)" id="new"><b><strong>Add New</strong></b></button></div>
              <div class="col-md-12">
                @if(Session::has('message'))
                <div class="alert alert-success" style="text-align:center;">
                  <a href="<?php echo url('contentlist')?>" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                  <strong> {{ Session::get('message') }}</strong>
                </div>
                @endif
              </div> 
            <!-- /.box-header -->
            <div class="box-body no-padding">
            
               <div id="datatable" class="col-md-12 "></div>
           
            </div>
            <!-- /.box-body -->
          </div>
          <!-- /.box -->
        </div>
      </div>
      
@endsection
@section('footer')
{!!Html::script('/public/js/edit-content.js')!!}
@endsection
<script type="text/javascript">
 window.onload = function(e) {   
    getdata();
  }
  function editContent(id)
 {
    if(id == 'new')
       {
          window.location.href= "contentlist/"+id;
       }
   else
      {      
        var t = $('#'+id).children('td:first').text();
        window.location.href ="contentlist/"+id;
      }
 }

function deleteContent(id)
{  
  var name = $('#'+id).find('td:eq(2)').text();
  var r = confirm(name+' '+"content will we deleted!");
  if (r == true)
  {
      window.location =Siteurl+"/deleteContent/"+id;
  }
}
</script>




