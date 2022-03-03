<?php 
 include_once('../inc/conn.php');
 include_once('../inc/functions.php');

if(isset($_POST['id'])){
    $id = $_POST['id'];
    $sql = "SELECT * FROM products WHERE category_id = '$id' ORDER BY id DESC";
    $statement = $con->query($sql);
    $items = $statement->fetchAll(PDO::FETCH_ASSOC);

    $sql2 = "SELECT * FROM categories WHERE id = '$id'";
    $statement2 = $con->query($sql2);
    // get all publishers
    $menugroup = $statement2->fetch(PDO::FETCH_ASSOC);
    $html = '
            <div id="item-rows-container">
                <div class="content-title has-title">
                    <h1 class="category_name">'.$menugroup['name'].'</h1>
                    <span class="color-highlight bottom-5 cat-description category_description_short" x-show="category.description_short"></span>
                    <p class="opacity-60 font-12 color-theme" x-show="category.description_long_html" x-html="category.description_long_html"></p>
                    <div class="divider divider-bottom bottom-10"></div>
                </div>
                <div>
            <div>
    ';
    foreach ($items as $row) {

        $item_image = "<img src='https://www.cuebarabuja.com/".$row['photo'] ."' style='width:50px;object-fit:contain;height:50px;'/>";
        $image_string = "https://www.cuebarabuja.com/". $row['photo'];

        if(!checkIfLove($row['id'])){
            $love = '<div class="js_love" data-id="'.$row['id']. '"><i class="fas fa-heart top-5 left-10 fa-2x" style="color:#0000002b" aria-hidden="true"></i></div>';
        }else{
            $love = '<div class="js_unlove" data-id="'.$row['id']. '"><i class="fas fa-heart top-5 left-10 fa-2x" style="color:red;" aria-hidden="true"></i></div>';
        }

        if($row['descr'] != ""){
            $description = '<div class="description"><span x-html="item.description_short">'. strip_tags($row['description']) .'</span><span x-show="item.description_short"> &raquo;</span></div>';
        }else{
            $description = "";
        }
        $html .= '
        <div class="item-row">
        <div class="item-left pointer" onclick="menu_instant_item(this)" 
        data-name="'.$row['name'].'" data-price="&#8358;'.number_format($row['price']).'" data-image="'.$image_string.'" data-description="'. strip_tags($row['description']).'">
            '.$item_image.'
        </div>
        <div class="item-right">
        '. $love .'
        </div>
        <div class="item-middle pointer" onclick="menu_instant_item(this)" 
        data-name="'.$row['name'].'" data-price="&#8358;'. number_format($row['price']).'" data-image="'.$image_string.'" data-description="'. strip_tags($row['description']).'">
            <span class="title color-highlight">
                <span x-html="item.name">'. $row['name'] .'</span><span x-show="!item.description_short"> &raquo;</span>
            </span>
            <span class="price" x-text="item.price_market_price_text">&#8358;'. number_format($row['price']) .'</span>
        '. $description .'
        </div>
        <div class="clear"></div>
    </div>
        ';
    }
    

    $html .= '
            </div>
            </div>
        </div>';
    echo $html;
}
?>