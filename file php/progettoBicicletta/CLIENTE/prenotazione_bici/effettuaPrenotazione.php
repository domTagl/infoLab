<!DOCTYPE html>
<html lang="it">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Prenotazione Bici</title>
    <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
    <link rel="stylesheet" href="../../css/style2.css">
    <style>
    table {
        border-collapse: collapse;
        width: 100%;
    }

    th, td {
        border: 1px solid black;
        padding: 8px;
        text-align: left;
    }

    th {
        background-color: #f2f2f2;
    }
</style>

</style>
</head>
<body>
<div class="container">
    <h2>Prenotazione Bici</h2>

    <div class="container">
        <div id="tuttiPostiBici"></div>
    </div>
    </div>
    <script>
        $(document).ready(function() {
            var stazione = "<?php echo $_GET['stazione']; ?>";
            
            // Ottiene i dati dei posti bici disponibili
            $.get("../../php/visTuttiSlotBici.php", { stazione: stazione }, function(data) {
                $('#tuttiPostiBici').html(data);
            });

            // // Gestisce la prenotazione della bicicletta
            // $(document).on('click', '.prenotaBici', function() {
            //     var codiceCartaComune = $('#codiceCartaComune').val();
            //     var rfid = $(this).val();
            //     if (codiceCartaComune) {
            //         $.post("../../php/CLIENTE/prenotaBici.php", { codiceCartaComune: codiceCartaComune, rfid: rfid }, function(response) {
            //             alert(response.messaggio);
            //             location.reload();
            //         }, 'json').fail(function(xhr, status, error) {
            //             alert('Errore durante la prenotazione della bicicletta.');
            //             console.error(xhr.responseText);
            //         });
            //     } else {
            //         alert("Inserisci il codice della tessera comunale per prenotare una bicicletta.");
            //     }
            // });

            // // Gestisce la restituzione della bicicletta
            // $(document).on('click', '.restituisciBici', function() {
            //     var rfid = $('#RFID').val();
            //     if (rfid) {
            //         $.post("../../php/CLIENTE/restituisciBici.php", { rfid: rfid }, function(response) {
            //             alert(response.messaggio);
            //             location.reload();
            //         }, 'json').fail(function(xhr, status, error) {
            //             alert('Errore durante la restituzione della bicicletta.');
            //             console.error(xhr.responseText);
            //         });
            //     } else {
            //         alert("Inserisci l'RFID della bicicletta per restituirla.");
            //     }
            // });

        });
    </script>

</body>
</html>
