<?php
if (!isset($_SESSION)) {
    session_start();
}

if(!isset($_SESSION["IDutente"])){
    echo 404;
    exit;
}
if(!isset($_SESSION["utente"])){
    echo 404;
    exit;
}
echo 200;
exit;
?>