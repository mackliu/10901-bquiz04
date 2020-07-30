<?php include_once "../base.php";

switch($_GET['logout']){
    case "admin":
        unset($_SESSION['admin']);
    break;
    case "member":
        unset($_SESSION['member']);
        
    break;
}

to("../index.php");
?>