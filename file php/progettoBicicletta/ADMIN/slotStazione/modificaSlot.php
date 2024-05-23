<!DOCTYPE html>
<html lang="it">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Modifica Slot</title>
    <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
</head>
<body>
    <h2>Modifica Slot</h2>
    <form id="formModificaSlot">
        <label for="stazione">Nome Stazione:</label>
        <input type="text" id="stazione" name="stazione" required><br>

        <label for="RFIDVecchio">RFID Bicicletta Attuale:</label>
        <input type="text" id="RFIDVecchio" name="RFIDVecchio" required><br>

        <label for="RFIDNuovo">Nuovo RFID Bicicletta:</label>
        <input type="text" id="RFIDNuovo" name="RFIDNuovo" required><br>

        <label for="stato">Nuovo Stato Slot:</label>
        <input type="text" id="stato" name="stato" required><br>

        <button type="submit">Modifica Slot</button>
    </form>

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
            $('#formModificaSlot').submit(function(event) {
                event.preventDefault();
                var formData = $(this).serialize();
                $.post("ajax/modificaSlot.php", formData, function(data) {
                    alert(data.messaggio);
                }).fail(function(xhr, status, error) {
                    console.error(xhr.responseText);
                });
            });
        });
    </script>
</body>
</html>
