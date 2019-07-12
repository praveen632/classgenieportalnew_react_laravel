@extends('layouts.dashboard')
@section('content')
<?php 
$url  = base_path().'/public/json/rolemang.json';
$data = file_get_contents($url);
$data = json_decode($data,true);
?>
<div class="box">
  <div class="box-header">
    <h3 class="box-title">Admin Role Magement</h3>&nbsp;&nbsp;<a class="btn btn-success search_btn-add   add_newbtn" href="<?php echo url('/rolemanagement/create')?>">Add Admin Role</a>
  </div>
  {!! csrf_field() !!}
   <div class="col-md-12">
        @if(Session::has('message'))
         <div class="alert alert-success" style="text-align:center;">
          <a href="./rolemanagement" class="close" data-dismiss="alert" aria-label="close">&times;</a>
          <strong> {{ Session::get('message') }}</strong>
         </div>
        @endif
    </div>
  <!-- /.box-header -->
  <div class="box-body no-padding">
    <table class="table table-striped">
      <?php if(count($staffmang) > 0){?>
       <thead>
        <tr>
          <th>S.NO</th>
          <th>Role Name</th>
          <th>Module Name</th>
          <th>Action</th>
        </tr>
       </thead>
      <tbody>
        <?php  
          $i = 1; 
          foreach($staffmang as $row)
              {
                 $arr_module = array();
                 $modulearr = explode(',', $row->module_list);
                 //var_dump($modulearr);die();
                 foreach($modulearr as $value)
                 {
                    $arr_module[] = $data[$value];
                 }
          ?>
           <tr>
            <td><?php echo $i;?></td>
            <td><?php echo $row->role_name?></td>
            <td><?php echo implode(', ', $arr_module)?></td>
            <td>
            <span class="col-md-1">
            <a href="<?php echo url('/rolemanagement/'.$row->id.'/edit') ?>"><i class="glyphicon glyphicon-pencil"></i></a>
            </span><span class="col-md-1">
            {{ Form::open(array('route' => array('rolemanagement.destroy', $row->id), 'method' => 'delete')) }}
              <button type="submit"  class="back_none" ><i class="glyphicon glyphicon-remove  delete_btn"></i></button>
            {{ Form::close() }}
            </span>
          </tr>
        <?php $i++;} ?>
        <?php }else{ ?>
        <tr><td style="background-color: #ddd; text-align: center; font-weight: bold;">Record Not Found</td></tr>
        <?php } ?>
        </tbody>
    </table>
  </div>
  <!-- /.box-body -->
</div>


@endsection
