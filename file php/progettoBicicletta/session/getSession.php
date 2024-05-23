<?php
if (!isset($_SESSION)) {
    session_start();
}
if(isset($_SESSION["utente"])){
    if(isset($_SESSION["IDutente"])){
        echo $_SESSION["IDutente"];
        echo $_SESSION["utente"]["ID"];
    };
}
if(isset($_SESSION["admin"])){
    if(isset($_SESSION["IDadmin"])){
        echo $_SESSION["IDadmin"];
        echo $_SESSION["admin"]["ID"];
    };
}
?>