<?php include_once "../base.php";

$db=new DB($_POST['table']);
$db->del($_POST['id']);

?>