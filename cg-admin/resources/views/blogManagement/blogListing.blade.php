@extends('layouts.dashboard')
@section('content')
<div class="row">
  <div class="col-xs-12">
    <div class="box">
      <div class="box-header">
        <span style="font-size:15px;">Blog Management&nbsp;&nbsp;</span> <a class="btn btn-success search_btn-add  add_newbtn" href="<?php echo url('/blog/create')?>"><b><strong>Add Blog</strong></b></a></div>
         {!! csrf_field() !!}
          <div class="col-md-12">
            @if(Session::has('message'))
            <div class="alert alert-success" style="text-align:center;">
              <a href="./bloglist" class="close" data-dismiss="alert" aria-label="close">&times;</a>
              <strong> {{ Session::get('message') }}</strong>
            </div>
            @endif
          </div>
      <div class="box-body no-padding">      
         <div id="res_data" class="col-md-12"></div>     
      </div>
      <!-- /.box-body -->
    </div>
    <!-- /.box -->
  </div>
</div>
@endsection
@section('footer')
{!!Html::script('/public/js/bloglist.js')!!}
@endsection
