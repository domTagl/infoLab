<!DOCTYPE html>
<html lang="it">
<head>
    <meta charset="UTF-8">
    <title>Simulazione Torretta</title>
    <link rel="stylesheet" href="../../css/style.css"> <!-- Aggiungi il tuo stile CSS qui -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
    <script>
    //ovviamente nella realta non sarà la "torretta"
    //ad muovere le biciclette ma sarà 
    //il cliente ad andarci in giro
    //comunque c'è ws per fare anche ciò ../aggiornaPosizioneBiciGPS.php

    //METTERE 300000 30sec al posto di 1sec
    setInterval(function() {
        $.post("../aggiornaPosizioneBici.php", function(data) {
            console.log("Posizione biciclette aggiornata");
        });
    }, 30000);


</script>
</head>
<body>
    <div class="container">
        <h1>Simulazione Torretta</h1>
        
        <!-- Sezione per prenotare una bici -->
        <!-- la torretta è ha conoscenza del numero di carta comunale dell'utente
        in quanto questo la deve inserire/far leggere alla torretta. La torretta è ha conoscenza
        del RFID della bici in quanto ha un dispositivo per leggerla. Quindi manda i dati al WS -->
        <div class="section">
            <h2>Prenota una Bici</h2>
            <form id="prenotaBiciForm">
                <label for="cartaComunalePrenota">Carta Comunale:</label>
                <input type="text" id="cartaComunalePrenota" name="cartaComunalePrenota" required>
                <br>
                <label for="RFIDPrenota">RFID Bici:</label>
                <input type="text" id="RFIDPrenota" name="RFIDPrenota" required>
                <br>
                <button type="submit">Prenota Bici</button>
            </form>
            <div id="prenotaResult"></div>
        </div>

        <!-- Sezione per restituire una bici -->
        <!-- la torretta è ha conoscenza dell'ID della stazione pechè ipotizzo che 
        quando viene posizionata dagli addetti in un posto questi la configurino
        nel modo corretto. La torretta è ha conoscenza
        del RFID della bici in quanto ha un dispositivo per leggerla. Quindi manda i dati al WS -->
        <div class="section">
            <h2>Restituisci una Bici</h2>
            <form id="restituisciBiciForm">
                <label for="RFIDRestituisci">RFID Bici:</label>
                <input type="text" id="RFIDRestituisci" name="RFIDRestituisci" required>
                <br>
                <label for="IDstazioneRestituisci">ID Stazione:</label>
                <input type="text" id="IDstazioneRestituisci" name="IDstazioneRestituisci" required>
                <br>
                <button type="submit">Restituisci Bici</button>
            </form>
            <div id="restituisciResult"></div>
        </div>
    </div>

    <script>
        $(document).ready(function() {
            // Gestione prenotazione bici
            $('#prenotaBiciForm').on('submit', function(event) {
                event.preventDefault();
                
                var cartaComunale = $('#cartaComunalePrenota').val();
                var RFID = $('#RFIDPrenota').val();
                
                $.ajax({
                    url: '../prenotaBici.php',
                    type: 'POST',
                    data: {
                        cartaComunale: cartaComunale,
                        RFID: RFID,
                        azione: 'noleggia'
                    },
                    success: function(response) {
                        var result = JSON.parse(response);
                        $('#prenotaResult').html(result.message);
                    },
                    error: function() {
                        $('#prenotaResult').html("Errore nella richiesta.");
                    }
                });
            });

            // Gestione restituzione bici
            $('#restituisciBiciForm').on('submit', function(event) {
                event.preventDefault();
                
                var RFID = $('#RFIDRestituisci').val();
                var IDstazione = $('#IDstazioneRestituisci').val();
                
                $.ajax({
                    url: '../restituisciBici.php',
                    type: 'POST',
                    data: {
                        RFID: RFID,
                        IDstazione: IDstazione
                    },
                    success: function(response) {
                        var result = JSON.parse(response);
                        $('#restituisciResult').html(result.message);
                    },
                    error: function() {
                        $('#restituisciResult').html("Errore nella richiesta.");
                    }
                });
            });
        });
    </script>
</body>
</html>
