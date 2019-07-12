<?php $environment = App::environment();
 $menu  = base_path().'/cg-admin/public/assets/json/'.($environment == 'development' ? 'language' : 'language.min').'.json';
$datass = file_get_contents($menu);
$data = json_decode($datass,true);
?>
<?php if($datas[0]->id ==  '1') { ?>
  <nav class="navbar navbar-default main-nav navbar-fixed-top">
        <div class="container">
          <div class="navbar-header">
            <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#nav-clps" aria-expanded="false">
              <span class="sr-only">Toggle navigation</span>
              <span class="icon-bar"></span>
              <span class="icon-bar"></span>
              <span class="icon-bar"></span>
            </button>
            <a class="navbar-brand" href="<?php echo $data['english']['HOME']; ?>"><img src="images/logo/logo11.png"" alt="logo"></a><!--HEADER LOGO-->
          </div>
         <div class="collapse navbar-collapse" id="nav-clps">
          <ul class="nav navbar-nav navbar-right"><!--START MENU LIST-->
            <li id="js--homesection"><a  href="<?php echo $data['english']['HOME']; ?>">Home</a></li>
            <li id="js--aboutsection"><a href="<?php echo $data['english']['ABOUT']; ?>">About</a></li>
            <li id="js--featuressection"><a href="<?php echo $data['english']['FEATURES']; ?>">Feature</a></li>
            <li id="js--shotssection"><a href="http://<?php echo ($environment == 'production' ? 'blog' : 'stagingblog') ?>.classgenie.in/" target="_blank">Blog</a></li>
            <li id="js--pricesplan"><a href="http://<?php echo ($environment == 'production' ? 'faq' : 'stagingfaq') ?>.classgenie.in/" target="_blank">Faq's</a></li>
            <li id="js--contactsection"><a href="<?php echo $data['english']['CONTACT']; ?>">Contact</a></li>
            
             <?php if($value) { ?>
                <li><a href="logout">   <button type="text" class="login-t"> Teacher Logout </button></a></li>
                 <?php }else{ ?>
                  <li><a href="http://<?php  echo ($environment== 'production' ? '':'staging.');?>classgenie.in/cg-panel/#/login">   <button type="text" class="login-t"> Teacher Login </button></a></li>                                     
                 <?php } ?>
          </ul><!--END MENU LIST-->
          </div>
        </div>
      </nav>
<?php }else { ?>
    <nav class="navbar navbar-default main-nav navbar-fixed-top">
        <div class="container">
          <div class="navbar-header">
            <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#nav-clps" aria-expanded="false">
              <span class="sr-only">Toggle navigation</span>
              <span class="icon-bar"></span>
              <span class="icon-bar"></span>
              <span class="icon-bar"></span>
            </button>
            <a class="navbar-brand" href="<?php echo $data['english']['HOME']; ?>"><img src="images/logo/logo11.png" alt="logo"></a><!--HEADER LOGO-->
          </div>
         <div class="collapse navbar-collapse" id="nav-clps">
          <ul class="nav navbar-nav navbar-right"><!--START MENU LIST-->
            <li id="js--homesection"><a  href="<?php echo $data['english']['HOME']; ?>">Home</a></li>
            <li id="js--aboutsection"><a href="<?php echo $data['english']['ABOUT']; ?>">About</a></li>
            <li id="js--featuressection"><a href="<?php echo $data['english']['FEATURES']; ?>">Feature</a></li>
            <li id="js--shotssection"><a href="http://<?php echo ($environment == 'production' ? 'blog' : 'stagingblog') ?>.classgenie.in/" target="_blank">Blog</a></li>
            <li id="js--pricesplan"><a href="http://<?php echo ($environment == 'production' ? 'faq' : 'stagingfaq') ?>.classgenie.in/" target="_blank">Faq's</a></li>
            <li id="js--contactsection"><a href="<?php echo $data['english']['CONTACT']; ?>">Contact</a></li>
            
             <?php if($value) { ?>
                <li><a href="logout">   <button type="text" class="login-t"> Teacher Logout </button></a></li>
                 <?php }else{ ?>
                  <li><a href="http://<?php  echo ($environment== 'production' ? '':'staging.');?>classgenie.in/cg-panel/#/login">   <button type="text" class="login-t"> Teacher Login </button></a></li>                                     
                 <?php } ?>
          </ul><!--END MENU LIST-->
          </div>
        </div>
      </nav>
<?php } ?>  