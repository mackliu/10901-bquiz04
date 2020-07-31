<?php include_once "../base.php";
    
    $mids=$Type->all(['parent'=>$_GET['bigId']]);
    foreach($mids as $m){
        echo "<option value='".$m['id']."'>".$m['name']."</option>";
    }

?>