<h2 class="ct">商品分類</h2>
<div class="ct">新增大分類<input type="text" name="big" id="big"><button onclick="addBig()">新增</button></div>
<div class="ct">
新增中分類<select name="mid" id="mid"></select>
<input type="text" name="mid_name" id="mid_name"><button onclick="addMid()">新增</button>

</div>
<table class="all type-list"></table>


<h2 class="ct">商品管理</h2>
<div class="ct"><button onclick="location.href='?do=add_goods'">新增商品</button></div>
<table class="all">
    <tr class="tt ct">
        <td>編號</td>
        <td>商品名稱</td>
        <td>庫存量</td>
        <td>狀態</td>
        <td >操作</td>
    </tr>
    <?php
    $goods=$Goods->all();
    foreach($goods as $g){
    ?>
    <tr class="pp">
        <td class="ct" ><?=$g['no'];?></td>
        <td><?=$g['name'];?></td>
        <td class="ct"><?=$g['stock'];?></td>
        <td class="ct">
        <?=($g['sh']==1)?"販售中":"已下架";?>
        </td>
        <td class="ct">
        <button>修改</button>
        <button>刪除</button>
        <button>上架</button>
        <button>下架</button>
        </td>
    </tr>

    <?php
        }

    ?>
</table>


<script>
getTypeList()
getBigOption()

function addBig(){
    $.post("api/save_type.php",{'name':$("#big").val(),'parent':0},function(){
        getBigOption()
        getTypeList()
    })
}

function edit(id){
    let newName=prompt("請輸入要修改的分類名稱",$("#t"+id).html())
    if(newName!=null){
        $("#t"+id).html(newName);
        $.post("api/edit_type.php",{id,newName})
    }
}

function getBigOption(){
    $.get("api/get_big.php",function(options){
            $("#mid").html(options)
    })
}

function addMid(){
    let name=$("#mid_name").val();
    let big=$("#mid").val();

    $.post("api/save_type.php",{'name':name,'parent':big},function(){
        getBigOption()
        getTypeList()
    })
}

function getTypeList(){
    $.get("api/get_type_list.php",function(list){
        $(".type-list").html(list)
    })
}

</script>
