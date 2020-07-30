<div class="ct"><button onclick="location.href='?do=add_admin'">新增管理員</button></div>

<table class="all ct">
    <tr class="tt">
        <td>帳號</td>
        <td>密碼</td>
        <td>管理</td>
    </tr>
    <?php
    $ads=$Admin->all();
    foreach($ads as $ad){
    ?>
    <tr class="pp">
        <td><?=$ad['acc'];?></td>
        <td><?=str_repeat("*",strlen($ad['pw']));?></td>
        <td>
        <?php
        if($ad['acc']=='admin'){
            echo "此帳號為最高權限";
        }else{
        ?>
        <button onclick="location.href='?do=edit_admin&id=<?=$ad['id'];?>'">修改</button>
        <button onclick="del('admin',<?=$ad['id'];?>)">刪除</button>
        <?php
        }
        ?>
        </td>
    </tr>
    <?php
    }
    ?>
</table>
<div class="ct"><button onclick="location.href='index.php'">返回</button></div>