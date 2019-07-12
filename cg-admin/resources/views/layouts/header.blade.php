<script>
var Siteurl = "<?php echo url('/');?>";
</script>
<?php 
$data = Session::get('data');
$url = url('/');
if(!isset($data)){
    if(Session::get('username') == ""){
        header('Location:'.$url.'/login');
       die();
    }
  }else
  {
  $id = $data->id;  
  }
?>

<body class="hold-transition skin-blue sidebar-mini">
<div class="wrapper">

  <header class="main-header">
    <!-- Logo -->
    <a href="<?php echo $url;?>/home" class="logo">
      <!-- mini logo for sidebar mini 50x50 pixels -->
      <span class="logo-mini   logo_header">{{Html::image('public/images/newlogo.png')}}</span>
      <!-- logo for regular state and mobile devices -->
      <span class="logo-lg  logo_n">
        {{Html::image('public/images/logo.png')}} <!--<strong>Classgenie</strong>  -->
      </span>
    </a>
    <!-- Header Navbar: style can be found in header.less -->
    <nav class="navbar navbar-static-top">
      <!-- Sidebar toggle button-->
      <a href="#" class="sidebar-toggle" data-toggle="push-menu" role="button" id="sidebar-toggle">
        <span class="sr-only">Toggle navigation</span>
      </a>
      <div class="navbar-custom-menu" >   
        <ul class="nav navbar-nav">
      <!-- Notifications: style can be found in dropdown.less -->
           <!--  <li class="dropdown notifications-menu">
                <a href="#" class="dropdown-toggle" data-toggle="dropdown" aria-expanded="false" onclick="showNotification(this);">
                  <i class="fa fa-bell-o"></i>
                  <span class="label label-warning" id="totalnotification"></span>
                </a>
                <ul class="dropdown-menu">
                  
                  <li>

                    <ul class="menu" id="tblTaxList">
                        
                    </ul>
                  </li>
                  <li class="footer"><a href="expiry_medicine.php">View all</a></li>
                </ul>
              </li> -->
      <!-- Tasks: style can be found in dropdown.less -->
         <!--  <li class="dropdown notifications-menu">
            <a href="#" class="dropdown-toggle" data-toggle="dropdown" aria-expanded="false" onclick="showNotification(this);">
              <i class="fa fa-flag-o"></i>
              <span class="label label-danger" id="totalshtgstock"></span>
            </a>
            <ul class="dropdown-menu">            
              <li>
               <ul class="menu" id="shtgstock">
               </ul>
              </li>             
              <li class="footer">
                <a href="shortage_stock.php">View all tasks</a>
              </li>
            </ul>
          </li>  -->        
           <li class="dropdown user user-menu">
            <a href="#" class="dropdown-toggle" >             
              <span class="hidden-xs">Welcome&nbsp;&nbsp;<?php echo Session::get('username')?> </span>
            </a>            
          </li>
          <!-- User Account: style can be found in dropdown.less -->
          <li class="dropdown user user-menu">
            <a class="dropdown-toggle" href="<?php echo $url;?>/logout" onclick="removeMenu()">             
              <span class="hidden-xs">Log out</span>
            </a>
           
          </li>
          <!-- Control Sidebar Toggle Button -->          
        </ul>
      </div>
    </nav>
  </header>
    
  <!-- <script type="text/javascript">
      $(document).ready(function(){
         $('#tblTaxList').html('');
               $('#totalnotification').append(0); 
         });

          $(document).ready(function(){
                $('#shtgstock').html('');
                $('#totalshtgstock').append(0);     
         });      

        showNotification = function(obj){return false;
          if($(obj).attr('aria-expanded') == 'true'){
              $(obj).attr('aria-expanded','false');
              $(obj).parent().removeClass('open');
          }
          else
          {
              $(obj).attr('aria-expanded','true');
              $(obj).parent().addClass('open');
          }
        }
    </script> -->