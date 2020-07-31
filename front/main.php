<h1>全部商品</h1>
<?php
$goods=$Goods->all(['sh'=>1]);
foreach($goods as $g){
?>
<div class="pp" style='display:flex;width:80%;margin:10px auto'>
<div style="width:40%;display:flex;justify-content:center;align-items:center">
<img src="img/<?=$g['img'];?>" style="width:80%">
</div>
<div style="width:60%;">
<div class="tt ct"><?=$g['name'];?></div>
<div>價格:<?=$g['price'];?>
<a href="?do=login"><img src="icon/0402.jpg" style="float:right"></a>
</div>
<div>規格:<?=$g['spec'];?></div>
<div>簡介:<?=mb_substr($g['intro'],0,25,'utf8');?>...</div>
</div>


</div>
    
<?php
}

?>