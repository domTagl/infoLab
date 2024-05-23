<?php
if (!isset($_SESSION)) {
    session_start();
}

if($_SESSION["IDadmin"] == null){
    echo 404;
}
if($_SESSION["admin"] == null){
    echo 404;
}
echo 200;
?>