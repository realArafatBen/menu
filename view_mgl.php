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
$statement = "menugroup ORDER BY groupnm ASC";
?>	 


<script language="javascript">
	
</script>

<!--<form name="formFAQ" method="post" enctype="multipart/form-data">
<input type="hidden" name="pid" />
<input type="hidden" name="command" />
</form> -->


<?php 
if($_REQUEST['command']=='trash' && $_REQUEST['pid']>0){	
	$query = 'DELETE FROM menugroup WHERE id="'.$_REQUEST['pid'].'"';		
	if ($con->query($query)) {
		echo alert('Record deleted successfully', 'error');    	
	}
}

if($_REQUEST['command']=='faq' && $_REQUEST['pid']>0){	
	$tget = $_REQUEST['pid']; 
	$prv = getNmById('menugroup', $tget, 'status');
	if($prv == 1){$new = 0;} if($prv == 0){$new = 1;}
	
	$query = 'UPDATE menugroup SET status = '.$new.' WHERE id="'.$tget.'"';		
	if ($con->query($query)) {
		echo alert('Record updated successfully', 'success');    	
	}
}

?>

<div class="row"> 	
<div class="col-lg-12 col-md-12">
<legend>
<a href="menugroups.php" class="btn btn-info pull-right">Add Menu Group</a>
Menu Group List </legend>
<div class="dashboard-list-box5">
    <table class="table table-sm">
       <?php 
        # Prepering the pagination 
        $query = $con->query("SELECT * FROM {$statement} LIMIT {$startpoint} , {$per_page}");
        if($query->rowCount()<0){
            echo '<div style="color:red;">Oops: No record found.</div>';
        }else{
        ?>
      <thead>
        <tr>
          <!--<th scope="col">#</th> -->
          <th scope="col">Group Name</th> 
          <th scope="col">Hidden</th>             
          <th scope="col"><div class="pull-right">Ctrl(Fn) &nbsp; </div></th>
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
          <!--<th scope="row"><?php echo $i * $page; ?></th> -->
          <td><?php echo $row['groupnm']; ?></td> 
          <td>
            <ol class="listing-features checkboxes">
                <?php if($row['status']==1){echo '<li>&nbsp;</li>';}?>
            </ol> 
          </td>              
          <td>
          <div class="pull-right">
            <a href="menugroups.php?tk=<?php echo $row['id'] ?>" title="Edit"><i class="fa fa-edit"></i> &nbsp; </a>
            <a href="javascript:isActive(<?php echo $row['id'] ?>)" title="Disable/Enable"><i class="fa fa-pause"></i> &nbsp; </a>
            <a href="javascript:delFAQ(<?php echo $row['id'] ?>)" title="Delete"><i class="fa fa-trash"></i> &nbsp; </a>
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