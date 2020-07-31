<h2 class="ct">新增商品</h2>
<form action="api/save_goods.php" method="post" enctype="multipart/form-data">
    <table class="all">
        <tr>
            <td class="tt ct">所屬大分類</td>
            <td class="pp">
                <select name="big" id="big"></select>
            </td>
        </tr>
        <tr>
            <td class="tt ct">所屬中分類</td>
            <td class="pp"><select name="mid" id="mid"></select></td>
        </tr>
        <tr>
            <td class="tt ct">商品編號</td>
            <td class="pp">
            <span id='noo'>完成分類後自動分配</span>

            </td>
        </tr>
        <tr>
            <td class="tt ct">商品名稱</td>
            <td class="pp"><input type="text" name="name" id="name"></td>
        </tr>
        <tr>
            <td class="tt ct">商品價格</td>
            <td class="pp"><input type="text" name="price" id="price"></td>
        </tr>
        <tr>
            <td class="tt ct">規格</td>
            <td class="pp"><input type="text" name="spec" id="spec"></td>
        </tr>
        <tr>
            <td class="tt ct">庫存量</td>
            <td class="pp"><input type="text" name="stock" id="stock"></td>
        </tr>
        <tr>
            <td class="tt ct">商品圖片</td>
            <td class="pp"><input type="file" name="img" id="img"></td>
        </tr>
        <tr>
            <td class="tt ct">商品介紹</td>
            <td class="pp"><textarea name="intro" id="intro" style="width:80%;height:100px"></textarea></td>
        </tr>
    </table>
    <div class="ct">
    <input type="submit" value="新增">
    <input type="reset" value="重置">
    <input type="button" value="返回">
    </div>
</form>

<script>
getBigOption()
function getBigOption(){
    $.get("api/get_big.php",function(options){
            $("#big").html(options)
         /*    genNo() */
            getMidOption()


            $("#big").on("change",function(){
                getMidOption()
   /*              genNo() */
            })
    })
}

function getMidOption(){
    $("#big").val()
    $.get("api/get_mid.php",{'bigId':$("#big").val()},function(options){
            $("#mid").html(options)
    })
}

/* function genNo(){
    let no=Math.random().toString().substr(2,6)
        $("#noo").html(no)
        $("#no").val(no)
    
} */


</script>