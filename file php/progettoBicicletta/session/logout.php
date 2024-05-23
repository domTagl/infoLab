<?php
session_start();

session_unset();
session_destroy();

// Ottieni l'URL di reindirizzamento dalla query string, con un fallback di sicurezza
$redirectUrl = isset($_GET['redirect']) ? filter_var($_GET['redirect'], FILTER_SANITIZE_URL) : 'index.php';

header("Location: $redirectUrl");
exit();
?>
