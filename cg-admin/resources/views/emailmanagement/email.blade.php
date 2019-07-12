@extends('layouts.dashboard')
{!!Html::style('/public/editor/editor_gecko.css')!!}
{!!Html::script('/public/editor/ckeditor.js')!!}
@section('content')    
      <div class="box box-info">
    <div class="box-header with-border">
      <h3 class="box-title">Email Content</h3>&nbsp&nbsp<a class="btn btn-success search_btn-add  add_newbtn" href="<?php echo url('/emaillist')?>">View Content List</a>
    </div>
    <?php 
     if(isset($item))
     { ?>  
    <!-- /.box-header -->
    <!-- form start -->
    <form class="form-horizontal" id="ckformforemailupdate" action="{{ url('emailcontent/save') }}" method="POST">
         {!! csrf_field() !!}        
      <div class="box-body">
        <div class="form-group">
          <label for="inputEmail3" class="col-sm-2 control-label">Type</label>
          <div class="col-sm-10">
             <input type="text" class="form-control"  name="type12" value="<?php echo $item['type'];?>" placeholder="" id="type12" required></input>               
          </div>
        </div>
        <div class="form-group">
          <label for="inputPassword3" class="col-sm-2 control-label">From Email</label>
          <div class="col-sm-10">
           <input type="email" class="form-control"  name="from_email" placeholder="" value="<?php echo $item['from_email'];?>" id="from_email" required></input>             
          </div>
        </div>
        <div class="form-group">
          <label for="inputPassword3" class="col-sm-2 control-label">Subject</label>
          <div class="col-sm-10">
          <input type="text" class="form-control"  value="<?php echo $item['subject'];?>" name="subject" placeholder="" id="subject" required></input>            
          </div>
        </div>        
        <div class="form-group">
          <label for="inputPassword3" class="col-sm-2 control-label" required>Body</label>
             <div class="col-sm-10">
                 <textarea name="editor1" id="editor1" rows="10" cols="80" value="">
                    {{$item['body']}} 
                  </textarea>
             </div>
        </div>
        <div class="form-group">
          <label for="inputPassword3" class="col-sm-2 control-label">Feature</label>
             <div class="col-sm-10">
                  <textarea name="editor2" id="editor2" rows="10" cols="80" value="">
                   <?php echo $item['feature'];?>
                  </textarea>
             </div>
        </div>
        <div class="form-group">
          <label for="inputPassword3" class="col-sm-2 control-label">Status</label>
             <div class="col-sm-10">
                  <input type="radio" name="status" value="1" checked>Active&nbsp;
                  <input type="radio" name="status" value="0">In Active<br>                
                  <input type="hidden"  id="cont_id" name="id"  value="<?php echo $item['id'];?>"></input>
             </div>
        </div>                
      </div>
      <script>
         CKEDITOR.replace( 'editor1' );
         CKEDITOR.replace( 'editor2' );                
     </script>
      <!-- /.box-body -->
      <div class="box-footer">
        <button type="submit" class="btn btn-info pull-right">Save</button>
      </div>
      <!-- /.box-footer -->
    </form>
     <?php }else{ ?>
        <form class="form-horizontal" id="ckformforemailsave" action="{{ url('emailcontent/save') }}" method="POST">
         {!! csrf_field() !!}        
      <div class="box-body">
        <div class="form-group">
          <label for="inputEmail3" class="col-sm-2 control-label">Type</label>
          <div class="col-sm-10">
             <input type="text" class="form-control"  name="type12" value=""placeholder="" id="type12" required></input>              
          </div>
        </div>
        <div class="form-group">
          <label for="inputPassword3" class="col-sm-2 control-label">From Email</label>
          <div class="col-sm-10">
          <input type="email" class="form-control"  name="from_email" placeholder="" value="" id="from_email" required></input>             
          </div>
        </div>
        <div class="form-group">
          <label for="inputPassword3" class="col-sm-2 control-label">Subject</label>
          <div class="col-sm-10">
          <input type="text" class="form-control"  value="" name="subject" placeholder="" id="subject" required></input>            
          </div>
        </div>        
        <div class="form-group">
          <label for="inputPassword3" class="col-sm-2 control-label" required>Body</label>
             <div class="col-sm-10">
                <textarea name="editor1" id="editor1" rows="10" cols="80">
            </textarea>
             </div>
        </div>
        <div class="form-group">
          <label for="inputPassword3" class="col-sm-2 control-label">Feature</label>
             <div class="col-sm-10">
                   <textarea name="editor2" id="editor2" rows="10" cols="80">
                   </textarea>
             </div>
        </div>
        <input type="hidden" value="1" name="status" id="status"></input>
        <input type="hidden" value="" id="cont_id" name="id"></input>
                       
      </div>
      <script>
        CKEDITOR.replace( 'editor1' );
        CKEDITOR.replace( 'editor2' );               
      </script>
      <!-- /.box-body -->
      <div class="box-footer">
        <button type="submit" class="btn btn-info pull-right  save_btnl">Save</button>
      </div>
      <!-- /.box-footer -->
    </form>
  </div>
<?php } ?>
@endsection      
@section('footer')
{!!Html::script('/public/editor/styles.js')!!}
{!!Html::script('js/email-content.js')!!}
{!!Html::script('/public/editor/config.js')!!}
@endsection