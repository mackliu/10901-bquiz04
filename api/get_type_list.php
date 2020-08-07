<?php
include_once "../base.php";

$bigs=$Type->all(['parent'=>0]);
foreach($bigs as $big){
    echo "<tr class='tt'>";
    echo "<td id='t".$big['id']."'><input type='text' name='big_v' value='".$big['name']."'></td>";
    echo "<td>";
    echo "<button onclick='edit2(".$big['id'].")'>修改</button>";
    echo "<button onclick='del(&#39;type&#39;,".$big['id'].")'>刪除</button>";
    echo "</td>";
    echo "</tr>";
    $mids=$Type->all(['parent'=>$big['id']]);
    if(!empty($mids)){
        foreach($mids as $mid){
            echo "<tr class='pp'>";
            echo "<td class='ct'  id='t".$mid['id']."'><input type='text' name='mid_v' value='".$mid['name']."'></td>";
            echo "<td>";
            echo "<button onclick='edit2(".$mid['id'].")'>修改</button>";
            echo "<button onclick='del(&#39;type&#39;,".$mid['id'].")'>刪除</button>";
            echo "</td>";
            echo "</tr>";
        }
    }
}



?>

