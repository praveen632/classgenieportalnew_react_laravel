@extends('layouts.dashboard')
@section('content')
    <div class="box box-info">
    <div class="box-header with-border">
      <h3 class="box-title">Add Admin User</h3>&nbsp;&nbsp;<a class="btn btn-success search_btn-add  add_newbtn" href="<?php echo url('/usermanagement')?>">View List</a>
    </div>
    <!-- /.box-header -->
    <!-- form start -->
    <form class="form-horizontal" name="user_create" id="user_create" role="form" method="POST" action="{{ url('/usermanagement') }}">
         {!! csrf_field() !!}        
      <div class="box-body">
        <div class="form-group{{ $errors->has('username') ? ' has-error' : '' }}">
          <label for="inputEmail3" class="col-sm-2 control-label">User Name</label>
          <div class="col-sm-10">
              <input type="text" class="form-control" name="username" value="{{ old('username') }}" required>
                 @if ($errors->has('username'))
                    <span class="help-block">
                        <strong>{{ $errors->first('') }}</strong>
                    </span>
                 @endif
          </div>
        </div>
        <div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">
          <label for="inputEmail3" class="col-sm-2 control-label">Password</label>
          <div class="col-sm-10">
            <input type="password" class="form-control" name="password" value="{{ old('password') }}" required>
            @if ($errors->has('password'))
                <span class="help-block">
                    <strong>{{ $errors->first('') }}</strong>
                </span>
            @endif
        </div>
        </div> 

        <div class="form-group{{ $errors->has('fname') ? ' has-error' : '' }}">
          <label for="inputEmail3" class="col-sm-2 control-label">First Name</label>
          <div class="col-sm-10">
            <input type="text" class="form-control" name="fname" value="{{ old('fname') }}" required>
           @if ($errors->has('fname'))
                <span class="help-block">
                    <strong>{{ $errors->first('') }}</strong>
                </span>
            @endif
        </div>
        </div>

        <div class="form-group{{ $errors->has('lname') ? ' has-error' : '' }}">
          <label for="inputEmail3" class="col-sm-2 control-label">Last Name</label>
          <div class="col-sm-10">
            <input type="text" class="form-control" name="lname" value="{{ old('lname') }}" required>

                @if ($errors->has('lname'))
                    <span class="help-block">
                        <strong>{{ $errors->first('') }}</strong>
                    </span>
                @endif
         </div>
        </div> 

        <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
          <label for="inputEmail3" class="col-sm-2 control-label">Email</label>
          <div class="col-sm-10">
            <input type="email" class="form-control" name="email" value="{{ old('email') }}" required>

                @if ($errors->has('email'))
                    <span class="help-block">
                        <strong>{{ $errors->first('') }}</strong>
                    </span>
                @endif
         </div>
        </div>

        <div class="form-group{{ $errors->has('role') ? ' has-error' : '' }}">
          <label for="inputEmail3" class="col-sm-2 control-label">Role</label>
          <div class="col-sm-10">
           <select class="form-control col-md-3" name="role" required>
              <option  value="">Select User Role</option>
                 <?php foreach ($rolemang as $value){?>
                  <option value="<?php echo $value->id;?>"><?php echo $value->role_name?></option>
                 <?php }?>
              </select>
         </div>
        </div>

      </div>
      <!-- /.box-body -->
      <div class="box-footer">
        <button type="submit" class="btn btn-info pull-right   save_btnl">Save</button>
      </div>
      <!-- /.box-footer -->
    </form>
  </div>
@endsection
