<?php include_once "../base.php";


$Member->save($_POST);

to("../admin.php?do=mem");
?>