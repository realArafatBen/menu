<!-- Notice -->
    <!--<div class="row">
        <div class="col-md-12">
            <div class="notification success closeable margin-bottom-30">
                <p>Your listing <strong>Hotel Govendor</strong> has been approved!</p>
                <a class="close" href="#"></a>
            </div>
        </div>
    </div> -->
	
    <!-- Content -->
    <div class="row">
		
        <!-- Item -->
        <div class="col-lg-3 col-md-6">
            <div class="dashboard-stat color-4">
                <div class="dashboard-stat-content">
                <h4><?php echo countRec('menugroup', 0); ?></h4><span>Active Menu Group</span></div>
                <div class="dashboard-stat-icon"><i class="im im-icon-DNA-Helix"></i></div>
            </div>
        </div>

		
        <!-- Item -->
        <div class="col-lg-3 col-md-6">
            <div class="dashboard-stat color-1">
                <div class="dashboard-stat-content">
                <h4><?php echo countRec('menuitems', 0); ?></h4> <span>Visible Menu Items</span></div>
                <div class="dashboard-stat-icon"><i class="im im-icon-Check-2"></i></div>
            </div>
        </div>

        <!-- Item -->
        <div class="col-lg-6 col-md-6">
            <div class="dashboard-stat color-2">
                <div class="dashboard-stat-content">
                	<h4><?php echo countRec('users', 0) -1; ?></h4> <span>Total Active Users</span>
                </div>
                <div class="dashboard-stat-icon"><i class="im im-icon-Checked-User"></i></div>
            </div>
        </div>

        
        <!-- Item --> <!-- 
        <div class="col-lg-3 col-md-6">
            <div class="dashboard-stat color-3">
                <div class="dashboard-stat-content">
                    <h4><?php //echo countRec('faqs', 0); ?></h4> 
                    <span>Total Visible FAQ</span>
                </div>
                <div class="dashboard-stat-icon"><i class="im im-icon-Line-Chart"></i></div>
            </div>
        </div> -->

<div class="row">
        
    <div class="col-lg-6 col-md-12">           
      <table class="table table-sm">
      <legend>LAST 5 ADDED MENU ITEM</legend>
      <thead>
        <tr>
          <th scope="col">Item Name</th>
          <th scope="col">Price(N)</th>
          <th scope="col">Status</th>
        </tr>
      </thead> 
                             
      <tbody>
      <?php
        $stmt = $con->query('SELECT * FROM menuitems WHERE status=0 ORDER BY id DESC LIMIT 5');	
        while($rows = $stmt->fetch()){				
        ?>
        <tr>             
          <td><?php echo $rows['item']; ?></td>
          <td><?php echo number_format($rows['price']); ?></td>              
          <td> &nbsp; &nbsp; <?php echo $rows['status']; ?></td>
        </tr> 
      <?php } ?>                    
      </tbody>
      </table>
   </div>
   
    <div class="col-lg-5 col-md-12">           
      <table class="table table-sm">
      <legend>ACTIVE USERS</legend>
      <thead>
        <tr>
          <th scope="col">Fullname</th>
          <th scope="col">Email</th>
          <th scope="col"><div title="Can Resolve Complain?" class="tooltip left">RVL</div></th>
        </tr>
      </thead> 
                             
      <tbody>
      <?php
        $stmt = $con->query('SELECT * FROM users 
        WHERE em <> "anyadikeip@gmail.com" ORDER BY nm DESC');	
        while($rows = $stmt->fetch()){				
        ?>
        <tr>             
          <td><?php echo $rows['nm']; ?></td>
          <td><?php echo strtolower($rows['em']); ?></td>              
          <td><?php if($rows['rvl']==1){echo 'Yes';}?></td>
        </tr> 
      <?php } ?>                    
      </tbody>
      </table>
   </div>
       
            
</div>
        
        
        
        
        
        
    </div>