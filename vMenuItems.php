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
$statement = "menuitems ORDER BY menugrp_id ASC";
?>	 


<?php 

if(isset($_REQUEST['command'])){
  if($_REQUEST['command']=='delete' && $_REQUEST['pid']>0){	
    $query = 'DELETE FROM menuitems WHERE id="'.$_REQUEST['pid'].'"';		
    if ($con->query($query)) {
      echo alert('Record deleted successfully', 'error');    	
    }
  }
  if($_REQUEST['command'] =='edit' && $_REQUEST['pid']>0){
    header('Location: mgrMenu.php?ei='.$_REQUEST['pid']); 
    exit; 
  }
  
  if($_REQUEST['command']=='addsub' && $_REQUEST['pid']>0){
    $_SESSION['ITEM4SUBS'] = $_REQUEST['pid'];
    header('Location: subitems.php'); 
    exit; 
  }
  
  
  if($_REQUEST['command']=='adm' && $_REQUEST['pid']>0){	
    $tget = $_REQUEST['pid']; 
    $prv = getNmById('menuitems', $tget, 'adm');
    if($prv == 1){$new = 0;} if($prv == 0){$new = 1;}
    
    $query = 'UPDATE menuitems SET adm = '.$new.' WHERE id="'.$tget.'"';		
    if ($con->query($query)) {
      echo alert('Record updated successfully', 'success');    	
    }
  }
  
  if($_REQUEST['command']=='rvl' && $_REQUEST['pid']>0){	
    $tget = $_REQUEST['pid']; 
    $prv = getNmById('menuitems', $tget, 'rvl');
    if($prv == 1){$new = 0;} if($prv == 0){$new = 1;}
    
    $query = 'UPDATE menuitems SET rvl = '.$new.' WHERE id="'.$tget.'"';		
    if ($con->query($query)) {
      echo alert('Record updated successfully', 'success');    	
    }
  }
}


?>

<div class="row"> 	
<div class="col-lg-12 col-md-12">
<legend>
<a href="mgrMenu.php" class="btn btn-info pull-right">Add Menu Item</a>
Menu List </legend>

<div class="dashboard-list-boxn">
        <table class="table table-striped table-sm">
           <?php 
            # Prepering the pagination 
            $query = $con->query("SELECT * FROM {$statement} LIMIT {$startpoint} , {$per_page}");
            if($query->rowCount()<0){
                echo '<div style="color:red;">Oops: No customer record found.</div>';
            }else{
            ?>
          <thead>
            <tr>
              <!--<th>#</th> -->
              <th>Item Nmae</th>
              <th>Price</th>
              <th>Menu Group</th>
              <th title="Sort">Sort</th>
              <!--<th title="Status">Status</th> -->
              <th><div class="pull-right">Manage</div></th>
            </tr>
          </thead> 
          
          <form method="post" enctype="multipart/form-data">                                  
          <tbody>
          <?php 
		  	$i = 0;
		  	while($row = $query->fetch(PDO::FETCH_ASSOC)){
			$i++; 
		  ?>
            <tr>
              <!--<th><?php echo $i * $page; ?></th> -->
              <td><?php echo $row['item']; ?></td>
              <td><?php echo number_format($row['price']); ?></td>
              <td><?php echo strtolower(getNmById('menugroup', $row['menugrp_id'], 'groupnm')); ?></td>
                            
              <td> &nbsp;&nbsp;<?php echo $row['sort_id']; ?></ol> 
              </td>
              
              <!--<td><?php if($row['status']==1){echo '<li>&nbsp;</li>';}?></td> -->
              
              <td>
              <div class="pull-right">
              	<a href="javascript:edit(<?php echo $row['id'] ?>)" title="Edit" class="btn btn-warning btn-xs">
                <i class="fa fa-edit"></i></a>
              	<a href="javascript:addsub(<?php echo $row['id'] ?>)" title="Sub Items"  class="btn btn-primary btn-xs">
                <i class="fa fa-tags"></i></a>
                <!--<a href="javascript:doIt(<?php echo $row['id'] ?>)" title="Can Fix Task"><i class="fa fa-wrench"></i> &nbsp; </a> -->
                <a href="javascript:del(<?php echo $row['id'] ?>)" title="Delete"  class="btn btn-danger btn-xs">
                <i class="fa fa-trash"></i></a>
              </div>
              </td>
              
            </tr> 
          <?php } ?>                    
          </tbody>
          </form>
          <?php } ?>
        </table>
       </div> 
       </div>
       
        <!-- PAGINATION LINK  -->
        <div class="" style="text-align:center;">
            <div class="pagination-small">
                <ul><?php echo pagination($statement,$per_page,$page,$url='?');?></ul>
            </div>
        </div> 
        
        
    

 
<?php include_once('inc/copyright.php'); ?>     
</div>
        
	
<?php 	
	include_once('inc/footag.php');	
?>