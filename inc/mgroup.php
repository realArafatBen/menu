<div class="row">
<div class="col-lg-8">

    <div id="add-listing">

        <!-- Section -->
        <div class="add-listing-section">

            <!-- Headline -->
            <div class="add-listing-headline">
                <h3><i class="sl sl-icon-doc"></i> Menu Groups 
                	<a href="view_mgl.php" class="button pull-right">Menu Group List</a>
                </h3>
            </div>
			<?php 
			if(isset($_POST['btnGRP'])){
				# create variable
				$groupnm = trim($_POST['groupnm']); 
				$sort = $_POST['sort'];
				
				# create sessions
				$_SESSION['groupnm'] = $groupnm; 
				$_SESSION['sort'] = $sort;
			
				# Checking for already exist faq 
				$query = $con->prepare('SELECT * FROM menugroup WHERE groupnm = :groupnm');
				$query->execute(array(':groupnm'=>$groupnm));
				
				if(empty($groupnm) || empty($sort)){
					echo alert('Please fill required information!', 'notice');
					
				}elseif($query->rowCount() > 0){
				echo alert('Menu group already exist', 'error');
				
				}else{
					# Insert inputs into database
					$sql = "INSERT INTO 
							menugroup (groupnm, sort)
							VALUES (:groupnm, :sort)";
							$query = $con->prepare($sql);
							$query->execute(array(
								':groupnm' => $groupnm,	
								':sort' => $sort		
								));
								
				# Alert Status -----------------------------------------
				echo alert('Menu group created successfully!', 'success');
				
				# Clear Session Variable
				$_SESSION['groupnm'] = ''; $_SESSION['sort'] = ''; 
				
				}	
			}
			?>
		
			
			<?php 
			if(isset($_POST['editFAQ'])){
				# create variable
				$groupnm = $_POST['groupnm']; 
				$sort = $_POST['sort'];
						
				# create sessions
				$_SESSION['groupnm'] = $groupnm; 
				$_SESSION['sort'] = $sort;
				
				if(empty($groupnm) || empty($sort)){
					echo alert('Please fill required information!', 'notice');
					
				}else{
				
				$data = array(
				'groupnm' => $groupnm,
				'sort' => $sort,
				'id' => $_GET['tk']
				);
				$sql = "UPDATE menugroup SET groupnm=:groupnm, sort=:sort WHERE id=:id";
				$stmt= $con->prepare($sql);
				$stmt->execute($data);
								
				# Alert Status -----------------------------------------
				echo alert('Menu group updated successfully!', 'success');
				
				# Clear Session Variable
				$_SESSION['groupnm'] = ''; $_SESSION['sort'] = '';
				
				header('Location: view_mgl.php'); 
				exit; 
			}}
			?>
			
			
			<?php 
			# Load information
			if(isset($_GET['tk'])){
			  $query = $con->query('SELECT * FROM menugroup WHERE id="'.$_GET['tk'].'"');
				while($row = $query->fetch()){
					$_SESSION['groupnm'] = $row['groupnm']; 
					$_SESSION['sort'] = $row['sort'];
				}
			}else{
					# Clear Session Variable
					$_SESSION['groupnm'] = ''; $_SESSION['sort'] = ''; 
			}
			?>
            <form method="post">
            <!-- Title -->
            <div class="row with-forms">
                <div class="col-md-12">
                    <h5>Group Name</h5>
                    <input name="groupnm" required="required"  type="text" value="<?php echo $_SESSION['groupnm']; ?>"/>
                </div>
            </div>

            <!-- Description -->
            <div class="form">
                <h5>Sort Order</h5>
                <input name="sort" required="required"  type="number" value="<?php echo $_SESSION['sort']; ?>"/>
            </div>
            <?php if(isset($_GET['tk'])){?>
			<input type="submit" class="button preview" name="editFAQ" value="Edit Group">
            <?php }else{ ?>
            <input type="submit" class="button preview" name="btnGRP" value="Save Group">
            <?php } ?>
            </div>
            <!-- Row / End -->
			</form>
        </div>
        <!-- Section / End -->
        
       </div>
   
      
   		<!-- Item -->
        <div class="col-lg-4 col-md-12">
            <div class="dashboard-stat color-3">
                <div class="dashboard-stat-content">
                    <h4><?php echo countRec('menugroup', 0); ?></h4> 
                    <span>Visible Menu Group</span>
                </div>
                <div class="dashboard-stat-icon"><i class="im im-icon-Line-Chart"></i></div>
            </div>
        </div>
   
   
 </div>  
</div>