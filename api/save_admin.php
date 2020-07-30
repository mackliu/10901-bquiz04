<?php include_once "../base.php";

$_POST['pr']=serialize($_POST['pr']);
$Admin->save($_POST);

to("../admin.php?do=admin");
?>