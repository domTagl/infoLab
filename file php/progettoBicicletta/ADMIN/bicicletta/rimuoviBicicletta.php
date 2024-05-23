<!DOCTYPE html>
<html lang="it">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Rimuovi Bicicletta</title>
    <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
</head>
<body>
    <h2>Rimuovi Bicicletta</h2>
    <form id="formRimuoviBicicletta">
        <label for="RFID">RFID:</label>
        <input type="text" id="RFID" name="RFID" required><br>

        <button type="submit">Rimuovi Bicicletta</button>
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
            $('#formRimuoviBicicletta').submit(function(event) {
                event.preventDefault();
                var formData = $(this).serialize();
                $.post("ajax/rimuoviBicicletta.php", formData, function(data) {
                    alert(data.messaggio);
                }).fail(function(xhr, status, error) {
                    console.error(xhr.responseText);
                });
            });
        });
    </script>
</body>
</html>
