<?php
session_start();
// Controllo se l'utente è un amministratore
if (!isset($_SESSION['admin']) || $_SESSION['IDadmin'] != 1) {
    header("Location: ../index.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="it">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Statistiche Clienti</title>
    <link rel="stylesheet" href="../css/style2.css">
    <link rel="stylesheet" href="../css/style3.css">
    <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
</head>
<body>
    <div class="container">
        <h1>Statistiche Clienti</h1>
        <div id="statisticheClienti">
            <!-- visual. statistiche dei clienti -->
        </div>
    </div>

    <script>
        $(document).ready(function() {
            $.post("../php/ADMIN/getStatisticheClienti.php", {}, function(data) {
                $('#statisticheClienti').html(data);
            }).fail(function(xhr, status, error) {
                console.error(xhr.responseText);
            });
        });
    </script>
</body>
</html>
