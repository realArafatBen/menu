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