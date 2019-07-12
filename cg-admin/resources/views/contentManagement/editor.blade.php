@extends('layouts.dashboard')
{!!Html::script('/public/editor/ckeditor.js')!!}
{!!Html::style('/public/editor/editor_gecko.css')!!}
@section('content')
 <div class="box box-info">
    <div class="box-header with-border">
      <h3 class="box-title">Edit Content</h3>&nbsp&nbsp<a class="btn btn-success search_btn-add  add_newbtn" href="<?php echo url('/contentlist')?>">View Content List</a>
    </div>
    <!-- /.box-header -->
    <!-- form start -->
    <form class="form-horizontal" id="ckform" action="{{ url('contentlist/save') }}" method="POST">
         {!! csrf_field() !!}        
      <div class="box-body">
        <div class="form-group">
          <label for="inputEmail3" class="col-sm-2 control-label">Page Name</label>
          <div class="col-sm-10">
             <input type="text" class="form-control"  name="page_name" value="{{$data['page_name']}}"placeholder="Name" id="pg_name">               
          </div>
        </div>
        <div class="form-group">
          <label for="inputPassword3" class="col-sm-2 control-label">Page Url</label>
          <div class="col-sm-10">
           <input type="text" class="form-control"  name="page_url" placeholder="Http://www.example.com" value="{{$data['url']}}" id="pg_url">               
          </div>
        </div>
        <div class="form-group">
          <label for="inputPassword3" class="col-sm-2 control-label">Page Title</label>
          <div class="col-sm-10">
           <input type="text" class="form-control"  value="{{$data['title']}}" name="page_title" placeholder="title" id="pg_title">             
          </div>
        </div>        
        <div class="form-group">
          <label for="inputPassword3" class="col-sm-2 control-label">Description</label>
             <div class="col-sm-10">
                 <textarea name="editor1" id="editor1" rows="10" cols="80">
                     {{$data['description']}}   
                 </textarea>
             </div>
        </div>
        <div class="form-group">
          <label for="inputPassword3" class="col-sm-2 control-label">Meta Keywords</label>
             <div class="col-sm-10">
                  <textarea name = "text1" id="key" class="form-control" rows="3" >
                        {{$data['metakey']}}
                  </textarea>
             </div>
        </div>
        <div class="form-group">
          <label for="inputPassword3" class="col-sm-2 control-label">Meta Description</label>
             <div class="col-sm-10">
                  <textarea name = "text2" id="desc" class="form-control" rows="3" >
                        {{$data['metadesc']}}
                  </textarea>
             </div>
        </div>
        <input type="hidden" value="{{$data['id']}}" id="cont_id" name="id"></input>
                       
      </div>
      <script>
         CKEDITOR.replace( 'editor1' );               
     </script>
      <!-- /.box-body -->
      <div class="box-footer">
        <button type="submit" class="btn btn-info pull-right  save_btnl">Save</button>
      </div>
      <!-- /.box-footer -->
    </form>
  </div>
@endsection        
@section('footer')
{!!Html::script('/public/editor/styles.js')!!}
{!!Html::script('/public/editor/config.js')!!}
@endsection
<script type="text/javascript">
  window.onload = function(e) {               
    document.getElementById('key').innerHTML = document.getElementById('key').innerHTML.trim();
    document.getElementById('desc').innerHTML = document.getElementById('desc').innerHTML.trim(); };
</script>
  