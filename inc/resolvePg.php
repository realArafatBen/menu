     <script type="text/javascript">
  /*  setInterval(function() {
      $.ajax({
		type:"POST",
		url:"inc/resolve_autoload.php",
		success: function(data){
			$("#show").html(data);	
		}		  
	  });
		//alert('Yes');
    }, 3000);*/
</script> 




<?php
# Determine if a complain page is active or not ===========
$isStatus = getNmById('issues', $_GET['pi'], 'status');	
if($isStatus == 0){$state = 'unchecked'; $disablePg = '';}	
elseif($isStatus == 1){$state = 'checked';
$disablePg = 'pointer-events: none; opacity: 0.4;';}
# ========================================================
?>

<?php 
$to_dept = getNmById('issues', $_GET['pi'], 'to_dept');
if($to_dept <> $yrdept){
	echo alert('Sorry! You are restricted.','error');
}else{
	$stmt = $con->query('SELECT * FROM issues WHERE id="'.$_GET['pi'].'"');	
	while($rows = $stmt->fetch()){
		$fd = $rows['from_dept']; $tt = $rows['title']; 
		$de = $rows['idesc']; $postedby = $rows['postedby'];
		
	} 	
?>

<div class="row" style="<?php echo $disablePg ?>">
    <div class="col-lg-6">
        <div id="add-listing">
        
        <!-- Section -->
        <div class="add-listing-section">

            <!-- Headline -->
            <div class="add-listing-headline">
                <h3><i class="sl sl-icon-doc"></i> Treat Ticket</h3>
            </div>
                            
            <!-- Title -->
            <div class="row with-forms">
                <div class="col-md-12">
                <h5>Coming from:</h5>
                <form method="post" name="rform">
                   <select data-placeholder="Select Department" name="to_dept" class="chosen-select">               	
                       <option selected="selected"  value="<?php echo $fd; ?>" ><?php 
                          $stmt = $con->query('SELECT * FROM depts WHERE id="'.$fd.'"');	
                          while($rows = $stmt->fetch()){echo $rows['nm'];} ?>
                       </option>   
                   </select>                       
                </div>
            </div>
            
            <div class="row with-forms">
                <div class="col-md-12">
                    <h5>Ticket Title</h5>
                    <input class="search-field" disabled name="title" type="text" value="<?php echo $tt; ?>"/>
                </div>
            </div>

            <!-- Description -->
            <div class="form">
            <h5>Description</h5>
            <textarea  disabled rows="10" spellcheck="true"><?php echo $de; ?></textarea>
            <small>Posted By: <strong><?php echo getNmById('users', $postedby, 'nm');?></strong></small>
            
            <!--<a href="" class="tooltip top" title="Turn off if issue is resolved">
             <label class="switch" onmouseup="javascript:isResolved(<?php echo $_GET['pi']; ?>)">
                <input type="checkbox" <?php echo $state ?>>
                <span class="slider round"></span>
             </label>  
            </a> -->
        </form>         
                
            </div>

        </div>
        <!-- Section / End -->
        
        </div>
    </div>

    
    
    
    
<div class="row">
<div class="col-lg-6 col-md-12">

    <div id="add-listing">
        <div class="add-listing-section">
        
            <div class="add-listing-headline">
                <h3>
                	Solution Desk
                    <a href="<?php echo $urlNm; ?>" class="pull-right tooltip top" title="Refresh">
                    	<i class="fa fa-refresh"></i>
                    </a> 
                </h3>
            </div>
                                 
            <div class="row with-forms">
                <div class="col-md-12">
                
                <?php 				
				if(isset($_POST['cText'])){
                	$cText = $_POST['cText']; $issue_id = $_GET['pi'];					
										
					if(empty($cText)){
						echo alert('Enter reply text!', 'notice');
					}else{
						# Insert inputs into database 
						$sql = "INSERT INTO 
								ireactions (issue_id, cText, to_dept, from_dept, haspost, user_id)
								VALUES (:issue_id, :cText, :to_dept, :from_dept, :haspost, :user_id)";
								$query = $con->prepare($sql);
								$query->execute(array(
									':issue_id' => $issue_id,
									':cText' => $cText,
									':to_dept' => $yrdept,	
									':from_dept' => $fd,
									':haspost' => $yrdept,
									':user_id' => $user_cache			
									));
					}
				}
                ?>
                
                <form method="post">
                <input type="text" required name="cText" spellcheck="true" placeholder="enter your reaction"/>
                </form>
                        <div id="scrollable" style="overflow-y:auto; height:550px;">
						<?php 
                        $stmt = $con->query('SELECT * FROM ireactions 
                        WHERE issue_id="'.$_GET['pi'].'" ORDER BY ID DESC');	
                        while($r = $stmt->fetch()){
                        $who = 	getNmById('users', $r['user_id'], 'nm');
                        
                        if($r['haspost'] == $yrdept){
                            $msgtype = 'sent_msg';
                        }elseif($r['haspost'] <> $yrdept){
                            $msgtype = 'received_msg';						
                        }
                        ?>           
                          <div class="<?php echo $msgtype; ?>">
                            <div class="received_withd_msg">
                              <p><?php echo $r['ctext']; ?></p>
                              <span class="time_date"> <?php echo $r['xdate']; ?>    |    <?php echo $who; ?></span>
                            </div>
                          </div>
                                    
                        <?php } ?>
                       
                    </div> 	
                </div>
            </div>
                            
        </div>
    </div>
    
</div>
</div>

<?php } ?>