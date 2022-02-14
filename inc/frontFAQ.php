<?php 
# Pagination --------------
$page = (int)(!isset($_GET["page"]) ? 1 : $_GET["page"]);
if ($page <= 0) $page = 1; 
$per_page = 10; // Records per page.
$startpoint = ($page * $per_page) - $per_page;
$statement = "menuitems WHERE status = 0 ORDER BY id ASC";
?>	

<div class="container">

	<!-- Blog Posts -->
	<div class="blog-page">
	<div class="row">

		<!-- Start Content -->
		<div class="col-lg-9 col-md-8 padding-right-30">

			<!-- Toggles Container -->
			<div class="style-2">                       
            <!-- Toggle 2 -->
            <div class="toggle-wrap">
            	<?php 
				# Prepering the pagination 
				$query = $con->query("SELECT * FROM {$statement} LIMIT {$startpoint} , {$per_page}");
				if($query->rowCount()<0){
					echo '<div style="color:red;">Oops: No customer record found.</div>';
				}else{
				?>
                 
				<?php while($row = $query->fetch(PDO::FETCH_ASSOC)){ ?>
                <span class="trigger">
                	<a href="#"><i class="sl sl-icon-pin"></i>
                    	<?php echo ($row['item']); ?> <i class="sl sl-icon-plus"></i> 
                     </a>
                </span>
                
                <div class="toggle-container">
                    <p><?php echo $row['descr']; ?></p>
                </div>
              <?php }} ?>  
            </div>
        </div>
        <!-- Toggles Container / End -->
        
            <!-- PAGINATION LINK  -->
            <div class="" style="text-align:center;">
                <div class="pagination">
                    <ul><?php echo pagination($statement,$per_page,$page,$url='?'); ?></ul>
                </div>
            </div>  

        </div>
        <!-- Content / End -->



	<!-- Widgets -->
	<div class="col-lg-3 col-md-4">
		<div class="sidebar right">

			
            
			<div class="clearfix"></div>
			<div class="margin-bottom-40"></div>
		</div>
	</div>
	</div>
	<!-- Sidebar / End -->


</div>
</div>








</div>
<!-- Wrapper / End -->
