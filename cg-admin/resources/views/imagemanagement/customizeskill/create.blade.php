@extends('layouts.dashboard')
@section('content')
<div class="box box-info">
    <div class="box-header with-border">
      <h3 class="box-title">Add Customize Image</h3>&nbsp;&nbsp;<a class="btn btn-success search_btn-add  add_newbtn" href="<?php echo url('/imagemanagement/customizeskill')?>">View List</a>
    </div>
    <!-- /.box-header -->
    <!-- form start -->
    <form class="form-horizontal" name="customizeskill_create" id="customizeskill_create" role="form" method="POST" action="{{ url('/imagemanagement/customizeskill') }}" enctype="multipart/form-data">
         {!! csrf_field() !!}        
      <div class="box-body">
        <div class="form-group{{ $errors->has('image') ? ' has-error' : '' }}">
          <label for="inputEmail3" class="col-sm-2 control-label">Image</label>
          <div class="col-sm-10">
             <input type="file" class="form-control" name="image" value="{{ old('image') }}">
                @if ($errors->has('image'))
                <span class="help-block">
                    <strong>{{ $errors->first('image') }}</strong>
                </span>
                @endif
          </div>
        </div>
        <div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">
          <label for="inputEmail3" class="col-sm-2 control-label">Name</label>
          <div class="col-sm-10">
             <input type="text" class="form-control" name="name" value="{{ old('name') }}">
                @if ($errors->has('name'))
                <span class="help-block">
                    <strong>{{ $errors->first('name') }}</strong>
                </span>
                @endif
        </div>                       
      </div>

      <div class="form-group{{ $errors->has('pointweight') ? ' has-error' : '' }}">
          <label for="inputEmail3" class="col-sm-2 control-label">Pointweight</label>
          <div class="col-sm-10">
             <input type="text" class="form-control" name="pointweight" value="{{ old('name') }}">
                 @if ($errors->has('pointweight'))
                 <span class="help-block">
                 <strong>{{ $errors->first('pointweight') }}</strong>
                 </span>
                 @endif
        </div>                       
      </div>
      <!-- /.box-body -->
      <div class="box-footer">
        <button type="submit" class="btn btn-info pull-right  save_btnl ">Save</button>
      </div>
    </div>
      <!-- /.box-footer -->
    </form>
@endsection
