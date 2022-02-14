<script language="javascript">
	function isResolved(pid){
		if(confirm('Are you sure this complain has been treated?')){
			document.isDone.pid.value=pid;
			document.isDone.command.value='isTreated';
			document.isDone.submit();
		}
	}
</script>



<script type="text/javascript">
    function autoRefreshPage()
    {
        window.location = window.location.href;
    }
    setInterval('autoRefreshPage()', 100000);
</script>

<?php 
if($_REQUEST['command']=='isTreated' && $_REQUEST['pid']>0){	
	$tget = $_REQUEST['pid']; 
	$prv = getNmById('issues', $tget, 'status');
	if($prv == 1){$new = 0;} if($prv == 0){$new = 1;}	
	$query = 'UPDATE issues SET status = '.$new.' WHERE id="'.$tget.'"';		
	if ($con->query($query)) {
				
	}
}
?>

<form name="isDone" method="post" enctype="multipart/form-data">
<input type="hidden" name="pid"  />
<input type="hidden" name="command" />
</form>

<?php
# Determine if a complain page is active or not ===========
$isStatus = getNmById('issues', $_GET['pi'], 'status');	
if($isStatus == 0){$state = 'unchecked'; $disablePg = '';}	
elseif($isStatus == 1){$state = 'checked';
$disablePg = 'pointer-events: none; opacity: 0.4;';}
# ========================================================
?>

<?php 
$frm_dept = getNmById('issues', $_GET['pi'], 'from_dept');
if($frm_dept <> $yrdept){
	echo alert('Sorry! You are restricted.','error');
}else{
	$stmt = $con->query('SELECT * FROM issues WHERE id="'.$_GET['pi'].'"');	
	while($rows = $stmt->fetch()){
		$td = $rows['to_dept']; $tt = $rows['title']; $de = $rows['idesc'];
	} 	
?>

<div class="row" style="<?php echo $disablePg; ?>" >
    <div class="col-lg-6">
        <div id="add-listing">
        
        <!-- Section -->
        <div class="add-listing-section">

            <!-- Headline -->
            <div class="add-listing-headline">
                <h3><i class="sl sl-icon-doc"></i> Sent Ticket</h3>
            </div>
                            
            <!-- Title -->
            <div class="row with-forms">
                <div class="col-md-12">
                <h5>Ticket directed to:</h5>
                <form method="post">
                   <select data-placeholder="Select Department" name="to_dept" class="chosen-select">               	
                       <option selected="selected" label="blank" value="<?php echo $td; ?>" ><?php 
                          $stmt = $con->query('SELECT * FROM depts WHERE id="'.$td.'"');	
                          while($rows = $stmt->fetch()){echo $rows['nm'];} ?>
                       </option>   
                   </select>                       
                </div>
            </div>
            
            <div class="row with-forms">
                <div class="col-md-12">
                    <h5>Ticket Caption</h5>
                    <input class="search-field" disabled name="title" type="text" value="<?php echo $tt; ?>"/>
                </div>
            </div>

            <!-- Description -->
            <div class="form">
            <h5>Description</h5>
            <textarea  disabled rows="10" spellcheck="true"><?php echo $de; ?></textarea>
            
                        
             
             <label class="switch tooltip top" onmouseup="javascript:isResolved(<?php 
			 echo $_GET['pi']; ?>)" title="Turn button on to close ticket, if complain is resolved">
                <input type="checkbox" <?php echo $state ?>>
                <span class="slider round"></span>
             </label>  
           
            
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
                	Response Log 
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
								ireactions (issue_id, cText, from_dept	, to_dept, haspost, user_id)
								VALUES (:issue_id, :cText, :from_dept, :to_dept, :haspost,:user_id)";
								$query = $con->prepare($sql);
								$query->execute(array(
									':issue_id' => $issue_id,
									':cText' => $cText,
									':from_dept' => $yrdept,	
									':to_dept' => $td,
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
                
                <!-- <div class="sent_msg">
                    <p>Apollo University, Delhi, India Test</p>
                    <span class="time_date"> 11:01 AM    |    Today</span> 
                  </div>
               
                                        
                  <div class="received_msg">
                    <div class="received_withd_msg">
                      <p>We work directly with our designers and suppliers,
                        and sell direct to you, which means quality, exclusive
                        products, at a price anyone can afford.</p>
                      <span class="time_date"> 11:01 AM    |    Today</span>
                    </div>
                  </div> -->
                
                
                
                	<?php 
					$stmt = $con->query('SELECT * FROM ireactions 
					WHERE issue_id="'.$_GET['pi'].'" ORDER BY ID DESC');	
					while($r = $stmt->fetch()){
					$who = 	getNmById('users', $r['user_id'], 'nm');
					
					if($r['haspost'] <> $yrdept){
						$msgtype = 'sent_msg';
					}elseif($r['haspost'] == $yrdept){
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