<?php
	include_once('inc/headtag.php');
	include_once('inc/dheader.php');	
	include_once('inc/leftnav.php');
?>
  
<div class="row"> 
	
<!--Tabs -->
<div class="sign-in-form style-1 col-lg-6 col-md-12">
		
    <ul class="tabs-nav">						
        <li><a href="#tab2">Add Menu Item</a></li> 
    </ul>
    
    <div class="tabs-container1 alt">
    
    <!-- Register-->
    <div class="tab-content" id="tab2" style="display: none;">
	            
    <?php 
	if(isset($_POST['create'])){
		# create variable
		$item = $_POST['item']; $descr = $_POST['descr'];
		$price = $_POST['price']; $sort_id = $_POST['sort_id'];		
		$menugrp_id = $_POST['menugrp_id']; $status = $_POST['status']; 
		
		
		# Resetting checkbox value
		if(empty($status)){$status=0;} 
		
		# create sessions
		$_SESSION['item'] = $item; $_SESSION['descr'] = $descr;
		$_SESSION['price'] = $price; $_SESSION['sort_id'] = $sort_id;
		$_SESSION['menugrp_id'] = $menugrp_id;
		
		# Checking for already exist email 
		$query = $con->prepare('SELECT * FROM menuitems WHERE item = :item');
		$query->execute(array(':item'=>$item));
		
		if(empty($menugrp_id) || empty($item)){
			echo alert('Please fill required information!', 'notice');
			
		}elseif($query->rowCount() > 0){
		echo alert('Menu item already exist', 'error');
		
		}else{
			# Insert inputs into database
			$sql = "INSERT INTO 
					menuitems (item, descr, price, sort_id, menugrp_id)
					VALUES (:item, :descr, :price, :sort_id, :menugrp_id)";
					$query = $con->prepare($sql);
					$query->execute(array(
						':item' => $item,	
						':descr' => $descr,
						':price' => $price,	
						':sort_id' => $sort_id,
						':menugrp_id' => $menugrp_id,
						));
						
		# Alert Status -----------------------------------------
		echo alert('New menu item created successfully!', 'success');
		
		# Clear Session Variable
		$_SESSION['item'] = ''; $_SESSION['descr'] = ''; 
		$_SESSION['price'] = ''; $_SESSION['sort_id'] = '';		
		}	
	}
	?>

	
	<?php 
	if(isset($_POST['editIt'])){
		# create variable
		$item = $_POST['item']; $descr = $_POST['descr'];
		$price = $_POST['price'];  $sort_id = $_POST['sort_id']; 
		echo $menugrp_id = $_POST['menugrp_id']; 	
					
		# create sessions
		$_SESSION['item'] = $item; $_SESSION['descr'] = $descr;
		$_SESSION['price'] = $price; $_SESSION['sort_id'] = $sort_id;
		$_SESSION['menugrp_id'] = $menugrp_id;
		
		if(empty($item) || empty($menugrp_id)){
			echo alert('Please fill required information!', 'notice');
			
		}else{
		
		$data = array(
		'item' => $item,
		'descr' => $descr,
		'price' => $price,
		'sort_id' => $sort_id,
		'menugrp_id' => $menugrp_id,
		'id' => $_GET['ei']
		);
		
		$sql = "UPDATE menuitems SET item=:item, descr=:descr, price=:price, 
		sort_id=:sort_id, menugrp_id=:menugrp_id WHERE id=:id";
		$stmt= $con->prepare($sql);
		$stmt->execute($data);
						
		# Alert Status -----------------------------------------
		echo alert('Menu Item updated successfully!', 'success');
		
		# Clear Session Variable
		$_SESSION['item'] = ''; $_SESSION['descr'] = ''; 
		$_SESSION['price'] = ''; $_SESSION['sort_id'] = '';
		$_SESSION['menugrp_id'] = '';
		
		header('Location: vMenuItems.php'); 
		exit; 
	}}
	?>
	
    
    <?php 
	# Load user information
	if(isset($_GET['ei'])){
	  $query = $con->query('SELECT * FROM menuitems WHERE id="'.$_GET['ei'].'"');
		while($row = $query->fetch()){
			$_SESSION['item'] = $row['item']; $_SESSION['descr'] = $row['descr']; 
			$_SESSION['price'] = $row['price']; $_SESSION['sort_id'] = $row['sort_id'];			
			$_SESSION['menugrp_id'] = $row['menugrp_id']; 
			$readonly = 'disabled'; 
		}
	}else{
			# Clear Session Variable
			$_SESSION['item'] = ''; $_SESSION['descr'] = ''; 
			$_SESSION['price'] = ''; $_SESSION['sort_id'] = '';
			$_SESSION['menugrp_id'] = ''; $readonly = '';
	}
	?>
    
    
    <form method="post" name="reg_form">
        <input type="hidden" name="eID" value="<?php echo $_GET['ei']; ?>" />
    
    <p class="form-row form-row-wide">
        <label for="dept"><strong>Select Menu Group</strong>:
           <select data-placeholder="Select Item" name="menugrp_id" class="chosen-select">               	
           <option selected="selected" label="blank" value="<?php echo $_SESSION['menugrp_id']; ?>" ><?php 
           $stmt = $con->query('SELECT * FROM menugroup WHERE id="'.$_SESSION['menugrp_id'].'"');	
            while($rows = $stmt->fetch()){echo $rows['groupnm'];}
           ?></option> 
                       
           <?php 
            $query = $con->query('SELECT * FROM menugroup WHERE status=0 ORDER BY groupnm ASC');	
            while($row = $query->fetch()){	
           ?>
           
            <option value="<?php echo $row['id']; ?>"><?php echo $row['groupnm']; ?></option>
           <?php } ?>                 
            </select>
        </label> 
    </p>
    
    <p class="form-row form-row-wide">
        <label for="nm"><strong>Item Name</strong>:
            <i class="im im-icon-Tag"></i>
            <input type="text" required="required"  name="item" value="<?php echo $_SESSION['item']; ?>" />
        </label>
    </p>
        
    <p class="form-row form-row-wide">
        <label for="price"><strong>Price</strong>:
           <i class="im im-icon-Money"></i>
           <input type="number" min="0" max="9999999" name="price" value="<?php echo $_SESSION['price'];?>" />
        </label>
    </p>

    <p class="form-row form-row-wide">        
            <div class="form">
            <h5>Description</h5>
            <textarea class="WYSIWYG" name="descr" cols="10" rows="1" id="summary" spellcheck="true"><?php echo $_SESSION['descr'];?></textarea>
            </div>
    </p>
               
     <p class="form-row form-row-wide">
        <label for="price">Sort Order:
           <i class="im im-icon-Arrow-Shuffle"></i>
           <input type="number" min="0" max="200" name="sort_id" value="<?php echo $_SESSION['sort_id'];?>" />
        </label>
    </p>
    
    <?php if(isset($_GET['ei'])){?>
    <input type="submit" class="button border fw margin-top-10" name="editIt" value="Edit Menu Item" />        
    <?php }else{?>
    <input type="submit" class="button border fw margin-top-10" name="create" value="Add Menu Item" />
    <?php } ?>
    </form>
</div>
</div>
</div>
<!-- Register / End -->

	<div class="col-lg-1" > </div>
    <div class="col-lg-4 col-md-12" ><p>
        <div class="dashboard-stat color-2">
            <div class="dashboard-stat-content"><h4>
           	<?php echo countRec('menuitems', 0); ?>          
            </h4> <span>Active Menu Items</span></div>
            <div class="dashboard-stat-icon"><i class="im im-icon-Checked-User"></i></div>
        </div>
    </div>
    
    
    <div class="col-md-6">
     <div class="col-lg-4" >  </div>			
        <p><a href="vMenuItems.php" class="button medium border"><i class="sl sl-icon-docs"></i> View Menu List</a></p>
    </div>
        
             
    </div>

     
 
<?php include_once('inc/copyright.php'); ?>     
</div>
        
	
<?php 	
	include_once('inc/footag.php');	
?>