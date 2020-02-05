<?php

include('config.php');


$facebook_output = '';

//this will redirect login helper
$facebook_helper = $facebook->getRedirectLoginHelper();


//checks if the user is logged in using facebook account
if(isset($_GET['code']))
{
    if(isset($_GET['access_token']))
    {
        $access_token = $_SESSION['access_token'];
    }
    else
    {
        $access_token = $facebook_helper->getAccessToken();

        $_SESSION['access_token'] = $access_token;

        $facebook->setDefaultAccessToken($_SESSION['access_token']);
    }


    //getting facebook user data
    $graph_response = $facebook->get("/me?fields=name,email", $access_token);
    
    //this will return user data
    $facebook_user_info = $graph_response->getGraphUser();
    
    //checks the user's dp
    if(!empty($facebook_user_info['id']))
    {
        //stores the user's DP
        $_SESSION['user_image'] = 'http://graph.facebook.com/'.$facebook_user_info['id'].'/picture';
    }
    //checks name
    if(!empty($facebook_user_info['name']))
    {
        $_SESSION['user_name'] = $facebook_user_info['name'];
    }
    // checks email
    if(!empty($facebook_user_info['email']))
    {
        $_SESSION['user_email_address'] = $facebook_user_info['email'];
    }
}

//if not logged in displays login page
else
{
    $facebook_permissions = ['email'];
    //stores index page in $facebook_login_url

    //later to be use to redirect user to index page in order to login

    //by using php echo

    $facebook_login_url = $facebook_helper->getLoginUrl('https://donantonio.herokuapp.com/', $facebook_permissions);

    //gives index page with clickable link thats leads facebook login url
    $facebook_login_url = '<div align="center"><a href="'.$facebook_login_url.'"><img src="php-login-with-facebook.gif" /></a></div>';
}
?>

<html>
 <head>
  <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
  <title>PHP Login using Google Account</title>
  <meta content='width=device-width, initial-scale=1, maximum-scale=1' name='viewport'/>
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>
  <link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" rel="stylesheet" />
  
 </head>
 <body>
  <div class="container">
   <br />
   <h2 align="center">PHP Login using Google Account</h2>
   <br />
   <div class="panel panel-default">
    <?php 
    // checks if the $facebook_login_url set
    // changes index page content from what is stored in $facebook_login_url
    if(isset($facebook_login_url))
    {
     echo $facebook_login_url;
    }
    //displays welcome page with facebook user's credentials using index page
    else
    {
     echo '<div class="panel-heading">Welcome User</div><div class="panel-body">';
     echo '<img src="'.$_SESSION["user_image"].'" class="img-responsive img-circle img-thumbnail" />';
     echo '<h3><b>Name :</b> '.$_SESSION['user_name'].'</h3>';
     echo '<h3><b>Email :</b> '.$_SESSION['user_email_address'].'</h3>';
     echo '<h3><a href="logout.php">Logout</h3></div>';
    }
    ?>
   </div>
  </div>
 </body>
</html>
