<?php
	include_once('conn.php');
?>




<div id="scrollable" style="overflow-y:auto; height:550px;">
    <?php 
    $stmt = $con->query('SELECT * FROM ireactions 
    WHERE issue_id="'.$_GET['pi'].'" ORDER BY id DESC');	
    while($r = $stmt->fetch()){
    $who = 	getNmById('users', $r['user_id'], 'nm');
    ?>
                       
    <?php if($r['to_dept'] == $yrdept){ ?>  
                          
            <blockquote class="pull-right">
             <a href="#" class="tooltip bottom" title="Sent from <?php 
             echo $who; ?> by <?php echo $r['xdate']; ?>">
                <small>
                <?php echo $r['ctext'] .'<br><strong>['. $who.']</strong>'; ?>
                </small>
             </a>					  
            </blockquote>
            
    <?php  }else{ ?>
        
        <blockquote class="pull-left">
         <a href="#" class="tooltip bottom" title="Sent from <?php echo $who; ?> by <?php echo $r['xdate']; ?>">
          <small>
           <?php echo $r['ctext'] .'<br><strong>['. $who.']</strong>'; ?>
           </small>	
         </a> 				  
        </blockquote>
        
    <?php } ?>
        
        
    <?php } ?>
   
</div>                 	