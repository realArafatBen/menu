<?php 
 include_once('inc/conn.php');
 include_once('inc/functions.php');
 include_once('inc/pagination.php');
?>

<!DOCTYPE html>
<head>

<!-- Basic Page Needs
================================================== -->
<title>QuickMenu Dashboard</title>
<link rel="shortcut icon" type="image/x-icon" href="images/logo.png" />
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">

<!-- CSS
================================================== -->
<link rel="stylesheet" href="css/style.css">
<link rel="stylesheet" href="css/colors/main.css" id="colors">

<style>
.received_msg {
  display: inline-block;
  padding: 0 0 0 10px;
  vertical-align: top;
  width: 92%;
 }
 .received_withd_msg p {
  background: #ebebeb none repeat scroll 0 0;
  border-radius: 3px;
  color: #646464;
  font-size: 14px;
  margin: 0;
  padding: 5px 10px 5px 12px;
  width: 80%;
}
.time_date {
  color: #747474;
  display: block;
  font-size: 12px;
  margin: 8px 0 0;
}
.received_withd_msg { width: 85%;}
.mesgs {
  float: left;
  padding: 30px 15px 0 25px;
  width: 70%;
}

 .sent_msg p {
  background: #05728f none repeat scroll 0 0;
  border-radius: 3px;
  font-size: 14px;
  margin: 0; color:#fff;
  padding: 5px 10px 5px 12px;
  width:100%;
}

.outgoing_msg{ overflow:hidden; margin:26px 0 26px;}
.sent_msg {
  float: right;
  width: 70%;
}
</style>

</head>


<body>
<script language="javascript">
	function del(pid){
		if(confirm('Do you really mean to delete this?')){
			document.form1.pid.value=pid;
			document.form1.command.value='delete';
			document.form1.submit();
		}
	}
	
	function edit(pid){
		document.form1.pid.value=pid;
		document.form1.command.value='edit';
		document.form1.submit();		
	}
	
	
	function isActive(pid){
		if(confirm('Do you wish to continue?')){
			document.form1.pid.value=pid;
			document.form1.command.value='faq';
			document.form1.submit();
		}
	}
	
	function delFAQ(pid){
		if(confirm('Do you wish to continue?')){
			document.form1.pid.value=pid;
			document.form1.command.value='trash';
			document.form1.submit();
		}
	}	
	
	function addsub(pid){
		document.form1.pid.value=pid;
		document.form1.command.value='addsub';
		document.form1.submit();		
	}
	
	
	// For other commands
	function actOn(pid){
		if(confirm('Do you wish to continue?')){
			document.form1.pid.value=pid;
			document.form1.command.value='adm';
			document.form1.submit();
		}
	}
	
	function doIt(pid){
		if(confirm('Do you wish to continue?')){
			document.form1.pid.value=pid;
			document.form1.command.value='rvl';
			document.form1.submit();
		}
	}	
</script>

<form name="form1" method="post" enctype="multipart/form-data">
<input type="hidden" name="pid" />
<input type="hidden" name="command" />
</form>



<!-- Wrapper -->
<div id="wrapper">