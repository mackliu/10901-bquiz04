<?php
$type=(!empty($_GET['type']))?$_GET['type']:0;
if(empty($type)){
    $goods=$Goods->all(['sh'=>1]);
    $nav='全部商品';
}else{
    $tt=$Type->find($type);
    if($tt['parent']==0){
        $goods=$Goods->all(['sh'=>1,'big'=>$type]);
        $nav=$tt['name'];
    }else{
        $goods=$Goods->all(['sh'=>1,'mid'=>$type]);
        $bb=$Type->find($tt['parent']);
        $nav=$bb['name'] . " > " . $tt['name'];
    }
}

?>

<h1><?=$nav;?></h1>
<?php
foreach($goods as $g){
?>
<div class="pp" style='display:flex;width:80%;margin:10px auto'>
    <div style="width:40%;text-align:center">
        <a href="?do=detail&id=<?=$g['id'];?>"><img src="img/<?=$g['img'];?>" style="width:80%"></a>
    </div>
    <div style="width:60%;">
        <div class="tt ct"><?=$g['name'];?></div>
        <div>價格:<?=$g['price'];?>
            <a href="?do=buycart&id=<?=$g['id'];?>&qt=1"><img src="icon/0402.jpg" style="float:right"></a>
        </div>
        <div>規格:<?=$g['spec'];?></div>
        <div>簡介:<?=mb_substr($g['intro'],0,25,'utf8');?>...</div>
    </div>

</div>

<?php
}

?>