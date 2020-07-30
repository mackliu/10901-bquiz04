<?php include_once "../base.php";

$table=$_GET['table'];
$db=new DB($table);

$acc=$_GET['acc'];
$pw=$_GET['pw'];
$chk=$db->find(['acc'=>$acc,'pw'=>$pw]);
if(!empty($chk)){
    echo 1;
    $_SESSION[$table]=$acc;
}else{
    echo 0;
}

?>