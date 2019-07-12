@extends('layouts.dashboard')
<style type="text/css"></style>
        <title>A Simple Page with CKEditor</title>
        
        <!-- Make sure the path to CKEditor is correct. -->
        <script src="editor/ckeditor.js"></script>
        <script type="text/javascript" src="editor/config.js"></script>
        <script type="text/javascript" src="editor/lang/en-gb.js"></script>
        <script type="text/javascript" src="editor/styles.js"></script>
        <style type="text/css" src="editor/editor_gecko.css"></style>
        <style type="text/css"></style>
        <script type="text/javascript">    

     function show()
     {
           $.ajaxSetup(
        {
            headers:
            {
                'X-CSRF-Token': $('input[name="_token"]').val()
            }
        });
     var data1 = CKEDITOR.instances.editor1.getData();

     var data2 ={"data":data1,"name":$('#pg_name').val(), "title":
     $('#pg_title').val(), "Url" :$('#pg_url').val()}; 

     console.log(data2);

     $.ajax({
      url: 'savecontent',
      type: "post",
      data: data2,
     // dataType:"text",
      success: function(data){
        alert(data);
      }
    });      
               
}
    </script>
    </head>
    <body>

        <form class="conten">
        {!! csrf_field() !!}
        <div class="form-group">
        	<label>Page Name</label><input type="text" class="form-control"  name="page_name" placeholder="Name" id="pg_name"></input>
        	<label>Page Url</label><input type="text" class="form-control"  name="page_name" placeholder="Http://www.example.com" id="pg_url"></input>
        	<label>Page Title</label><input type="text" class="form-control"  name="page_name" placeholder="title" id="pg_title"></input>
        </div>
             <label>Description</label>
               <textarea name="editor1" id="editor1" rows="10" cols="80">
               </textarea>
            <script>
                CKEDITOR.replace( 'editor1' );               
            </script>
            <button type="button" class="btn btn-primary"onclick="show()">Submit</button>
        </form>
        
    