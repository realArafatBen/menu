<?php  
    include_once('../inc/conn.php');
    include_once('../inc/functions.php');
    if($_SERVER['REQUEST_METHOD'] == "GET"){

        if (isset($_COOKIE['menu_love'])) {
            $cookie_data = stripcslashes($_COOKIE['menu_love']);
            $data = json_decode($cookie_data, true);
            
        }else{
            $data = [];
        }

        $html = "";

        for ($i=0; $i < count($data); $i++) {
            $id = $data[$i];
            $sql = "SELECT * FROM products WHERE id = '$id'";
            $statement = $con->query($sql);
            // get all publishers
            $row = $statement->fetch(PDO::FETCH_ASSOC);
    
            if(!checkIfLove($row['id'])){
                $love = '<div class="js_love" data-id="'.$row['id']. '"><i class="fas fa-heart top-5 left-10 fa-2x" style="color:#0000002b" aria-hidden="true"></i></div>';
            }else{
                $love = '<div class="js_unlove" data-id="'.$row['id']. '"><i class="fas fa-heart top-5 left-10 fa-2x" style="color:red;" aria-hidden="true"></i></div>';
            }
    
            if($row['description'] != ""){
                $description = '<div class="description"><span x-html="item.description_short">'. $row['description'] .'</span><span x-show="item.description_short"> &raquo;</span></div>';
            }else{
                $description = "";
            }
            $item_image = "";
            $html .= '
                    <div class="item-row">
                    <div class="item-left pointer" onclick="menu_instant_item(this)" 
                    data-name="'.$row['name'].'" data-price="'.$row['price'].'" data-image="'.$item_image.'" data-description="'.$row['description'].'">
                        '.$item_image.'
                        <span class="price" x-text="item.price_market_price_text">'. number_format($row['price'], 2) .'</span>
                    </div>
                    <div class="item-right">
                    '. $love .'
                    </div>
                    <div class="item-middle pointer" onclick="menu_instant_item(this)" 
                    data-name="'.$row['name'].'" data-price="'.$row['price'].'" data-image="'.$item_image.'" data-description="'.$row['description'].'">
                        <span class="title color-highlight">
<<<<<<< HEAD
                            <span x-html="item.name">'. $row['name'] .'</span><span x-show="!item.description_short"> &raquo;</span>
=======
                            <span x-html="item.name" style="margin-left:10px;">'. $row['item'] .'</span><span x-show="!item.description_short"> &raquo;</span>
>>>>>>> 5ab9d484c430b1705cf19f3605f6c2209fd55c4e
                        </span>
                    '. $description .'
                    </div>
                    <div class="clear"></div>
                </div>
                ';
        }

        echo $html;
    }
?>