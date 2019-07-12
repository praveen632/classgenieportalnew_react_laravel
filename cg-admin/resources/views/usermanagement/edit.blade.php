@extends('layouts.dashboard')
@section('content')
<?php 
$url  = base_path().'/public/json/rolemang.json';
$data = file_get_contents($url);
$data = json_decode($data,true);
$size = sizeof($data);
?>
<div class="box box-info">
    <div class="box-header with-border">
      <h3 class="box-title">Edit Admin User</h3>&nbsp;&nbsp;<a class="btn btn-success search_btn-add" href="<?php echo url('/usermanagement')?>">View List</a>
    </div>
    <!-- /.box-header -->
    <!-- form start -->
    {!! Form::model($edit,['method' => 'PATCH','route'=>['usermanagement.update',$edit->id], 'class'=> 'form-horizontal', 'name'=> 'user_edit', 'id'=>'user_edit']) !!}             
    {!! csrf_field() !!}          
      <div class="box-body">
        <div class="form-group{{ $errors->has('username') ? ' has-error' : '' }}">
          <label for="inputEmail3" class="col-sm-2 control-label">User Name</label>
          <div class="col-sm-10">
              <input type="text" class="form-control" name="username" value="<?php echo $edit->username?>" required>
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
              <input type="password" class="form-control" name="password" value="" required>
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
              <input type="text" class="form-control" name="fname" value="<?php echo $edit->fname?>" required>

                @if ($errors->has('fname'))
                    <span class="help-block">
                        <strong>{{ $errors->first('') }}</strong>
                    </span>
                @endif
          </div>
        </div>

        <div class="form-group{{ $errors->has('lname') ? ' has-error' : ''
        }}">   <label for="inputEmail3" class="col-sm-2 control-label">Last
        Name</label>   <div class="col-sm-10">       <input type="text" class
        ="form-control" name="lname" value="<?php echo $edit->lname?>" required>
        @if ($errors->has('lname'))     <span class="help-block"> <strong>{{
        $errors->first('') }}</strong>     </span> @endif   </div> </div>

        <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
          <label for="inputEmail3" class="col-sm-2 control-label">Email</label>
          <div class="col-sm-10">
              <input type="email" class="form-control" name="email" value="<?php echo $edit->email ?>" required>
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
                      <option value="<?php echo $value->id;?>" <?php if($value->id == $edit->role_id ){ ?> selected <?php } ?>><?php echo $value->role_name?></option>
                    <?php } ?>
                  </select>
          </div>
        </div>                     
      </div>
      <!-- /.box-body -->
      <div class="box-footer">
        <button type="submit" class="btn btn-info pull-right">Save</button>
      </div>
      <!-- /.box-footer -->
    {!! Form::close() !!}
  </div>
@endsection
