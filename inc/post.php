<div class="row">
    <div class="col-lg-9">

        <div id="add-listing">

            <!-- Section -->
            <div class="add-listing-section">

                <!-- Headline -->
                <div class="add-listing-headline">
                    <h3><i class="sl sl-icon-doc"></i> Post Ticket </h3>
                </div>

				<?php 				
				if(isset($_POST['postIssue'])){
                	$to_dept = $_POST['to_dept']; $title = trim($_POST['title']);
					$idesc = $_POST['idesc']; $tday = XDATE;
					$sourceDept = getNmById('depts', $yrdept, 'nm');
					
					# create sessions
					$_SESSION['to_dept'] = $to_dept; $_SESSION['title'] = $title;
					$_SESSION['idesc'] = $idesc; 
					
					# Checking for already exist issue in same day 
					$query = $con->prepare('SELECT * FROM issues WHERE title = :title 
					AND to_dept = :to_dept AND tday = :tday');
					$query->execute(array(':title'=>$title, ':to_dept'=>$to_dept, ':tday'=>$tday));
					
					if(empty($to_dept) || empty($title) || empty($idesc)){
						echo alert('Fill all required details!', 'notice');
						
					}elseif($query->rowCount() > 0){
					echo alert('Ticket with same <b>caption</b> already sent to <b>' .
					getNmById( 'depts', $to_dept, 'nm'). '</b> today!', 'error');
					
					}else{
						# Insert inputs into database 
						$sql = "INSERT INTO 
								issues (from_dept, to_dept, title, idesc, tday ,postedby)
								VALUES (:from_dept, :to_dept, :title, :idesc, :tday, :postedby)";
								$query = $con->prepare($sql);
								$query->execute(array(
									':from_dept' => $yrdept,
									':to_dept' => $to_dept,	
									':title' => $title,
									':idesc' => $idesc,
									':tday' => $tday,
									':postedby' => $user_cache			
									));
									
					# Alert Status -----------------------------------------
					echo alert('Ticket was sent to <b>'.getNmById( 'depts', $to_dept, 'nm').'</b> successfully.', 'success');
										
					# Send Email if any ====================================
					$toEm = getColByDeptID('users', $to_dept, 'em');
					$idesc .= '<br>---------------------------------------<br><p>From: <strong>'.$sourceDept.
					'</strong><br><a href="http://172.16.10.10/supportlog" target="blank">Reply Now</a></p>';
					if(!empty(trim($toEm))){sendEmail($toEm, $title, $idesc);}
					# ======================================================
					
					# Clear Session Variable
					$_SESSION['to_dept'] = ''; $_SESSION['title'] = ''; 
					$_SESSION['idesc'] = '';					
					}
				}
                ?>
				
                <!-- Title -->
                <div class="row with-forms">
                    <div class="col-md-12">
                    <h5>Target Department: 
                    <i class="tip" data-tip-content="Select department that will resolve the issue"></i></h5>
                    <form method="post">
                       <select data-placeholder="Select Department" name="to_dept" class="chosen-select">               	
                           <option selected="selected" label="blank" value="<?php echo $_SESSION['to_dept']; ?>" ><?php 
                              $stmt = $con->query('SELECT * FROM depts WHERE id="'.$_SESSION['to_dept'].'"');	
                              while($rows = $stmt->fetch()){echo $rows['nm'];} ?>
                           </option> 
                                       
                           <?php 
                            $query = $con->query('SELECT * FROM depts WHERE id <>"'.$yrdept.'" ORDER BY nm ASC');	
                            while($row = $query->fetch()){?>
                            <option value="<?php echo $row['id']; ?>"><?php echo $row['nm']; ?></option>
                           <?php } ?>                 
                       </select>                       
                    </div>
                </div>
                
                <div class="row with-forms">
                    <div class="col-md-12">
                        <h5>Ticket Caption <i class="tip" data-tip-content="Caption the issue here"></i></h5>
                        <input class="search-field" required name="title" type="text" value="<?php echo $_SESSION['title']; ?>"/>
                    </div>
                </div>

                <!-- Description -->
                <div class="form">
                    <h5>Description</h5>
                    <textarea class="WYSIWYG" name="idesc" cols="40" rows="3" spellcheck="true"><?php echo $_SESSION['idesc']; ?></textarea>
                     
                     <!--<label class="switch">
                     	<input type="checkbox" checked>
                        <span class="slider round"></span>
                     </label> -->
                </div>

            </div>
            <!-- Section / End -->
			<button name="postIssue" class="button preview">Submit Ticket <i class="fa fa-arrow-circle-right"></i></button>
           </form>
    </div>
</div>
    
<div class="row">
 <div class="col-lg-3 col-md-12"> 

	<!-- Contact -->
    <div class="boxed-widget margin-top-30 margin-bottom-50">
        <h3>From</h3>
        <ul class="listing-details-sidebar">
        	<li><i class="sl sl-icon-direction"></i> <strong><?php echo getNmById('depts', $yrdept, 'nm'); ?></strong></li>
        	<li><i class="sl sl-icon-user"></i> <?php echo $yrNm; ?></li>            
            <li><i class="fa fa-envelope-o"></i> <?php echo $yrEm; ?></li>
        </ul>
        
    </div>
    <!-- Contact / End-->


 </div>
</div>
