<?php
	include_once('inc/headtag.php');
	include_once('inc/dheader.php');	
	include_once('inc/leftnav.php');
	include_once('inc/pagination.php');
?>

<?php 
# Pagination --------------
$page = (int)(!isset($_GET["page"]) ? 1 : $_GET["page"]);
if ($page <= 0) $page = 1; 
$per_page = 10; // Records per page.
$startpoint = ($page * $per_page) - $per_page;
$statement = "subitems WHERE item_id = ".
$_SESSION['ITEM4SUBS']." ORDER BY subNm ASC";
?>

<div class="row"> 
    <?php 
	include_once('inc/subitemInner.php'); 
	
	include_once('inc/copyright.php'); ?>     
</div>
        
	
<?php 	
	include_once('inc/footag.php');	
?>