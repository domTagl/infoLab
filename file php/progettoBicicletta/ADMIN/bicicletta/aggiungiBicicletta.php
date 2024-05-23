<!DOCTYPE html>
<html lang="it">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Aggiungi Bicicletta</title>
    <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
    <link rel="stylesheet" href="../../css/style.css">
</head>
<body>
<div class="container">
    <h2>Aggiungi Bicicletta</h2>
    <form id="formAggiungiBicicletta">
        <label for="RFID">RFID:</label>
        <input type="text" id="RFID" name="RFID" required><br><br>
        <label for="stato">Stato Bicicletta:</label>
        <input type="text" id="stato" name="stato" required><br><br>
        <label for="IDstazione">ID Stazione:</label>
        <input type="text" id="IDstazione" name="IDstazione" required><br><br>

        <button type="submit">Aggiungi Bicicletta</button>
    </form>
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
            $('#formAggiungiBicicletta').submit(function(event) {
                event.preventDefault();
                var formData = $(this).serialize();
                $.post("../../php/ADMIN/bicicletta/aggiungiBicicletta.php", formData, function(data) {
                    alert(data.messaggio);
                }).fail(function(xhr, status, error) {
                    console.error(xhr.responseText);
                });
            });
        });
    </script>
</body>
</html>
