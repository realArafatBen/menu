<!-- Header Container
================================================== -->
<header id="header-container">

<!-- Header -->
<div id="header">
    <div class="container">
        
        <!-- Left Side Content -->
        <div class="left-side">
            
            <!-- Logo -->
            <div id="logo">
                <a href="."><img src="images/logo.png" alt=""></a>
            </div>

            <!-- Mobile Navigation -->
            <div class="mmenu-trigger">
                <button class="hamburger hamburger--collapse" type="button">
                    <span class="hamburger-box">
                        <span class="hamburger-inner"></span>
                    </span>
                </button>
            </div>


            
            
        </div>
        <!-- Left Side Content / End -->


        <!-- Right Side Content / End -->
        <div class="right-side">
            <div class="header-widget">
            	<?php if(empty($_SESSION["user_cache"])){ ?>
                <a href="#sign-in-dialog" class="sign-in popup-with-zoom-anim"><i class="sl sl-icon-login"></i> Sign In</a>
                <?php }else{ ?>
                <a href="dashboard.php" class="sign-in"><i class="sl sl-icon-login"></i> Dashboard</a>
                <?php } ?>
                <a href="postIssue.php" class="button border with-icon">Complain <i class="sl sl-icon-plus"></i></a>
            </div>
        </div>
        <!-- Right Side Content / End -->

        <!-- Sign In Popup -->
        <div id="sign-in-dialog" class="zoom-anim-dialog mfp-hide">

            <div class="small-dialog-header">
                <h3>Sign In</h3>
            </div>
            
            <?php 
			if(isset($_POST['login'])){
				$em = trim(strtolower($_POST['em'])); $pw = trim($_POST['pw']);
				$_SESSION['em'] = $em; $_SESSION['pw'] = $pw; 
				
				if(empty($em) || empty($pw)){
					echo alert('Please fill required fields','notice');
				}else{
			
				# Prevent MySQL Injection while validating login								
				$query = $con->prepare("SELECT * FROM users 
						 WHERE em = :em AND pw = :pw");													
				$query -> execute(array('em'=>$em, 'pw'=>$pw));	
											
				// Get database value ----------------------------------------	
				//$query = $con->query('SELECT * FROM dashboard_ac');
				while($row = $query->fetch()){
					if($row['em'] == $em && $row['pw'] == $pw){
					$username=$row['em']; $password=$row['pw'];
					$user_cache = $row['id']; $status = $row['status'];
					}
				}# while statement --------------------------------------
						
				$count = $con->query('SELECT COUNT(*) FROM users');									
				if($count->fetchColumn() == 0){ # database is empty
						echo alert("Blank Mode. Contact live help.", "error"); 			
				}elseif($username != $em && $password != $pw){ # wrong matching
						echo alert("Invalid account info, Retry.", "error");
				}elseif($status == 1){ # Blocked Access
						echo alert("Account Blocked. Contact Administrator.", "error");
				}else{	
								
					switch ($status){
						case 0:				
							$_SESSION["user_cache"]=$user_cache; $_SESSION['back_pw']='';
							$return_url=$_GET['$return_url'];
							if(empty($return_url)){$_SESSION['back_pw']='';
								header("Location: dashboard.php");					
								exit;
							}else{								
								header("Location: ".$return_url);
								exit;
							}	
						break;
							
					} # Switch ends	
							
				} # if statement ends	
		  } # empty
			
			
			
			
			
			
			}
			?>

            <!--Tabs -->
            <div class="sign-in-form style-1">

                <ul class="tabs-nav1">
                    <li class=""><a href="#tab12">Log In</a></li>
                </ul>

                <div class="tabs-container alt">

                <!-- Login -->
                <div class="tab-content" id="tab1" style="display: none;">
                
                
                    <form action="#" method="post" >

                        <p class="form-row form-row-wide">
                            <label for="username">Email Address:
                             <i class="im im-icon-Male"></i>
                              <input type="text" required="required" name="em" value="<?php echo $_SESSION['em']; ?>" />
                            </label>
                        </p>

                        <p class="form-row form-row-wide">
                            <label for="password">Password:
                              <i class="im im-icon-Lock-2"></i>
                              <input class="input-text" required="required" type="password" name="pw" value="<?php echo $_SESSION['pw']; ?>" />
                            </label>
                            <!--<span class="lost_password">
                                <a href="#" >Lost Your Password?</a>
                            </span> -->
                        </p>

                        <div class="form-row">
                            <input type="submit" class="button border margin-top-5" name="login" value="Login" />
                            <!--<div class="checkboxes margin-top-10">
                                <input id="remember-me" type="checkbox" name="check">
                                <label for="remember-me">Remember Me</label>
                            </div> -->
                        </div>
                        
                    </form>
                </div>
                
            </div>
        </div>
    </div>
    <!-- Sign In Popup / End -->

    </div>
</div>
<!-- Header / End -->

</header>
<div class="clearfix"></div>
<!-- Header Container / End -->

