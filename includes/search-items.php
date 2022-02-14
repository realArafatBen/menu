<?php 
 include_once('../inc/conn.php');
 include_once('../inc/functions.php');
if(isset($_POST['q'])){
    $q = $_POST['q'];
    $sql = "SELECT * FROM menuitems WHERE item LIKE '%$q%' ORDER BY id DESC";
    $statement = $con->query($sql);
    $items = $statement->fetchAll(PDO::FETCH_ASSOC);

    $html = '<div><div>';
    if(count($items) == 0){
        $html .= "<p>No results found</p>";
    }else{
        foreach ($items as $row) {
            $item_image = "";
            if(!checkIfLove($row['id'])){
                $love = '<div class="js_love" data-id="'.$row['id']. '"><i class="fas fa-heart top-5 left-10 fa-2x" style="color:#0000002b" aria-hidden="true"></i></div>';
            }else{
                $love = '<div class="js_unlove" data-id="'.$row['id']. '"><i class="fas fa-heart top-5 left-10 fa-2x" style="color:red;" aria-hidden="true"></i></div>';
            }
    
            if($row['descr'] != ""){
                $description = '<div class="description"><span x-html="item.description_short">'. $row['descr'] .'</span><span x-show="item.description_short"> &raquo;</span></div>';
            }else{
                $description = "";
            }
            $html .='
            <div class="item-row">
            <div class="item-left pointer" data-menu="menu-instant-item" @click="showInstant(item.id)">
                '.$item_image.'
                <span class="price" x-text="item.price_market_price_text">'. number_format($row['price'], 2) .'</span>
            </div>
            <div class="item-right">
            '. $love .'
            </div>
            <div class="item-middle pointer" data-menu="menu-instant-item" @click="showInstant(item.id)">
                <span class="title color-highlight">
                    <span x-html="item.name">'. $row['item'] .'</span><span x-show="!item.description_short"> &raquo;</span>
                </span>
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