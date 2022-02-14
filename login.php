<?php 
 include_once('inc/conn.php');
 include_once('inc/functions.php');
 include_once('inc/pagination.php');
?>

<link href="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
<script src="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/js/bootstrap.min.js"></script>
<script src="//cdnjs.cloudflare.com/ajax/libs/jquery/2.2.4/jquery.min.js"></script>
<!------ Include the above in your HEAD tag ---------->


<html>
  <head>

  <link href="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
<script src="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/js/bootstrap.min.js"></script>
<script src="//cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
<!------ Include the above in your HEAD tag ---------->

<style>
body#LoginForm{ background-image:url("/images/pavilion.jpg"); background-repeat:no-repeat; background-position:center; background-size:cover; padding:10px;}

.form-heading { color:#fff; font-size:23px;}
.panel h2{ color:#444444; font-size:18px; margin:0 0 8px 0;}
.panel p { color:#777777; font-size:14px; margin-bottom:30px; line-height:24px;}
.login-form .form-control {
  background: #f7f7f7 none repeat scroll 0 0;
  border: 1px solid #d4d4d4;
  border-radius: 4px;
  font-size: 14px;
  height: 50px;
  line-height: 50px;
}
.main-div {
  background: #ffffff none repeat scroll 0 0;
  border-radius: 2px;
  margin: 10px auto 30px;
  max-width: 38%;
  padding: 50px 70px 70px 71px;
}

.login-form .form-group {
  margin-bottom:10px;
}
.login-form{ text-align:center;}
.forgot a {
  color: #777777;
  font-size: 14px;
  text-decoration: underline;
}
.login-form  .btn.btn-primary {
  background: #f0ad4e none repeat scroll 0 0;
  border-color: #f0ad4e;
  color: #ffffff;
  font-size: 14px;
  width: 100%;
  height: 50px;
  line-height: 50px;
  padding: 0;
}
.forgot {
  text-align: left; margin-bottom:30px;
}
.botto-text {
  color: #ffffff;
  font-size: 14px;
  margin: auto;
}
.login-form .btn.btn-primary.reset {
  background: #ff9900 none repeat scroll 0 0;
}
.back { text-align: left; margin-top:10px;}
.back a {color: #444444; font-size: 13px;text-decoration: none;}
</style>


  </head>
<body id="LoginForm">
<div class="container">

<div class="alert" style="text-align:center;"> 
<?php 
if(isset($_POST['login'])){
	$em = trim(strtolower($_POST['em'])); $pw = trim($_POST['pw']);
	$_SESSION['em'] = $em; $_SESSION['pw'] = $pw; 
	
	if(empty($em) || empty($pw)){
		echo alert('Please fill required fields','notice');
	}else{
	# Prevent MySQL Injection while validating login								
	$query = $con->prepare("SELECT * FROM users 
			 WHERE em = :em AND pw = :pw");													
	$query -> execute(array('em'=>$em, 'pw'=>$pw));	
								
	// Get database value ----------------------------------------	
	//$query = $con->query('SELECT * FROM dashboard_ac');
	while($row = $query->fetch()){
		if($row['em'] == $em && $row['pw'] == $pw){
		$username=$row['em']; $password=$row['pw'];
		$user_cache = $row['id']; $status = $row['status'];
		}
	}# while statement --------------------------------------
			
	$count = $con->query('SELECT COUNT(*) FROM users');									
	if($count->fetchColumn() == 0){ # database is empty
			echo alert("Blank Mode. Contact live help.", "error"); 			
	}elseif($username != $em && $password != $pw){ # wrong matching
			echo alert("Invalid account info, Retry.", "error");
	}elseif($status == 1){ # Blocked Access
			echo alert("Account Blocked. Contact Administrator.", "error");
	}else{	
					
		switch ($status){
			case 0:				
				$_SESSION["user_cache"]=$user_cache; $_SESSION['back_pw']='';
				if(isset($_GET['return_url'])){
					$return_url = $_GET['return_url'];
				}else{
					$return_url = "";
				}
				if(empty($return_url)){
					$_SESSION['back_pw']='';
					header("Location: dashboard.php");		
					exit;
				}else{			
					header("Location: ".$return_url);
					exit;
				}	
			break;
				
		} # Switch ends	
				
	} # if statement ends	
} # empty

}
?>
</div>
<div class="login-form">
<div class="main-div">
    <div class="panel">
   <h2>Admin Panel Login</h2>
   <p>Please enter your log in details</p>
   </div>
<form id="Login" method="post">
<div class="form-group">
<input type="email" name="em" class="form-control" id="em" value="<?php echo ( isset($_SESSION['em']) ? $_SESSION['em'] : "" );  ?>" placeholder="Email Address">

</div>
<div class="form-group">

    <input type="password" name="pw" class="form-control" value="" id="pw" placeholder="Input password">

</div>
<div class="forgot">
<a href="reset.html">Forgot password?</a>
</div>
<button type="submit" name="login" class="btn btn-primary">Login</button>

</form>
    </div>
<p class="botto-text">Powered by Jubilee Systems Ltd</p>
</div></div></div>


</body>
</html>
