@extends('layouts.dashboard')
@section('header')
{!!Html::style('css/pagination.css') !!}
@endsection
@section('content')

<div class="row">
        <div class="col-xs-12">
          <div class="box">
            <form class="form-horizontal form_eelect" role="form" method="POST" action="{{ url('/emaillist/export') }}" target="_blank" id="form_export">
            <div class="box-header" class="panel-heading col-md-12" >
               <div class="col-md-6">    
              <h3 class="box-title">Email Management</h3>&nbsp&nbsp<button type="button" class="btn btn-success search_btn-add  add_newbtn" onclick="editEmailContent(this.id)" id="new"><b><strong>Add New</strong></b></button></div> 
            <!-- /.box-header -->          
            <div class= "col-md-6" style="float: left">
                <div class="col-md-2 margin_top"> Export:</div>
                <div class="col-md-7">                   
                    <select name="typeExp" id="typeExp" class="select-pdf form-control">
                       <option value="csv">CSV</option>
                       <option value="pdf">PDF</option>
                    </select>
                </div>
                <div class="col-md-3">
                <button type="submit" class="btn btn-primary" name="btnExport" id="btnExport" onClick="return executeExport()">
                    <i class="fa fa-btn fa-refresh"></i>Export
                </button>
                </div>                    
                </div>
                <div class="col-md-3"></div>
                  <input type="hidden"  name="hid_export_id" id="hid_export_id">
                  <input type="hidden" name="hid_export_type" id="hid_export_type">
                  <input type="hidden" name="hid_export_subject" id="hid_export_subject">
                  {!! csrf_field() !!}
               </div>
          </form>

            <div class="panel-body">
            <div class="col-md-12">
                @if(Session::has('message'))
                  <div class="alert alert-success" style="text-align:center;">
                    <a href="./emaillist" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                    <strong> {{ Session::get('message') }}</strong>
                  </div>
                @endif
            </div>
            <div class="row">
                <div class="col-md-12 feild_sec">
                  <div class="col-md-3 form_sec">
                    <input type="text" id="id" placeholder="Search By ID" class="myText form-control col-md-2">
                  </div>
                  <div class="col-md-3 form_sec">
                    <input type="text" id="type" placeholder="Search By Type" class="myText form-control col-md-2">
                  </div>
                  <div class="col-md-3 form_sec">
                    <input type="text" id="subject" placeholder="Search By Subject" class="myText form-control col-md-2">
                  </div>
                  <div class="col-md-3">
                    <button id="btnSearch" class="btn btn-success search_btn search_btn-add   save_btnl" type="button"><b><strong>Search</strong></b></button>
                  </div>
                </div>
            </div>
              <div class="box-body table-responsive no-padding" >
                <div id="loading"></div>              
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
            <!-- /.box-body -->
          </div>
           
          <!-- /.box -->
        </div>
      </div>

 
@endsection
@section('footer')
{!!Html::script('/public/js/jquery.pagination.js')!!}
{!!Html::script('/public/js/email-content.js')!!}  
@endsection



