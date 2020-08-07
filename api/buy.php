<?php
include_once "../base.php";

$data['no']=date("Ymd").rand(100000,999999);

$data['total']=0;
foreach($_SESSION['cart'] as $goods => $qt){
    $g=$Goods->find($goods);
    $data['total']=$data['total']+($g['price']*$qt);
}

$data=array_merge($data,$_POST);
$data['acc']=$_SESSION['member'];
$data['goods']=serialize($_SESSION['cart']);
//print_r($data);
$Ord->save($data);
unset($_SESSION['cart']);
?>