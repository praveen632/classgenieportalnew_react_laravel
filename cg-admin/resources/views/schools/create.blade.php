@extends('layouts.dashboard')
@section('content')
<div class="box box-info">
    <div class="box-header with-border">
      <h3 class="box-title">Add Schools</h3>&nbsp;&nbsp;<a class="btn btn-success search_btn-add  add_newbtn" href="<?php echo url('/schools')?>">View List</a>
    </div>
    <!-- /.box-header -->
    <!-- form start -->
    <form class="form-horizontal" name="schools_create" id="schools_create" role="form" method="POST" action="{{ url('/schools') }}" enctype="multipart/form-data">
         {!! csrf_field() !!}        
      <div class="box-body">
        <div class="form-group{{ $errors->has('school_name') ? ' has-error' : '' }}">
          <label for="inputEmail3" class="col-sm-2 control-label">School Name</label>
          <div class="col-sm-10">
             <input type="text" class="form-control" name="school_name" value="{{ old('school_name') }}" required>
                @if ($errors->has('school_name'))
                <span class="help-block">
                    <strong>{{ $errors->first('school_name') }}</strong>
                </span>
                 @endif
          </div>
        </div>
        <div class="form-group{{ $errors->has('address') ? ' has-error' : '' }}">
          <label for="inputEmail3" class="col-sm-2 control-label">Address</label>
          <div class="col-sm-10">
            <input type="text" class="form-control" name="address" value="{{ old('address') }}" required>
                @if ($errors->has('address'))
                <span class="help-block">
                    <strong>{{ $errors->first('address') }}</strong>
                </span>
                @endif
        </div>                       
      </div>

      <div class="form-group{{ $errors->has('city') ? ' has-error' : '' }}">
          <label for="inputEmail3" class="col-sm-2 control-label">City</label>
          <div class="col-sm-10">             
              <input type="text" class="form-control" name="city" value="{{ old('city') }}" required>
                @if ($errors->has('city'))
                <span class="help-block">
                    <strong>{{ $errors->first('city') }}</strong>
                </span>
                @endif
        </div>                       
      </div>

      <div class="form-group{{ $errors->has('state') ? ' has-error' : '' }}">
          <label for="inputEmail3" class="col-sm-2 control-label">State</label>
          <div class="col-sm-10">
             <input type="text" class="form-control" name="state" value="{{ old('state') }}" required>
                @if ($errors->has('state'))
                <span class="help-block">
                    <strong>{{ $errors->first('state') }}</strong>
                </span>
                @endif
        </div>                       
      </div>

      <div class="form-group{{ $errors->has('country') ? ' has-error' : '' }}">
          <label for="inputEmail3" class="col-sm-2 control-label">Country</label>
          <div class="col-sm-10">
             <input type="text" class="form-control" name="country" value="{{ old('country') }}" required>
                @if ($errors->has('country'))
                <span class="help-block">
                    <strong>{{ $errors->first('country') }}</strong>
                </span>
                @endif
        </div>                       
      </div>

      <div class="form-group{{ $errors->has('pincode') ? ' has-error' : '' }}">
          <label for="inputEmail3" class="col-sm-2 control-label">Pin Code</label>
          <div class="col-sm-10">
            <input type="text" class="form-control" name="pincode" value="{{ old('pincode') }}" required>
            @if ($errors->has('pincode'))
            <span class="help-block">
                <strong>{{ $errors->first('pincode') }}</strong>
            </span>
            @endif
        </div>                       
      </div>

      <div class="form-group{{ $errors->has('web_url') ? ' has-error' : '' }}">
          <label for="inputEmail3" class="col-sm-2 control-label">Web URL</label>
          <div class="col-sm-10">
            <input type="text" class="form-control" name="web_url" value="{{ old('web_url') }}" >
                @if ($errors->has('web_url'))
                <span class="help-block">
                    <strong>{{ $errors->first('web_url') }}</strong>
                </span>
                @endif
        </div>                       
      </div>

      <div class="form-group{{ $errors->has('email_id') ? ' has-error' : '' }}">
          <label for="inputEmail3" class="col-sm-2 control-label">Email Id</label>
          <div class="col-sm-10">
             <input type="text" class="form-control" name="email_id" value="{{ old('email_id') }}" required>
                @if ($errors->has('email_id'))
                <span class="help-block">
                    <strong>{{ $errors->first('email_id') }}</strong>
                </span>
                @endif
        </div>                       
      </div>

      <div class="form-group{{ $errors->has('phone') ? ' has-error' : '' }}">
          <label for="inputEmail3" class="col-sm-2 control-label">Phone</label>
          <div class="col-sm-10">
             <input type="text" class="form-control" name="phone" value="{{ old('phone') }}" required>
                @if ($errors->has('phone'))
                <span class="help-block">
                    <strong>{{ $errors->first('phone') }}</strong>
                </span>
                @endif
        </div>                       
      </div>
      <!-- /.box-body -->
      <div class="box-footer">
        <button type="submit" class="btn btn-info pull-right   save_btnl  ">Save</button>
      </div>
    </div>
      <!-- /.box-footer -->
    </form>
  </div>
@endsection
