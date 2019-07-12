  <!DOCTYPE html>
<html lang="en">
<meta http-equiv="content-type" content="text/html;charset=UTF-8" />
  <head>
   <meta charset="utf-8">
        <META NAME="ROBOTS" CONTENT="NOINDEX, NOFOLLOW">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="keywords" content="<?php echo $datas['0']->metakey ?>">
        <meta name="description" content="<?php echo $datas['0']->metadesc ?>">
       <!--  <title><%= title %></title> -->
         <title><?php echo $datas['0']->title ?></title> <!--Title Name -->       
         <link href="{{ asset('img/favicon.ico') }}" type="image/png" rel="icon" >
         <link href="{{ asset('css/bootstrap.css') }}" rel="stylesheet" >
         <link href="{{ asset('lity/lity.min.css') }}" rel="stylesheet" >
         <link href="{{ asset('owlcarousel/owl.carousel.min.css') }}" rel="stylesheet" >

         <link href="{{ asset('owlcarousel/owl.theme.default.min.css') }}" rel="stylesheet" >
         <link href="{{ asset('css/animate.css') }}" rel="stylesheet" >
         <link href="{{ asset('css/font-awesome.css') }}" rel="stylesheet" >
         <link href="{{ asset('Icon-font-7-stroke/assets/Pe-icon-7-stroke.css') }}" rel="stylesheet" >
         <link href="{{ asset('css/main.css') }}" rel="stylesheet" >
         <link href="{{ asset('css/responsive.css') }}" rel="stylesheet" >
         <!-- <% if(render_page == 'forgot_password'){ %>
           <link href="css/forgot_password.css" rel="stylesheet">
        <% }%>  -->
        <link href="https://fonts.googleapis.com/css?family=Montserrat:300,400,500,700" rel="stylesheet">
        <script src="{{ asset('js/jquery-2.2.4.min.js')}}"></script>
                <!-- SWITCHER -->   
        
        <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
        <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
        <![endif]-->
<!-- <script type="text/javascript">
// <% if(render_page == 'login' || render_page == 'accountsetting' || render_page == 'classmanagement'){ %>
//     var api_url = '<%= config.api_url %>'
// <% } %>
// $(document).ready(function () {
//     $('#myCarousel').carousel({
//         interval: 10000
//     })
//     $('.fdi-Carousel .item').each(function () {
//         var next = $(this).next();
//         if (!next.length) {
//             next = $(this).siblings(':first');
//         }
//         next.children(':first-child').clone().appendTo($(this));

//         if (next.next().length > 0) {
//             next.next().children(':first-child').clone().appendTo($(this));
//         }
//         else {
//             $(this).siblings(':first').children(':first-child').clone().appendTo($(this));
//         }
//     });
// });

// $(document).ready(function () {
//     $('#horizontalTab').easyResponsiveTabs({
//             type: 'default', //Types: default, vertical, accordion           
//             width: 'auto', //auto or any width like 600px
//             fit: true   // 100% fit in a container
//         });
//     });

 
</script> -->
  </head>

  <body class="nav-md">
      <div class="main_container">
        @include('layouts.header')

             <?php 
               if($datas[0]->id == '1'){
                 echo $datas[0]->description;
               }else if($datas[0]->id == '2'){
                  echo $datas[0]->description;
              }else if($datas[0]->id == '3'){
                   echo $datas[0]->description;
              }else if($datas[0]->id == '5'){
                   echo $datas[0]->description;
              }else if($datas[0]->id == '6'){
                   echo $datas[0]->description;
              }else if($datas[0]->id == '7'){
                   echo $datas[0]->description;
              }   
             ?>
             @include('sections.newsletter');       
             @include('layouts.footer')
       
        <!-- /footer content -->
      </div>
   </body>
</html>



