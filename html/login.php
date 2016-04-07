
<?php 

include_once("config.php");

  if($_SERVER["REQUEST_METHOD"] == "POST") { 

    $username = $_POST['username'];
    $password = $_POST['password'];

    $string = $username . "---" . $password;

    $url = $API_SERVER_ADDRESS .  'api/users/login';
    $data = array('username' => $username, 'password' => $password);

    // use key 'http' even if you send the request to https://...
    $options = array(
        'http' => array(
            'header'  => "Content-type: application/x-www-form-urlencoded\r\n",
            'method'  => 'POST',
            'content' => http_build_query($data)
        )
    );
    $context  = stream_context_create($options);
    $result = file_get_contents($url, false, $context);

    if ($result == "null") { 

      $error = "Invalid Username/Password"; /* Handle error */ 
    } else {
      
          $response_json = json_decode($result, true);
    
          session_start();

          $_SESSION['login_customer_name'] =  $response_json['name'];
          $_SESSION['login_customer_email'] =  $response_json['email'];
          $_SESSION['login_customer_Id'] =  $response_json['Id'];
          

          header("Location: index.php");
  

    }



//    var_dump($result);


  }

?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8" />
  <title>RabbitMail | Login</title>

  <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1" />

  <link rel="stylesheet" href="../bower_components/bootstrap/dist/css/bootstrap.css" type="text/css" />
  <link rel="stylesheet" href="../bower_components/animate.css/animate.css" type="text/css" />
  <link rel="stylesheet" href="../bower_components/font-awesome/css/font-awesome.min.css" type="text/css" />
  <link rel="stylesheet" href="../bower_components/simple-line-icons/css/simple-line-icons.css" type="text/css" />
  <link rel="stylesheet" href="css/font.css" type="text/css" />
  <link rel="stylesheet" href="css/app.css" type="text/css" />

</head>
<body>
<div class="app app-header-fixed  ">
  

<div class="container w-xxl w-auto-xs" ng-controller="SigninFormController" ng-init="app.settings.container = false;">
  <a href class="navbar-brand block m-t">RabbitMail</a>
  <div class="m-b-lg">
    <div class="wrapper text-center">
      <strong>Login into your account</strong>


    </div>
    <form name="form" action = "" method = "post" class="form-validation">
      <div class="text-danger wrapper text-center" >
          
      </div>

      <?php if(isset($error)) { ?>

      <div class="alert alert-danger">
        <p><?php echo $error; ?></p>
      </div>
      <?php } ?>
      <div class="list-group list-group-sm">
        <div class="list-group-item">
          <input type="email" placeholder="Email" class="form-control no-border" name="username" required>
        </div>
        <div class="list-group-item">
           <input type="password" placeholder="Password" class="form-control no-border" name="password" required>
        </div>
      </div>
      <button type="submit" class="btn btn-lg btn-primary btn-block">Log in</button>
      <div class="line line-dashed"></div>
      <p class="text-center"><small>Do not have an account?</small></p>
      <a ui-sref="access.signup" class="btn btn-lg btn-default btn-block">Create an account</a>
    </form>
  </div>
  <div class="text-center" ng-include="'tpl/blocks/page_footer.html'">
    <p>
  <small class="text-muted">RabbitMail &copy; 2016</small>
</p>
  </div>
</div>


</div>

<script src="../bower_components/jquery/dist/jquery.min.js"></script>
<script src="../bower_components/bootstrap/dist/js/bootstrap.js"></script>
<script src="js/ui-load.js"></script>
<script src="js/ui-jp.config.js"></script>
<script src="js/ui-jp.js"></script>
<script src="js/ui-nav.js"></script>
<script src="js/ui-toggle.js"></script>

</body>
</html>
