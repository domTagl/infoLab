<?php
if (!isset($_SESSION)) {
    session_start();
}

if(!isset($_SESSION["IDadmin"])){
    echo 404;
    exit;
}
if(!isset($_SESSION["admin"])){
    echo 404;
    exit;
}
echo 200;
exit;
?>