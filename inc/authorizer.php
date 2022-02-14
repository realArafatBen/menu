<?php
if(empty($_SESSION["user_cache"])){
	$return_url=basename($_SERVER['PHP_SELF']);
	header("Location: logout.php?return_url=".$return_url); 
	exit; 
}

# ===================================================
# Fetch Account details =============================
# ===================================================
$user_cache = $_SESSION["user_cache"];
$sql="SELECT * FROM users WHERE id='$user_cache'";
foreach ($con->query($sql) as $row) {
	$yrNm = $row['nm']; $yrEm=$row['em'];
	$yrPn = $row['pn']; $yrdept=$row['dept'];
	$isRVL = $row['rvl']; $isAdmin = $row['adm'];
	$_SESSION['hidden_pw']=$row['pw']; 
}
?>