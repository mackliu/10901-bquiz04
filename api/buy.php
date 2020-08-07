<?php
include_once "../base.php";

//用亂數方式產生六位數的訂單編號
$data['no']=date("Ymd").rand(100000,999999);

//計算購物車中的商品總價
$data['total']=0;
foreach($_SESSION['cart'] as $goods => $qt){
    $g=$Goods->find($goods);
    $data['total']=$data['total']+($g['price']*$qt);
}

//合併$data及於_POST兩個陣列的資料內容
$data=array_merge($data,$_POST);

//取得登入使用者的帳號
$data['acc']=$_SESSION['member'];

//轉換購物車陣列為字串
$data['goods']=serialize($_SESSION['cart']);

//儲存訂單資料
$Ord->save($data);

//刪除購物車(檢定可不做)
unset($_SESSION['cart']);
?>