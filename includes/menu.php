
    <div class="swiper-container" style="padding-top: 20px;">
        <!-- Additional required wrapper -->
        <div class="swiper-wrapper">
            <?php 
                foreach($menugroups as $row){
            ?>
            <div class="swiper-slide cat-slide">
                <div onclick="goMenu(<?php echo $row['id'] ?>)" data-height="80" class="js_select_menu slider-item caption round-medium pointer bottom-0">
                    <div class="caption-center">
                        <h1 class="color-white center-text bold font-18 category-slide-header"><?php echo $row['groupnm'] ?></h1>
                    </div>
                    <div class="caption-overlay bg-black opacity-30"></div>
                    <div class="caption-bg">

                        <!-- <img src="assets/img/logo-dark.png" class="image-background lazyload" /> -->
                    </div>
                </div>
            </div>
            <?php } ?>
        
        </div>
    </div>
