@extends('layouts.dashboard')
@section('header')
{!!Html::style('css/pagination.css') !!}
@endsection
@section('content')
<div class="row">
  <div class="col-md-12">
  <div id="ajaxData" style="clear:both;">
    <div class="panel panel-default">
      <div class="panel-heading row">
       <div class="col-xs-3">
        <span style="font-size:15px;">Admin Schools Management&nbsp;&nbsp;</span>
       
       </div>
       <div class="col-xs-3">
        <input type="text" id="school_name" placeholder="Search By School Name" class="myText form-control">
       </div>
        <div class="col-xs-3">
        <a class="btn btn-success search_btn-add  add_newbtn" href="<?php echo url('/schools/create')?>">Add Schools</a>
       </div>

         <div class="col-xs-3">
          <select id="filter" name="filter">
          <option value="0">Pending</option>
          <option value="1">Approved</option>
          <option value="-1">Disable</option>
          <option value="2">Delete</option>
          </select>
         </div>
       </div>
     <div class="panel-body">
        {!! csrf_field() !!}
        <div class="col-md-12">
          @if(Session::has('message'))
          <div class="alert alert-success" style="text-align:center;">
            <a href="<?php echo url('schools')?>" class="close" data-dismiss="alert" aria-label="close">&times;</a>
            <strong> {{ Session::get('message') }}</strong>
          </div>
          @endif
        </div>        
         <div class="row col-md-12 table-responsive" id ="res_data">
         </div>
         <div class="row" style="margin-top:20px;">
            <div id="loading" style="text-align:center;width:200px;"></div>
              <div id="Datatable" class="col-md-12" ></div>
              <div id="Pagination" style="text-align:center;" ></div>
                <input type="hidden" value="<?php echo PAGE_SIZE; ?>" name="items_per_page" id="items_per_page">
                <input type="hidden" value="<?php echo NUM_DISPLAY_ENTRIES; ?>" name="num_display_entries" id="num_display_entries">
                <input type="hidden" value="Prev" name="prev_text" id="prev_text">
                <input type="hidden" value="Next" name="next_text" id="next_text">   
                <input type="hidden" id="sort" value="D" >
                {!! csrf_field() !!}
         </div>   
      </div>
    </div>
    </div>
  </div>
</div>
@endsection
@section('footer')
{!!Html::script('/public/js/jquery.pagination.js')!!}
{!!Html::script('/public/js/schools.js')!!}
@endsection
