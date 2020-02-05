<?php

include('config.php');

$facebook_output = '';

//this will redirect login helper
$facebook_helper = $facebook->getRedirectLoginHelper();

//checks if the user is logged in using facebook account
if(isset($_GET['code']))
{
    if(isset($_SESSION['access_token']))
    {
        //if true store session access_token in variable access_token
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
        $_SESSION['user_image'] = 'http://graph.facebook.com/' .$facebook_user_info['id'] . '/picture';
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
    $facebook_permission = ['email'];

    $facebook_login_url = $facebook_helper->getLoginUrl('https://donantoniotattoo.herokuapp.com/', $facebook_permissions);

    $facebook_login_url = '<p>ur r not logged in</p>';
}



?>



<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Don Antonio Tattoo</title>
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js"></script>
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>
	<script src="https://use.fontawesome.com/releases/v5.0.8/js/all.js"></script>
	<link href="style02.css" rel="stylesheet">
</head>
<body>

<!-- Navigation -->

<nav class="navbar navbar-expand-md navbar-dark bg-dark sticky-top" >
    <div class="container-fluid">
        <a class="navbar-brand" href="#"><img src="img/newlogo.png"></a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" 
        data-target="#navbarResponsive">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarResponsive">
            <ul class="navbar-nav ml-auto">
                <li class="nav-item">
                    <a class="nav-link" href="#">TATTOO</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#">PIERCING</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#">BLOG</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#">SUPPLIES</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#">LOCATION</a>
                </li>
            </ul>
    
        </div>
            <div>
            <?php

                if(isset($facebook_login_url))
                {
                echo $facebook_login_url;
                }
                else{
                 echo '<p>u r logged in</p>';
                }

                ?>
            </div>
    </div>
    </nav>

<!--- Image Slider -->

<!--- Fixed background -->
<section id="features">
    
            <div class="DAlogo" id="logo1">
				<h1 class="DAlogo"><img id="centerlogo" src="img/DA.png"></a></h1>
				<button class="DAlogo btn btn-outline-light btn-lg" type="button">
				BOOK NOW
				</button>
			</div>
    
</section>

<!--- Jumbotron -->


<!--- Welcome Section -->


<!--- Three Column Section -->


<!--- Two Column Section -->

<!--- Emoji Section -->

  
<!--- Meet the team -->


<!--- Cards -->


<!--- Two Column Section -->


<!--- Connect -->


<!--- Footer -->


</body>
</html>













