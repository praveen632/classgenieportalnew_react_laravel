@extends('layouts.dashboard')
@section('content')
<?php 
$url  = base_path().'/public/json/language.json';
$data = file_get_contents($url);
$data = json_decode($data,true);
$size = sizeof($data);
?> 
  <div class="box box-info">
    <div class="box-header with-border">
      <h3 class="box-title">MENU</h3>
    </div>
    <!-- /.box-header -->
    <!-- form start -->
    <form class="form-horizontal" role="form" method="POST" name="Language_form" id="Language_form" action="{{ url('/language') }}">
      <input type="hidden" name="_token" value="{{ csrf_token() }}">
         @if(Session::has('message'))
           <div class="alert alert-success" style="text-align:center;">
            <a href="language" class="close" data-dismiss="alert" aria-label="close">&times;</a>
            <strong> {{ Session::get('message') }}</strong>
          </div>
          @endif
      <div class="box-body">
        <div class="form-group">
          <label class="col-sm-2 control-label">Language</label>
          <div class="col-sm-10">
             <select name="Language" id="Language" class="form-control">
               <option value="">Select</option>
                 <option value="english" selected="">English</option>
                   <option value="malay">Malay</option>
            </select>
                @if ($errors->has('Language'))
                 <span class="help-block">
                    <strong>{{ $errors->first('Language') }}</strong>
                 </span>
                @endif
          </div>
        </div>     
         <?php foreach($data as $key => $value)
               { 
                if($key == "english")
                  {
                   foreach($value as $key1 =>$value1){
         ?>      
          <div id="LangDiv" class="form-group">
               <label class="col-sm-2 control-label"><?php echo $key1?></label>    
           
              <div class="col-sm-10"">
                 <input class="form-control" type="text" name="language[]" value="<?php
                 echo $value1;?>">
              </div>
          </div>
        <?php }} }?> 
        <a href="#collapse1" class="nav-toggle">Add Menu</a>
        <div id="collapse1" style="display: none;" class="form-group">
               <label class="col-sm-2 control-label"></label>  
               <div class="col-sm-10"">
                <input  type="text" name="menu_label" id="menu_label" value="" placeholder="please enter menu Label" >&nbsp;&nbsp;&nbsp;<input type="text" name="menu_key" id="menu_key" value="" placeholder="please enter menu name">   
                </div>
          
              @if ($errors->has('menu_label'))
              <span class="help-block">
                    <strong>{{ $errors->first('menu_label') }}</strong>
              </span>
              @endif
          </div>                
      </div>
      <!-- /.box-body -->
      <div class="box-footer">
        <button type="submit" class="btn btn-info pull-right  save_btnl ">Update</button>
      </div>
      <!-- /.box-footer -->
    </form>
  </div>
@endsection
@section('footer')
{!!Html::script('/public/js/languagechange.js')!!}
@endsection

    