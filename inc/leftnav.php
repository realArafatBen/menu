<!-- Navigation
	================================================== -->

	<!-- Responsive Navigation Trigger -->
	<a href="#" class="dashboard-responsive-nav-trigger"><i class="fa fa-reorder"></i> Dashboard Navigation</a>

	<div class="dashboard-nav">
		<div class="dashboard-nav-inner">

			<ul data-submenu-title="MENU: <?php //echo getNmById('depts', $yrdept, 'nm'); ?>">
				<li class="<?php activemenu('dashboard.php'); ?>">
                	<a href="dashboard.php"><i class="sl sl-icon-screen-desktop"></i> Dashboard</a>
                </li>
				<li class="<?php activemenu('mgrMenu.php'); ?>">
                	<a href="vMenuItems.php"><i class="sl sl-icon-plus"></i> Manage Menu </a>
                </li>
				<li class="<?php activemenu('menugroups.php'); ?>">
                	<a href="menugroups.php">
                    	<i class="sl sl-icon-layers"></i> Menu Groups 
                        <!--<span class="nav-tag red"><?php //echo pendingPostCount();?></span> 
                        <span class="nav-tag green"><?php //echo isResolvedCount();?></span> -->
                    </a>
                </li> 
			</ul>
			
          
			<ul data-submenu-title="Account">
				<li class="<?php activemenu('myprofile.php'); ?>">
                	<a href="myprofile.php"><i class="sl sl-icon-user"></i> My Profile</a>
                </li>
				<li><a href="logout.php"><i class="sl sl-icon-power"></i> Logout</a></li>
			</ul>
			
		</div>
	</div>
	<!-- Navigation / End -->
    
    
    <!-- Content
	================================================== -->
	<div class="dashboard-content"> 