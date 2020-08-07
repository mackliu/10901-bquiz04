<style>
.all td
{
	min-width:50px;
	padding:10px;
}
</style>
<?php
//先判斷網址是否帶有商品，有的話先加入到購物車
if(!empty($_GET['id'])){

    $_SESSION['cart'][$_GET['id']]=$_GET['qt'];

}else if(!isset($_SESSION['cart']) || empty($_SESSION['cart'])){ //判斷購物車是否為空車及購物車是否存在

    echo "<h2 class='ct'>請選擇商品</h2>";
    exit();
}

//判斷是否為登入的使用者，未登入則導向登入頁
if(empty($_SESSION['member'])){
    to("?do=login");
}

echo "<h2 class='ct'>".$_SESSION['member']."的購物車</h2>";
?>
<table class="all ct">
    <tr class="tt">
        <td>編號</td>
        <td>商品名稱</td>
        <td>數量</td>
        <td>庫存量</td>
        <td>單價</td>
        <td>小計</td>
        <td>刪除</td>
    </tr>
<?php    
foreach($_SESSION['cart'] as $id => $qt){
    $goods=$Goods->find($id);
?>

    <tr class="pp">
        <td><?=$goods['no'];?></td>
        <td><?=$goods['name'];?></td>
        <td><?=$qt;?></td>
        <td><?=$goods['stock'];?></td>
        <td><?=$goods['price'];?></td>
        <td><?=$goods['price']*$qt;?></td>
        <td>
            <a href="javascript:delCart(<?=$goods['id'];?>)">
                <img src="icon/0415.jpg" alt="">
            </a>
        </td>
    </tr>
<?php
}
?>
</table>
<div class="ct">
    <a href="index.php"><img src="icon/0411.jpg" alt=""></a><a href="?do=check"><img src="icon/0412.jpg" alt=""></a>
</div>
<script>
//history.pushState(null,null,'?do=buycart');
function delCart(id){
    $.post("api/del_cart.php",{id},function(){
        location.href="?do=buycart"
        //location.reload();
    })
}


</script>