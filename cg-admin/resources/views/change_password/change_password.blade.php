@extends('layouts.dashboard')
@section('content') 
<div class="box box-info">
    <div class="box-header with-border">
      <h3 class="box-title">Change password</h3>
    </div>
    <!-- /.box-header -->
    <!-- form start -->
    <form class="form-horizontal" role="form" method="POST" id="change_password" name="change_password" action="{{ url('/change_password') }}">
         {!! csrf_field() !!}
         @if(Session::has('message'))
           <div class="alert alert-success" style="text-align:center;">
            <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
            <strong> {{ Session::get('message') }}</strong>
          </div>
          @endif
      <div class="box-body">
        <div class="form-group">
          <label for="inputEmail3" class="col-sm-2 control-label">Password</label>
          <div class="col-sm-10">
             <input type="Password" class="form-control" name="Password" value="{{ old('Password') }}">
                @if ($errors->has('Password'))
                    <span class="help-block">
                        <strong>{{ $errors->first('Password') }}</strong>
                    </span>
                @endif
          </div>
        </div>
        <div class="form-group">
          <label for="inputPassword3" class="col-sm-2 control-label">New Password</label>
          <div class="col-sm-10">
           <input type="Password" class="form-control" name="New_password">
                @if ($errors->has('New_password'))
                    <span class="help-block">
                        <strong>{{ $errors->first('New_password') }}</strong>
                    </span>
                @endif
          </div>
        </div>
        <div class="form-group{{ $errors->has('Conf_password') ? ' has-error' : '' }}">
          <label for="inputPassword3" class="col-sm-2 control-label">Confirm Password</label>
          <div class="col-sm-10">
            <input type="Password" class="form-control" name="Conf_password">
                @if ($errors->has('Conf_password'))
                    <span class="help-block">
                        <strong>{{ $errors->first('Conf_password') }}</strong>
                    </span>
                @endif
          </div>
        </div>                
      </div>
      <!-- /.box-body -->
      <div class="box-footer">
        <button type="submit" class="btn btn-info pull-right  save_btnl">Save</button>
      </div>
      <!-- /.box-footer -->
    </form>
  </div>

@endsection
@section('footer')
@endsection

