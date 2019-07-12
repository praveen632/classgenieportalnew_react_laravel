<!DOCTYPE html>
<html lang="en">
<meta http-equiv="content-type" content="text/html;charset=UTF-8" />
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Classgenie Login</title>
  
    <link rel="shortcut icon" href="{{{ asset('public/images/favicon.ico') }}}">
    {!!Html::style('public/login_data/css/screen.css');!!}
    {!!Html::style('public/login_data/css/font.css');!!}
    {!!Html::style('public/login_data/css/bootstrap.min.css');!!}
    
        <style type="text/css">
         #loginForm label.error {
            margin-left: 10px;
            width: auto;
            display: inline;
            font-weight: 100;
        }  
    </style>
</head>
<body id="app-layout" class="login_back color_bg wrapper">     
<div>
<div class="container">
    <div class="row wrapper">
        <div class="col-md-5 col-md-offset-4">
        <div class="logo_image"> {{HTML::image('public/images/newlogo.png')}}</div>
            <div class="panel panel-default">
              <div class="panel-heading login_header">Login</div>
                <div class="panel-body">
                  <div  id="error"></div> 
                    <form class="form-horizontal" role="form" name="loginForm" id="loginForm" method="POST" action="">
                        {!! csrf_field() !!}
                        <div class="col-md-12">
                          @if(Session::has('message'))
                           <div class="alert alert-danger" style="text-align:center;">
                            <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                            <strong> {{ Session::get('message') }}</strong>
                          </div>
                          @endif
                        </div>  
                        <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">     
                            <div class="col-md-12 login-input">
                            <span class="glyphicon glyphicon-user glyphiconLinkColor"></span>
                           
                                <input type="text" class="form-control new_form" name="email" value="<?php if(isset($_COOKIE['email'])){ echo $_COOKIE['email']; } ?>">
                                @if ($errors->has('email'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('email') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                        <div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}"> 
                            <div class="col-md-12 login-input">
                            <span class="glyphicon glyphicon-lock glyphiconLinkColor"></span>
                                <input type="password" class="form-control new_form" name="password" value="<?php if(isset($_COOKIE['password'])){ echo $_COOKIE['password']; } ?>">
                                @if ($errors->has('password'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('password') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="col-md-12">
                                <div class="checkbox">
                                    <label>
                                        <input type="checkbox" name="remember"> Remember Me
                                    </label>
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="col-md-12">
                                <button type="submit" class="btn col-md-12 col-xs-12 login_submit">
                                    <i class="fa fa-btn fa-sign-in"></i>Log In
                                </button>
                            </div>
                        </div>
                    </form>
                    <!--<div> <a href="signup.php" class="sign-up">Don't have an account yet? <strong>Sign Up</strong></a> 
                   </div>--> 
                </div>
            </div>            
        </div>       
    </div>
</div>
</div>
</body>
</html>