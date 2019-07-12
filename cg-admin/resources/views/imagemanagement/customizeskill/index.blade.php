@extends('layouts.dashboard')
@section('content')
<div class="box">
  <div class="box-header">
    <h3 class="box-title">Class CustomizeSkill Magement</h3>&nbsp;&nbsp;<a class="btn btn-success search_btn-add   add_newbtn" href="<?php echo url('/imagemanagement/customizeskill/create')?>">Add Customize Image</a>
  </div>
  {!! csrf_field() !!}
   <div class="col-md-12">
        @if(Session::has('message'))
          <div class="alert alert-success" style="text-align:center;">
            <a href="./customizeskill" class="close" data-dismiss="alert" aria-label="close">&times;</a>
            <strong> {{ Session::get('message') }}</strong>
          </div>
          @endif
    </div>
  <!-- /.box-header -->
  <div class="box-body no-padding">
    <table class="table table-striped">
      <?php if(count($imagemang) > 0){?>
       <thead>        
              <tr>
                <th>S.NO</th>
                <th>Skill Name</th>
                <th>Image</th>
                <th>Pointweight</th>
                <th>Action</th>
              </tr>
       </thead>
      <tbody>
        <?php  
              $i = 1; 
              foreach($imagemang as $row)
              {
                ?>
                <tr>
                  <td><?php echo $i;?></td>
                  <td><?php echo $row->name?></td>
                  <td><img src="<?php echo url('/').'/public/assets/skill/'.$row->image;?>" width="100px" height="100px"></td>
                  <td><?php echo $row->pointweight?></td>
                  
                  <td>
                    <span class="col-md-1">
                      <a href="<?php echo url('/imagemanagement/customizeskill/'.$row->id.'/edit') ?>"><i class="glyphicon glyphicon-pencil"></i></a>
                    </span><span class="col-md-1">
                   {{ Form::open(array('route' => array('imagemanagement.customizeskill.destroy', $row->id), 'method' => 'delete')) }}
                    <button type="submit"    class="back_none"><i class="glyphicon glyphicon-remove  delete_btn"></i></button>
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
