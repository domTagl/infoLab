<!DOCTYPE html>
<html lang="it">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Modifica Bicicletta</title>
    <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
</head>
<body>
    <h2>Modifica Bicicletta</h2>
    <form id="formModificaBicicletta">
        <label for="RFID">RFID Bicicletta:</label>
        <input type="text" id="RFID" name="RFID" required><br>

        <label for="nuovoStato">Nuovo Stato Bicicletta:</label>
        <input type="text" id="nuovoStato" name="nuovoStato" required><br>

        <button type="submit">Modifica Bicicletta</button>
    </form>

    <script>
        $(document).ready(function() {
            $('#formModificaBicicletta').submit(function(event) {
                event.preventDefault();
                var formData = $(this).serialize();
                $.post("ajax/modificaBicicletta.php", formData, function(data) {
                    alert(data.messaggio);
                }).fail(function(xhr, status, error) {
                    console.error(xhr.responseText);
                });
            });
        });
    </script>
</body>
</html>
