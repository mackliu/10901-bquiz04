<h2 class="ct">商品分類</h2>
<div class="ct">新增大分類<input type="text" name="big" id="big"><button onclick="addBig()">新增</button></div>
<div class="ct">
新增中分類<select name="mid" id="mid"></select>
<input type="text" name="mid_name" id="mid_name"><button onclick="addMid()">新增</button>

</div>




<script>

function addBig(){
    $.post("api/add_big.php",{'name':$("#big").val(),'parent':0},function(){
        $.get("api/get_big.php",function(options){
            $("#mid").html(options)
        })
    })
}


function addMid(){

}


</script>
