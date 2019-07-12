<!DOCTYPE html>
<html lang="en"> 
<head> 
<meta charset="utf-8"> 
<meta name="viewport" content="width=device-width, initial-scale=1.0, minimum-scale=1.0, maximum-scale=1.0, user-scalable=0"/> 
<title>Classgenie</title>
 
  <link rel="icon" type="image/png" href="{{{ asset('public/images/favicon.ico') }}}">
 <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>Classgenie | Dashboard</title>
  <!-- Tell the browser to be responsive to screen width -->
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
  <!-- Bootstrap 3.3.7 -->  
  {!!Html::style('public/assets/bower_components/bootstrap/dist/css/bootstrap.min.css');!!}
  {!!Html::style('public/assets/bower_components/font-awesome/css/font-awesome.min.css');!!}
  {!!Html::style('public/assets/bower_components/Ionicons/css/ionicons.min.css');!!}
  {!!Html::style('/css/AdminLTE.min.css');!!}
  {!!Html::style('css/skins/_all-skins.min.css');!!}
  {!!Html::style('public/assets//bower_components/select2/dist/css/select2.min.css');!!}
  {!!Html::style('/css/skins/_all-skins.min.css');!!}
  {!!Html::style('public/assets/bower_components/morris.js/morris.css');!!}
  {!!Html::style('public/assets/bower_components/jvectormap/jquery-jvectormap.css');!!}
  {!!Html::style('public/assets/bower_components/bootstrap-datepicker/dist/css/bootstrap-datepicker.min.css');!!}
  {!!Html::style('public/assets/bower_components/bootstrap-daterangepicker/daterangepicker.css');!!}
  {!!Html::style('public/assets/plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.min.css');!!}
  {!!Html::style('/css/style.css');!!}
  {!!Html::style('public/assets/css/pagination.css');!!}
  {!!Html::script('public/assets/bower_components/jquery/dist/jquery.min.js');!!}
  {!!Html::script('public/assets/bower_components/jquery-ui/jquery-ui.min.js');!!}
  {!!Html::script('public/js/loader.js');!!}
  {!!Html::script('public/js/ajaxloader.js');!!}
  {!!Html::script('public/assets/js/store.js');!!}
  {!!Html::script('public/assets/js/jquery.pagination.js');!!}
  

</body>
</head> 
<?php $env = array( 'env' => env('APP_ENV'));?>
<body class="skin-blue sidebar-mini">	
@include('layouts.header')
@include('layouts.sidebar')
@include('home')
<div class="content-wrapper">
  @yield('content')
</div>
<input type="hidden" id="env" value=''></input>
<script type="text/javascript">
var env = '<?php echo $env['env']; ?>';
document.getElementById('env').value = env;
</script>
@include('layouts.footer')
@yield('footer')
</body>
</html>
