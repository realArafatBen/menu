<?php 
# Pagination --------------
$page = (int)(!isset($_GET["page"]) ? 1 : $_GET["page"]);
if ($page <= 0) $page = 1; 
$per_page = 10; // Records per page.
$startpoint = ($page * $per_page) - $per_page;
$statement = "issues WHERE from_dept = ".$yrdept." ORDER BY id DESC";
?>	 


<?php 
if($_REQUEST['command']=='edit' && $_REQUEST['pid']>0){
	header('Location: cUsers.php?ei='.$_REQUEST['pid']); 
	exit; 
}

?>

<div class="row"> 	
<div class="col-lg-12 col-md-12">
<h2>Sent Tickets</h2>
<div class="dashboard-list-box">
        <table class="table table-sm">
           <?php 
            # Prepering the pagination 
            $query = $con->query("SELECT * FROM {$statement} LIMIT {$startpoint} , {$per_page}");
            if($query->rowCount()<0){
                echo '<div style="color:red;">Oops: No customer record found.</div>';
            }else{
            ?>
          <thead>
            <tr>
              <th scope="col">PostedOn</th>
              <th scope="col">Ticket Caption</th>
              <th scope="col">Target Department</th>
              <th scope="col">Status</th>
              <th scope="col"><div class="pull-right">Ctrl &nbsp; </div></th>
            </tr>
          </thead> 
          
          <form method="post" name="tblForm">                                  
          <tbody>
          <?php 
		  	$i = 0;
		  	while($row = $query->fetch(PDO::FETCH_ASSOC)){
			$i++; 
		  ?>
            <tr>
              <th scope="row">
              <a href="#" title="Posted by <?php echo getNmById('users', $row['postedby'], 'nm'); ?>">
			  <?php echo $row['tday']; ?></a></th>
              <td><?php echo $row['title']; ?></td>              
              <td><?php echo getNmById('depts', $row['to_dept'], 'nm'); ?></td>
              <td>
             	<ol class="listing-features checkboxes">
					<?php if($row['status']==1){echo '<li>&nbsp;</li>';}?>
				</ol> 
              </td>
              <td>
              <div class="pull-right">
              	<a href="reactOn.php?pi=<?php echo $row['id']; ?>" title="Get Solution"><i class="fa fa-wechat"></i> &nbsp; </a>
              	<!--<a href="postIssue.php?pi=<?php echo $row['id']; ?>" title="Edit"><i class="fa fa-edit"></i> &nbsp; </a> -->              </div>
              </td>
              
            </tr> 
          <?php } ?>                    
          </tbody>
          </form>
          <?php } ?>
        </table>
        
        <!-- PAGINATION LINK  -->
        <div class="" style="text-align:center;">
            <div class="pagination">
                <ul><?php echo pagination($statement,$per_page,$page,$url='?');?></ul>
            </div>
        </div> 
        
        
    </div>
</div>