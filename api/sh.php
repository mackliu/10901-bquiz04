<?php include_once "../base.php";

    $goods=$Goods->find($_POST['id']);

    switch($_POST['type']){
        case 1:
            $goods['sh']=1;
            $Goods->save($goods);
        break;
        case 2:
            $goods['sh']=0;
            $Goods->save($goods);
        break;
    }

?>