<h2 class="ct">會員註冊</h2>
<!-- table.all>tr*6>td.tt.ct+td.pp>input:text -->
<table class="all">
    <tr>
        <td class="tt ct">姓名</td>
        <td class="pp"><input type="text" name="name" id="name"></td>
    </tr>
    <tr>
        <td class="tt ct">帳號</td>
        <td class="pp"><input type="text" name="acc" id="acc"><button onclick="chkAcc()">檢測帳號</button></td>
    </tr>
    <tr>
        <td class="tt ct">密碼</td>
        <td class="pp"><input type="password" name="pw" id="pw"></td>
    </tr>
    <tr>
        <td class="tt ct">電話</td>
        <td class="pp"><input type="text" name="tel" id="tel"></td>
    </tr>
    <tr>
        <td class="tt ct">住址</td>
        <td class="pp"><input type="text" name="addr" id="addr"></td>
    </tr>
    <tr>
        <td class="tt ct">電子信箱</td>
        <td class="pp"><input type="text" name="email" id="email"></td>
    </tr>
</table>
<div class="ct"><button onclick="reg()">註冊</button><button onclick="reset()">重置</button></div>

<script>

//檢查帳號
function chkAcc(){
    let acc=$("#acc").val()
    $.get("api/chk_acc.php",{acc},function(res){
        if(res==1 || acc=='admin'){
            alert("該帳號己被註冊，請使用其他帳號註冊")
        }else{
            alert("此帳號可使用")
        }
    })
}


function reg(){
    let acc=$("#acc").val()
    let name=$("#name").val()
    let pw=$("#pw").val()
    let tel=$("#tel").val()
    let addr=$("#addr").val()
    let email=$("#email").val()

    //先檢查帳號是否重覆
    $.get("api/chk_acc.php",{acc},function(res){
        if(res==1 || acc=='admin'){
            alert("該帳號己被註冊，請使用其他帳號註冊")
        }else{
            //送出註冊資料
            $.post('api/reg.php',{acc,name,pw,tel,addr,email},function(){
                //註冊完成後將使用者導向登入頁面
                location.href='?do=login'
            })
        }
    })

}

//清空表單功能
function reset(){
    $("input[type='text'],input[type='password']").val("")
}

</script>