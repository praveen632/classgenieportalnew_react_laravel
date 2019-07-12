@extends('layouts.dashboard')
{!!Html::script('/public/editor/ckeditor.js')!!}
{!!Html::style('/public/editor/editor_gecko.css')!!}
@section('content')
  <div class="box box-info">
    <div class="box-header with-border">
      <h3 class="box-title">Add Blog</h3>&nbsp&nbsp<a class="btn btn-success search_btn-add  add_newbtn" href="<?php echo url('/bloglist')?>">View Blog List</a>
    </div>
    <!-- /.box-header -->
    <!-- form start -->
    <form class="form-horizontal" id="ckform" action="{{ url('blog/save') }}" method="POST">
         {!! csrf_field() !!}        
      <div class="box-body">
        <div class="form-group">
          <label for="inputEmail3" class="col-sm-2 control-label">Page Title</label>
          <div class="col-sm-10">
             <input type="text" class="form-control"  value="" name="page_title" placeholder="title" id="pg_title" required>               
          </div>
        </div>
        <div class="form-group">
          <label for="inputPassword3" class="col-sm-2 control-label">Description</label>
          <div class="col-sm-10">
          <textarea name="editor1" id="editor1" rows="10" cols="80"></textarea>             
          </div>
        </div>
       <input type="hidden" value="" id="cont_id" name="id"></input>                       
      </div>
      <script>
          CKEDITOR.replace( 'editor1' );             
     </script>
      <!-- /.box-body -->
      <div class="box-footer">
        <button type="submit" class="btn btn-info pull-right   save_btnl">Save</button>
      </div>
      <!-- /.box-footer -->
    </form>
  </div>
@endsection        
@section('footer')
{!!Html::script('/public/editor/styles.js')!!}
{!!Html::script('/public/editor/config.js')!!}
@endsection

  