@extends('layouts.dashboard')
@section('content')
<div class="box box-info">
    <div class="box-header with-border">
      <h3 class="box-title">Add skill Image</h3>&nbsp;&nbsp;<a class="btn btn-success search_btn-add" href="<?php echo url('/imagemanagement/skill')?>">View List</a>
    </div>
    <!-- /.box-header -->
    <!-- form start -->
     {!! Form::model($edit,['method' => 'PATCH','route'=>['imagemanagement.skill.update',$edit->id], 'class'=> 'form-horizontal', 'enctype'=>'multipart/form-data', 'name'=> 'classimg_create', 'id'=>'classimg_create']) !!}
     {!! csrf_field() !!}        
      <div class="box-body">
        <div class="form-group{{ $errors->has('message') ? ' has-error' : '' }}">
          <label for="inputEmail3" class="col-sm-2 control-label">Image</label>
          <div class="col-sm-10">
             <input type="file" class="form-control" name="image1" value="{{ old('image') }}">
                <input type="hidden" class="form-control" name="image" value="<?php echo $edit->image;?>">
                @if ($errors->has('image'))
                <span class="help-block">
                    <strong>{{ $errors->first('image') }}</strong>
                </span>
                @endif
          </div>
        </div>
        <div class="form-group{{ $errors->has('title') ? ' has-error' : '' }}">
          <label for="inputEmail3" class="col-sm-2 control-label">Title</label>
          <div class="col-sm-10">
             <input type="text" class="form-control" name="title" value="<?php echo $edit->title;?>">
                @if ($errors->has('title'))
                <span class="help-block">
                    <strong>{{ $errors->first('title') }}</strong>
                </span>
                @endif
        </div>                       
      </div>

      <div class="form-group{{ $errors->has('order') ? ' has-error' : '' }}">
          <label for="inputEmail3" class="col-sm-2 control-label">Order</label>
          <div class="col-sm-10">
             <input type="text" class="form-control" name="order" value="<?php echo $edit->order;?>">
                @if ($errors->has('order'))
                <span class="help-block">
                    <strong>{{ $errors->first('order') }}</strong>
                </span>
                @endif
        </div>                       
      </div>
      <!-- /.box-body -->
      <div class="box-footer">
        <button type="submit" class="btn btn-info pull-right">Save</button>
      </div>
      <!-- /.box-footer -->
    </form>
  </div>
@endsection

