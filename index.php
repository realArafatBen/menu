<?php 
 include_once('inc/conn.php');
 include_once('inc/functions.php');
 include_once('inc/pagination.php');

$sql = "SELECT * FROM categories ORDER BY sort ASC";
$statement = $con->query($sql);
// get all publishers
$menugroups = $statement->fetchAll(PDO::FETCH_ASSOC);
?>
<!DOCTYPE html>
<html lang="en">
    <meta http-equiv="content-type" content="text/html;charset=UTF-8" />
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <meta name="apple-mobile-web-app-capable" content="yes" />
        <meta name="apple-mobile-web-app-status-bar-style" content="black-translucent" />
        <meta name="viewport" content="width=device-width, initial-scale=1, minimum-scale=1, maximum-scale=1, viewport-fit=cover" />

        <title>Menu</title>
        <link rel="icon" href="assets/img/favicon.png" type="image/x-icon" />
        <link rel="stylesheet" type="text/css" href="assets/css/framework.css" />
        <link href="assets/css/frontend.css" rel="stylesheet" />
        <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.13.0/css/all.min.css" rel="stylesheet" />
        <link rel="icon" href="assets/img/favicon.png" type="image/x-icon" />
    </head>

    <body class="theme-light" data-highlight="gray2">
        <div id="app" x-data="page()" x-init="() => { init() }">
            <div id="page" class="text-size-changer">
                <div id="page-preloader">
                    <div class="loader-main"><div class="preload-spinner border-highlight"></div></div>
                </div>

                <!-- Header -->
                <?php 
                    include_once "includes/header.html";
                ?>
                <!-- Header -->

                <!-- Menu Navigation -->
                <?php 
                    include_once "includes/menu-navigation.html";
                ?>
                <!-- Menu navigation -->
                <!-- Footer menu -->
                <?php 
                    include_once "includes/footer-menu.html";
                ?>
                <!-- Footer menu -->

                <!-- Help Order -->
                <?php 
                    include_once "includes/help-order.html";
                ?>
                <!-- Help Order -->
                <!-- Menu instant favourites -->
                <?php 
                    include_once "includes/menu-instant-favourites.html";
                ?>
                <!-- Menu instant favourites -->
                
                <!-- Menu instant featured -->
                <?php 
                    include_once "includes/menu-instant-featured.html";
                ?>
                <!-- Menu instant featured -->
                
                <!-- Menu instant featured -->
                <?php 
                    include_once "includes/menu-instant-item.html";
                ?>
                <!-- Menu instant featured -->

                <div class="page-content">
                    <div class="content top-100 left-20 bottom-10">
                        <h1>Menu</h1>
                        <p class="under-heading opacity-90 bottom-0 font-16"></p>
                    </div>

                    <!-- Menus -->
                    <?php 
                        include_once "includes/menu.php";
                    ?>
                    <!-- Menus -->
                    
                    <!-- Search -->
                    <?php 
                        include_once "includes/search.html";
                    ?>
                    <!-- Search -->

                    <!-- Food -->
                    <?php 
                        include_once "includes/food.php";
                    ?>
                    <!-- Food -->
                    <div class="content bottom-20">
                        <div class="content content-box mb-0 p-2">
                            <p class="center-text bottom-0 disclaimer-text"></p>
                            <p class="top-10 center-text">Contactless menus powered by <a href="https://www.jubileesys.com/">Jubilee System Ltd</a></p>
                        </div>
                    </div>
                </div>
                <!-- end page content -->

                <a href="#" data-snack-manual-id="snackbar-favorites" id="invoke-favorites-snack" class="disabled"></a>
                <div class="snackbars snackbars-boxed snackbar-round">
                    <a href="#" class="bg-highlight color-white" id="snackbar-favorites">View Wish List by clicking the <i class="fas fa-heart"></i> menu icon</a>
                </div>

                <a href="#" data-snack-manual-id="snackbar-favorites-preview" id="invoke-favorites-preview-snack" class="disabled"></a>
                <div class="snackbars snackbars-boxed snackbar-round">
                    <a href="#" class="bg-highlight color-white" id="snackbar-favorites-preview"><i class="fas fa-heart"></i> Marking Wish List is disabled in preview mode.</a>
                </div>

                <div style="display: none;" id="qrstart" class="disabled" @click="start()"></div>
                <div style="display: none;" id="qrstart-instant" data-menu="menu-instant-item"></div>

                <div class="menu-hider"></div>
            </div>
            <!-- end #page -->
        </div>
        <!-- end #app -->


        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

        <script src="assets/js/custom.min.js"></script>
        <script src="assets/js/frontend.js"></script>
        <script src="assets/js/swiper-bundle.min.js"></script>

        <script>
            goMenu(<?php echo $menugroups['0']['id']; ?>);
            function goMenu( id ){
                $('.searchString').text("");
                $('.js_search_content').css("display","none");
                $('.js_food_content').css("display", 'block');
                $('.js_spinner').css("display", "block");
                var dataString = "id="+id;
                
                $.ajax({
                    method : "POST", 
                    data: dataString, 
                    url: "includes/fetch-food.php", 
                    success: resp=>{
                        $('.js_spinner').css("display", "none");
                        $('.replace_search_food').html(resp);
                    },  
                    error: err =>{
                        $('.js_spinner').css("display", "none");
                        alert("Oops, there was an error, try again later");
                    }
                })
            }
        </script>
        <script type="text/javascript">
            var swiper = new Swiper(".swiper-container", {
                slidesPerView: 3,
                slidesPerView: 3,
                slidesOffsetAfter: 15,
                slidesOffsetBefore: 15,
                spaceBetween: 10,
                pagination: {
                    el: ".swiper-pagination",
                    clickable: true,
                },
            });

            function clearSearch(){
                $('.js_search_field').val("");
                $('.searchString').text("");
                $('.js_search_content').css("display","none");
                $('.js_food_content').css("display", 'block');
            }

            $('body').on("keyup", ".js_search_field", function(){
                var _this = $(this);
                if(_this.val() != ""){
                    $('.searchString').text(_this.val());
                    $('.js_search_content').css("display","block");
                    $('.js_food_content').css("display", 'none');
                    $('.js_spinner').css("display",'block');
                    var  q = _this.val();

                    var dataString = "q=" + q;
                    $.ajax({
                        method: "POST", 
                        url: "includes/search-items.php", 
                        data:dataString, 
                        success: resp => {
                            $('.js_spinner').css("display", "none");
                            $('.js_replace_search_result').html(resp);

                        }, 
                        error: err => {
                            $('.js_spinner').css("display", "none");
                            alert("Oops, there was an error, try again later");
                        }

                    });
                }else{
                    $('.searchString').text("");
                    $('.js_search_content').css("display","none");
                    $('.js_food_content').css("display", 'block');
                }
            });

            function menu_instant_item(x){
                var name= x.getAttribute("data-name");
                var image = x.getAttribute("data-image");
                var description = x.getAttribute("data-description");
                var price = x.getAttribute("data-price");
                $('.price_market_price_text').text(price);
                $('.description_long_html').text(description);
                $('.instantItem_name').text(name);
                $('.item-instant-image-box').css("background", 'url(' + image + ')');
                $('.item-instant-image-box').css("background-position", 'center');
                $('.js_menu_instant_item').addClass("menu-active");
            }

            $('body').on("click", '.js_unlove', function(e){
                var _this = $(this);
                var id = _this.attr("data-id");
                // add to love items 
                var dataString = 'id=' + id;
                $.ajax({
                    method: "POST", 
                    url: "includes/unlove_item.php", 
                    data: dataString, 
                    success: resp => {
                        //change view 
                        _this.removeClass("js_unlove");
                        _this.addClass("js_love");
                        var is_ = _this.find("i");
                        is_.css("color", "#0000002b");
                    },  
                    error : err => {
                        alert("Oops, there was an error!");
                    }
                })
            })

            $('body').on("click", '.js_love', function(e){
                var _this = $(this);
                var id = _this.attr("data-id");
                // add to love items 
                var dataString = 'id=' + id;
                $.ajax({
                    method: "POST", 
                    url: "includes/love_item.php", 
                    data: dataString, 
                    success: resp => {
                        //change view 
                        _this.removeClass("js_love");
                        _this.addClass("js_unlove");
                        var is_ = _this.find("i");
                        is_.css("color", "red");
                    },  
                    error : err => {
                        alert("Oops, there was an error!");
                    }
                })
            })
            function showFavourite(){
                //fetch favourite 
                $.ajax({
                    method : "GET", 
                    url: "includes/fetch-favourite.php", 
                    success: resp=>{
                        $('.js_spinner').css("display", "none");
                        $('#favorites-row-container').html(resp);
                    },  
                    error: err =>{
                        $('.js_spinner').css("display", "none");
                        alert("Oops, there was an error, try again later");
                    }
                })
                $('#menu-instant-favorites').addClass("menu-active");
            }

        </script>
    </body>
</html>
