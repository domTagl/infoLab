<?php
session_start();

// Controllo se l'utente è un amministratore
if (!isset($_SESSION['admin']) || !isset($_SESSION['IDadmin'])) {
    header("Location: ../../index.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="it">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Visualizza Biciclette</title>
    <link rel="stylesheet" href="../../css/style2.css">
    <link rel="stylesheet" href="../../css/style3.css">
    <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
</head>
<body>
    <div class="container">
        <h1>Visualizza Biciclette</h1>
        <div id="biciclette">
            <!-- Qui verranno visualizzate le biciclette -->
        </div>
    </div>

    <script>
        $(document).ready(function() {
            $.post("../../session/getSession.php", {}, function (data) {
            console.log("ciaoioo");
            console.log(data);
        });
        
        $.post("../../session/controlloSessioneDipendente.php", {}, function (data) {
            console.log(data);
            if(data == 404){
                window.location.href = "../../index.php"; 
            }
        });
            $.post("../../php/ADMIN/getBiciclette.php", {}, function(data) {
                $('#biciclette').html(data);
            }).fail(function(xhr, status, error) {
                console.error(xhr.responseText);
            });
        });
    </script>
</body>
</html>
