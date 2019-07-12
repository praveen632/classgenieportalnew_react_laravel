@extends('layouts.dashboard')
@section('content')
<?php 
$url  = base_path().'/public/json/adminmodules.json';
$data = file_get_contents($url);
$data = json_decode($data,true);
$size = sizeof($data);
?>
    <div class="box box-info">
    <div class="box-header with-border">
      <h3 class="box-title">Edit Admin Role</h3>&nbsp;&nbsp;<a class="btn btn-success search_btn-add   add_newbtn" href="<?php echo url('/rolemanagement')?>">View List</a>
    </div>
    <!-- /.box-header -->
    <!-- form start -->
    {!! Form::model($edit,['method' => 'PATCH','route'=>['rolemanagement.update',$edit->id], 'class'=> 'form-horizontal', 'name'=> 'staffmang_create', 'id'=>'staffmang_create']) !!}
    {!! csrf_field() !!}          
      <div class="box-body">
        <div class="form-group{{ $errors->has('role_name') ? ' has-error' : '' }}">
          <label for="inputEmail3" class="col-sm-2 control-label">Role Name</label>
          <div class="col-sm-10">
              <input type="text" class="form-control" name="role_name" value="<?php echo $edit->role_name;?>" required>
                  @if ($errors->has('role_name'))
                    <span class="help-block">
                        <strong>{{ $errors->first('role_name') }}</strong>
                    </span>
                 @endif
          </div>
        </div>

        <?php $list = $edit->module_list;  
              $listvalue = explode(',', $list);
         ?> 

        <div class="form-group{{ $errors->has('module') ? ' has-error' : '' }}">
          <label for="inputPassword3" class="col-sm-3 control-label">Module List</label>
            <?php foreach ($data as $key => $value){?>
          <div class="col-md-3 required">             
           <input type="checkbox" name="module[]" value="<?php echo $key?>" <?php if (in_array($key,$listvalue)){?>checked <?php }?>> <?php echo $value['name']?>   
          </div>
          <?php }?>
        </div>                       
      </div>
      <!-- /.box-body -->
      <div class="box-footer">
        <button type="submit" class="btn btn-info pull-right  save_btnl">Save</button>
      </div>
      <!-- /.box-footer -->
    {!! Form::close() !!}
  </div>
@endsection
