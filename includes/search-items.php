<?php 
 include_once('../inc/conn.php');
 include_once('../inc/functions.php');
if(isset($_POST['q'])){
    $q = $_POST['q'];
    $sql = "SELECT * FROM products WHERE name LIKE '%$q%' ORDER BY id DESC";
    $statement = $con->query($sql);
    $items = $statement->fetchAll(PDO::FETCH_ASSOC);

    $html = '<div><div>';
    if(count($items) == 0){
        $html .= "<p>No results found</p>";
    }else{
        foreach ($items as $row) {
            $item_image = "<img src='https://www.cuebarabuja.com/".$row['photo'] ."' style='width:50px;object-fit:contain;height:50px;'/>";
            $image_string = "https://www.cuebarabuja.com/". $row['photo'];
            if(!checkIfLove($row['id'])){
                $love = '<div class="js_love" data-id="'.$row['id']. '"><i class="fas fa-heart top-5 left-10 fa-2x" style="color:#0000002b" aria-hidden="true"></i></div>';
            }else{
                $love = '<div class="js_unlove" data-id="'.$row['id']. '"><i class="fas fa-heart top-5 left-10 fa-2x" style="color:red;" aria-hidden="true"></i></div>';
            }
    
            if($row['description'] != ""){
                $description = '<div class="description"><span x-html="item.description_short">'. strip_tags($row['description']) .'</span><span x-show="item.description_short"> &raquo;</span></div>';
            }else{
                $description = "";
            }
            $html .='
            <div class="item-row">
            <div class="item-left pointer" data-menu="menu-instant-item" onclick="menu_instant_item(this)" 
            data-name="'.$row['name'].'" data-price="&#8358;'.number_format($row['price']).'" data-image="'.$image_string.'" data-description="'. strip_tags($row['description']).'">
                '.$item_image.'
            </div>
            <div class="item-right">
            '. $love .'
            </div>
            <div class="item-middle pointer" data-menu="menu-instant-item" onclick="menu_instant_item(this)" 
            data-name="'.$row['name'].'" data-price="&#8358;'.number_format($row['price']).'" data-image="'.$image_string.'" data-description="'. strip_tags($row['description']).'">
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
    }

    

    $html .= '
            </div>
            </div>';
    echo $html;
}
?>