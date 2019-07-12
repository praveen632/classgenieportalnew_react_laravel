@extends('layouts.dashboard')
{!!Html::script('/public/editor/ckeditor.js')!!}
{!!Html::style('/public/editor/editor_gecko.css')!!}
@section('content')
<div class="box box-info">
    <div class="box-header with-border">
      <h3 class="box-title">Edit Blog</h3>&nbsp&nbsp<a class="btn btn-success search_btn-add   add_newbtn" href="<?php echo url('/bloglist')?>">View Blog List</a>
    </div>
    <!-- /.box-header -->
    <!-- form start -->
     {!! Form::model($edit,['method' => 'PATCH','route'=>['bloglist.update',$edit->id], 'class'=> 'form-horizontal', 'enctype'=>'multipart/form-data', 'name'=> 'blog_create', 'id'=>'blog_create']) !!}
     {!! csrf_field() !!}     
      <div class="box-body">
        <div class="form-group {{ $errors->has('title') ? ' has-error' : '' }}">
          <label for="inputEmail3" class="col-sm-2 control-label">Blog</label>
          <div class="col-sm-10">
              <input type="text" class="form-control" name="title" value="<?php echo $edit->title;?>" required>
             @if ($errors->has('title'))
             <span class="help-block">
                <strong>{{ $errors->first('title') }}</strong>
             </span>
             @endif              
          </div>
        </div>
        <div class="form-group {{ $errors->has('description') ? ' has-error' : '' }}">
          <label for="inputPassword3" class="col-sm-2 control-label">Description</label>
          <div class="col-sm-10">
          <textarea name="description" id="description" rows="10" cols="80">
            {{$edit->description}}   
          </textarea>            
          </div>
        </div>                              
      </div>
      <script>
          CKEDITOR.replace( 'description' );            
     </script>
      <!-- /.box-body -->
      <div class="box-footer">
        <button type="submit" class="btn btn-info pull-right   save_btnl">Save</button>
      </div>
      <!-- /.box-footer -->
     {!! Form::close() !!}
  </div>
@endsection
