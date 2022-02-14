<div class="row">

<!-- Profile -->
<div class="col-lg-6 col-md-12">
    <div class="dashboard-list-box margin-top-0">
        <h4 class="gray">Profile Details</h4>
        <div class="dashboard-list-box-static">
            
            <!-- Avatar -->
            <!--<div class="edit-profile-photo">
                <img src="images/user-avatar.jpg" alt="">
                <div class="change-photo-btn">
                    <div class="photoUpload">
                        <span><i class="fa fa-upload"></i> Upload Photo</span>
                        <input type="file" class="upload" />
                    </div>
                </div>
            </div> -->

            <!-- Details -->
            <div class="my-profile">
            
            <?php 
			if(isset($_POST['updateIt'])){
				# create variable
				$yrNm = $_POST['yrNm']; $yrEm = $_POST['yrEm'];
				$yrPn = $_POST['yrPn'];
						
				# create sessions
				$_SESSION['yrNm'] = $yrNm; $_SESSION['yrEm'] = $yrEm;
				$_SESSION['yrPn'] = $yrPn;
				
				if(empty($yrNm) || empty($yrEm) ){
					echo alert('Your name and email is required!', 'notice');
					
				}else{
				
				$data = array(
				'nm' => $yrNm,
				'pn' => $yrPn,
				'id' => $user_cache
				);
				$sql = "UPDATE users SET nm=:nm, pn=:pn WHERE id=:id";
				$stmt= $con->prepare($sql);
				$stmt->execute($data);
								
				# Alert Status -----------------------------------------
				echo alert('Profile updated successfully!', 'success');
				
				# Clear Session Variable
				$_SESSION['nm'] = ''; 
				$_SESSION['pn'] = ''; 				
				
			}}
			?>
				<form method="post" name="myp">
                <label>Your Name</label>
                <input value="<?php echo $yrNm; ?>" type="text" name="yrNm" required>

                <label>Email</label>
                <input readonly="readonly" value="<?php echo $yrEm; ?>" type="text" name="yrEm" required>

                <label>Phone</label>
                <input value="<?php echo $yrPn; ?>" maxlength="11" type="text" name="yrPn">
                
               
                <label for="dept">Department
                 <select>                            	
                   <option selected="selected" disabled>
				   <?php //$stmt = $con->query('SELECT * FROM depts WHERE id="'.$yrdept.'"');	
					//while($rows = $stmt->fetch()){echo $rows['nm'];}?>
                   </option> 
                 </select>
                </label> 
                
            </div>

            <button class="button margin-top-15" name="updateIt">Save Changes</button>
			</form>
        </div>
    </div>
</div>

<!-- Change Password -->
<div class="col-lg-6 col-md-12">
    <div class="dashboard-list-box margin-top-0">
        <h4 class="gray">Change Password</h4>
        <div class="dashboard-list-box-static">

            <!-- Change Password -->
            <div class="my-profile">
            
            <?php 
			if(isset($_POST['change_pwbtn'])){
				# initializing variable
				$cur_pw=$_POST['cur_pw']; $hidden_pw=$_POST['hidden_pw']; 
				$new_pw=$_POST['new_pw']; $renew_pw=$_POST['renew_pw'];	
					
				# sessioning variable
				$_SESSION['cur_pw']=$cur_pw; $_SESSION['hidden_pw']=$hidden_pw; 
				$_SESSION['new_pw']=$new_pw; $_SESSION['renew_pw']=$renew_pw; 
				
				if($cur_pw=='' || $new_pw=='' || $renew_pw==''){
					echo alert('Please enter all required feilds', 'error');
				}elseif($hidden_pw!=$cur_pw){
					echo alert("Invalid current password." , 'error');
				}elseif($new_pw!=$renew_pw){
					echo alert("New and Re-new password does not match.", 'notice');
				}else{		
				# update agent record
				$query = "UPDATE users SET pw='$new_pw' WHERE id='$_SESSION[user_cache]'";
				$con -> exec($query); echo alert("Password changed successfully", 'success');
				# clear session
				$_SESSION['cur_pw']='';	$_SESSION['new_pw']=''; $_SESSION['renew_pw']=''; 
					
				}
			}
			?>
            
            <form method="post" name="cpw">
            	<input type="hidden" name="hidden_pw" value="<?php echo $_SESSION['hidden_pw']; ?>">
            
                <label class="margin-top-0">Current Password</label>
                <input type="password" required name="cur_pw">

                <label>New Password</label>
                <input type="password" required name="new_pw">

                <label>Confirm New Password</label>
                <input type="password" required name="renew_pw">

                <button class="button margin-top-15" name="change_pwbtn">Change Password</button>
                </form>
            </div>

        </div>
    </div>
</div>
