<?php
session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <title>Search</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="../css/bootstrap.min.css">
   <link rel="stylesheet" type="text/css" href="../css/style.css">
   <link rel="icon" href="../img/favicon.ico">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
  <script src="../js/bootstrap.min.js"></script>
</head>
<body  style="background-color: #EFF0F1;">
 <div id="wrap">
<nav class="navbar navbar-inverse">
  <div class="container-fluid container">
    <div class="navbar-header ">
      <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#myNavbar">
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
      </button>
      <a class="navbar-brand" href="http://www.inlem.org/" style="color: #0c00ff;">Indiana Law Enforcement Memorial</a>
    </div>
    <div class="collapse navbar-collapse" id="myNavbar">
      <ul class="nav navbar-nav">
        
      </ul>
      <ul class="nav navbar-nav navbar-right">
       <li > <a href="../index.php">Search Home</a></li>
        <li> <a href="../officer-list.php">Master List</a></li> 
        <li><a href="http://inlem.org/index.php/about/contact">Contact Us</a></li>
        <li><a href="http://inlem.org/index.php/donate">Donate</a></li>
        </ul>
    </div>
  </div>
</nav>

<div class="container"  style="background-color: #fff;">
<div class="box-body">
                  <?php if($_SESSION['msg']!=""){?>
                  <div class="alert alert-danger">
                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                   <?php echo $_SESSION['msg'];
                $_SESSION['msg']="";?>
                  </div>
                  <?php }?>
                  </div>


  <h3>Login</h3>
 <form action="check-login.php" method="post">




 <div class="row form-group">
 	<div class="col-xs-12 col-sm-12 col-md-2 col-lg-2">
 		<label>Username</label>
 	</div>
 	<div class="col-xs-12 col-sm-4 col-md-3 col-lg-3">
 		<input type="text" name="usr" id="usr" class="form-control">
 	</div>
 	<div class="col-xs-12 col-sm-4 col-md-3 col-lg-3">
 		<label>Password</label>
 	</div>
 	<div class="col-xs-12 col-sm-4 col-md-3 col-lg-3">
 	<input type="password" name="pass" id="pass" class="form-control">
 	</div>
 </div>

  <input type="submit" name="login" value="Login">
  <br>
  <br>
</form>

</div>
</div>
<?php
include '../footer.php';
?>
</body>
</html>