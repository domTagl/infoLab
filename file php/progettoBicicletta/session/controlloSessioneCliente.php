<?php
if (!isset($_SESSION)) {
    session_start();
}

if($_SESSION["IDutente"] == null){
    echo 404;
}
if($_SESSION["utente"] == null){
    echo 404;
}
echo 200;
?>