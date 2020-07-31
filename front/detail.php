<?php

$goods=$Goods->find($_GET['id']);


?>
<h2 class="ct"><?=$goods['name'];?></h2>
<div class="pp" style='display:flex;width:80%;margin:10px auto'>
    <div style="width:40%;text-align:center">
        <a href="?do=detail&id=<?=$goods['id'];?>"><img src="img/<?=$goods['img'];?>" style="width:80%"></a>
    </div>
    <div style="width:60%;">
        <div style="border-bottom:2px solid white">
        分類:<?=$Type->find($goods['big'])['name'] . ">" . $Type->find($goods['mid'])['name'];?>
        </div>
        <div style="border-bottom:2px solid white">編號:<?=$goods['no'];?></div>
        <div style="border-bottom:2px solid white">價格:<?=$goods['price'];?></div>
        <div style="border-bottom:2px solid white">詳細說明:<?=nl2br($goods['intro']);?></div>
        <div>庫存量:<?=$goods['stock'];?></div>
    </div>
</div>
        <div class="tt ct" style="width:80%;padding:10px 0;margin:auto;">
            <input type="number" name="qt" id="qt" style="width:30px" value="1">
            <input type="hidden" name="id" id="id" value="<?=$goods['id'];?>">
            <a href="javascript:buy()"><img src="icon/0402.jpg" ></a>
        </div>
        <div class="ct">
            <button onclick="location.href='index.php'">返回</button>
        </div>

        <script>
            function buy(){
                let id=$("#id").val();
                let qt=$("#qt").val();
                location.href=`?do=buycart&id=${id}&qt=${qt}`;
            }


        </script>

