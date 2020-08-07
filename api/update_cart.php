<?php

include_once "../base.php";

$sum=0;
if(!empty($_SESSION['cart'])){

    foreach($_SESSION['cart'] as $id => $qt){
    
        $goo=$Goods->find($id);
        $p=$goo['price'];
        $sum=$sum+($p*$qt);
    }
    
    echo json_encode(['sum'=>$sum,'items'=>count($_SESSION['cart'])]);
}
?>