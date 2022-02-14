<?php
if($_REQUEST['command']=='edit' && $_REQUEST['pid']>0){
	$tget = $_REQUEST['pid'];	
	
	$query = $con->query('SELECT * FROM 
	subitems WHERE id ='.$tget);
		while($row = $query->fetch()){
			$_SESSION['subIemtID'] = $row['id'];
			$_SESSION['subNm'] = $row['subNm'];
			$_SESSION['status'] = $row['status']; 
			$_SESSION['price'] = $row['price'];	
			$_SESSION['totprice'] = $row['totprice'];	
		}
		if($_SESSION['status']==1){$nStatus='checked';}
}else{
	$_SESSION['item_id'] = ''; 	$_SESSION['subNm'] = ''; 
	$_SESSION['price'] = '';	$_SESSION['totprice'] = '';
	$_SESSION['status'] = '';
	unset($_SESSION['subIemtID']);
}

?>



<div class="col-lg-4 col-md-12">
<?php 
if(isset($_POST['create'])){
	# Basic Information
	$subNm = trim($_POST['subNm']);
	//$item_cat = $_POST['item_cat'];
	$price = $_POST['price']; 
	$totprice = $_POST['totprice']; 
	$status = $_POST['status'];
	if(isset($_POST['status'])){$status=1;}else{$status=0;}
	
	# ========= STORE SESSION =========
	$_SESSION['subNm'] = $subNm; 
	//$_SESSION['item_cat'] = $item_cat;
	$_SESSION['price'] = $price; 
	$_SESSION['totprice'] = $totprice; 
	$_SESSION['status'] = $status;	
	
	# Checking for already exist email 
	$query = $con->prepare('SELECT * FROM subitems WHERE subNm = :subNm');
	$query->execute(array(':subNm'=>$subNm));
	
	if(empty($subNm)){
		echo alert('Please enter sub item name!', 'notice');	
	}elseif($query->rowCount() > 0){
	echo alert('Sub Item name already exist', 'error');
		
	}else{
		# Insert inputs into database
		$sql = "INSERT INTO 
				subitems (item_id, subNm, price, totprice, status)
				VALUES (:item_id, :subNm, :price, :totprice, :status)";
				$query = $con->prepare($sql);
				$query->execute(array(
					':item_id' => $_SESSION['ITEM4SUBS'],	
					':subNm' => $subNm,
					':price' => $price,
					':totprice' => $totprice,
					':status' => $status,
				));
							
	# Alert Status -----------------------------------------
	echo alert('New Sub Item added!', 'success');
	
	# ====== CLEAR SESSIONS ======
	$_SESSION['subNm'] = ''; $_SESSION['price'] = '';
	$_SESSION['totprice'] = ''; $_SESSION['status'] = '';
	}	
}
?>

<?php 
if(isset($_POST['update'])){
	# Basic Information $_SESSION['itemID']
	$subNm = trim($_POST['subNm']);
	$subIemtID = $_POST['subIemtID'];
	$price = $_POST['price']; 
	$totprice = $_POST['totprice']; 
	$status = $_POST['status'];
	if(isset($_POST['status'])){$status=1;}else{$status=0;}
	
	$_SESSION['subNm'] = $subNm; $_SESSION['subIemtID'] = $subIemtID; 
	$_SESSION['price'] = $price; $_SESSION['totprice'] = $totprice;
			
	if(empty($subNm)){
		echo alert('Sub Item must not be empty', 'notice');	
	}else{
	
	$data = array(
			':subNm' => $subNm,	
			':price' => $price,
			':totprice' => $totprice,
			':status' => $status,
			':id' => $_SESSION['subIemtID']
			);
	$sql = "UPDATE subitems SET subNm=:subNm, price=:price, totprice=:totprice,
	status=:status WHERE id=:id";
	$stmt= $con->prepare($sql);
	$stmt->execute($data);
						
	# Alert Status -----------------------------------------
	echo alert('Item updated successfully!', 'success');
	$_SESSION['subNm'] = ''; $_SESSION['price'] = '';
	$_SESSION['totprice'] = ''; $_SESSION['status'] = '';
	unset($_SESSION['subIemtID']); 
}}
?>



<form method="post" enctype='multipart/form-data'> 
    <div class="dashboard-list-box margin-top-0">
        <h4 class="gray">
        Create/Edit Sub Item
        <label title="Disable Item" class="switch pull-right">
        	<input type="checkbox" name="status" <?php echo $nStatus; ?>><span class="slider round"></span>
        </label>
        
        </h4>
        <div class="dashboard-list-box-static">
                <label>Sub Item Name</label>
                <input name="subNm" required="required" value="<?php echo $_SESSION['subNm']; ?>" type="text">
                <input name="subIemtID" required="required" value="<?php echo $_SESSION['subIemtID']; ?>" type="hidden">
                                            
                <div class="form">
                    <h5>Price</h5>
                     <input name="price" step="0.01" value="<?php echo $_SESSION['price']; ?>" min="0" max="" type="number">
            	</div>
                
                <div class="form">
                    <h5>Tot Price</h5>
                     <input name="totprice" step="0.01" value="<?php echo $_SESSION['totprice']; ?>" min="0" max="" type="number">
            	</div>
                                 
            	<div class="pull-right1">        
				 <?php if(empty($tget)){?>
                 <button class="btn btn-success" name="create">Create</button>                 
                 <?php }else{?>
                  <button class="btn btn-warning" name="update">Update</button>
                 <?php }?>
         		</div> 
       	</div>

    </div>
</div>







<div class="col-lg-8 col-md-12">
<?php 
if($_REQUEST['command']=='delete' && $_REQUEST['pid']>0){
	$query = "DELETE FROM subitems WHERE id =".$_REQUEST['pid'];	
	if($con->query($query)) {
		echo alert('Sub Item deleted successfully', 'error');    	
	}
}
?>



    <div class="dashboard-list-box margin-top-0">
        <h4 class="gray"> 
        <a href="vMenuItems.php" class="btn btn-primary pull-right">Menu List</a>
        Sub Items of { <?php echo getNmById('menuitems', $_SESSION['ITEM4SUBS'], 'item'); ?> }
        </h4>
        <div class="dashboard-list-box-static">
           
           
           <div class="row">
            <div class="col-md-12">
            <table class="table table-striped table-condensed">
             <?php 
            # Prepering the pagination 
            $query = $con->query("SELECT * FROM {$statement} LIMIT {$startpoint} , {$per_page}");
            if($query->rowCount()<0){
                echo '<div style="color:red;">Oops: No record found.</div>';
            }else{
            ?>
              <thead>
                <tr>        	            
                    <td>Sub Item Name</td>
                    <td align="right">Price</td>
                    <td align="right">Tot Price</td>
                    <td align="right">Status</td>          
                    <td class="pull-right"> </td>
                </tr>
              </thead>
                <tbody>
                <?php 
                $i = 0;
                while($row = $query->fetch(PDO::FETCH_ASSOC)){
                $i++; 
                ?>
                <tr> 
                    <td><?php echo $row['subNm']; ?></td>
                    <td align="right"><?php echo number_format($row['price']); ?></td>
                    <td align="right"><?php echo number_format($row['totprice']); ?></td>
                    <td align="right"><?php if($row['status']==0){
                        echo '<span class="label label-success">Visible</span>';}else
                        {echo '<span class="label label-danger">Disabled</span>';} ?>
                    </td>
                    <td>	
                    <div class="pull-right">
                        <a href="javascript:edit(<?php echo $row['id']; ?>)" title="Edit" class="btn btn-warning btn-xs">
                        <i class="fa fa-edit"></i></a>
                        <?php //if(!empty($void_Sub-Site)){ ?> 
                        <a href="javascript:del(<?php echo $row['id'] ?>)" title="Delete" class="btn btn-danger btn-xs">
                        <i class="fa fa-trash"></i></a>
                        <?php //} ?>
                    </div>
                    </td>
                </tr> 
                <?php } ?>                    
                </tbody>
            <?php } ?>      
            </table>
            
           
            </div>
</div>
</form>           
           
          
           

        </div>
    </div>
    
   
    
<!-- PAGINATION LINK  -->
<div class="" style="text-align:center;">
    <div class="pagination1">
        <ul class=""><?php echo pagination($statement,$per_page,$page,$url='?');?></ul>
    </div>
</div>  
    
</div>




  
