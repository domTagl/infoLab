<!DOCTYPE html>
<html lang="it">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Aggiungi Slot</title>
    <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
</head>
<body>
    <h2>Aggiungi Slot</h2>
    <form id="formAggiungiSlot">
        <label for="stazione">Nome Stazione:</label>
        <input type="text" id="stazione" name="stazione" required><br>

        <label for="RFID">RFID Bicicletta:</label>
        <input type="text" id="RFID" name="RFID" required><br>

        <label for="stato">Stato Slot:</label>
        <input type="text" id="stato" name="stato" required><br>

        <button type="submit">Aggiungi Slot</button>
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
            $('#formAggiungiSlot').submit(function(event) {
                event.preventDefault();
                var formData = $(this).serialize();
                $.post("ajax/aggiungiSlot.php", formData, function(data) {
                    alert(data.messaggio);
                }).fail(function(xhr, status, error) {
                    console.error(xhr.responseText);
                });
            });
        });
    </script>
</body>
</html>
