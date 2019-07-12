@extends('layouts.dashboard')
@section('content')
<div class="box">
  <div class="box-header">
    <h3 class="box-title">Admin User Magement</h3>&nbsp;&nbsp;<a class="btn btn-success search_btn-add  add_newbtn" href="<?php echo url('/usermanagement/create')?>">Add User Role</a>
  </div>
  {!! csrf_field() !!}
   <div class="col-md-12">
        @if(Session::has('message'))
         <div class="alert alert-success" style="text-align:center;">
          <a href="./usermanagement" class="close" data-dismiss="alert" aria-label="close">&times;</a>
          <strong> {{ Session::get('message') }}</strong>
         </div>
        @endif
    </div>
  <!-- /.box-header -->
  <div class="box-body no-padding">
    <table class="table table-striped">
      <?php   if(count($usermang) > 0){?>
          <tr>
            <th>S.NO</th>
            <th>User Name</th>
            <th>First Name</th>
            <th>Last Name</th>
            <th>Email</th>
            <th>Role Name</th>
            <th>Action</th>
          </tr>
       </thead>
      <tbody>
        <?php  
          $i = 1; 
            foreach($usermang as $user)
                { if($user->role_name != "Super Admin"){
          ?>
           <tr>
            <td><?php echo $i;?></td>
              <td><?php echo $user->username?></td>
              <td><?php echo $user->fname;?></td>
              <td><?php echo $user->lname;?></td>
              <td><?php echo $user->email;?></td>
              <td><?php echo $user->role_name;?></td>
              <td>
              <span class="col-md-1">
              <a href="<?php echo url('/usermanagement/'.$user->id.'/edit') ?>"><i class="glyphicon glyphicon-pencil"></i></a>
              </span>
              <span class="col-md-1">
              {{ Form::open(array('route' => array('usermanagement.destroy', $user->id), 'method' => 'delete')) }}
                <button type="submit"   class="back_none"><i class="glyphicon glyphicon-remove  delete_btn"></i></button>
              {{ Form::close() }}
              </span>
         <?php $i++;} }?>
         <?php }else{ ?>
        <<tr><td style="background-color: #ddd; text-align: center; font-weight: bold;">Record Not Found</td></tr>
        <?php } ?>
        </tbody>
    </table>
  </div>
  <!-- /.box-body -->
</div>

@endsection
