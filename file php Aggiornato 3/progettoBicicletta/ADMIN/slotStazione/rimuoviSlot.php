<!DOCTYPE html>
<html lang="it">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Rimuovi Slot</title>
    <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
</head>
<body>
    <h2>Rimuovi Slot</h2>
    <form id="formRimuoviSlot">
        <label for="stazione">Nome Stazione:</label>
        <input type="text" id="stazione" name="stazione" required><br>

        <label for="RFID">RFID Bicicletta:</label>
        <input type="text" id="RFID" name="RFID" required><br>

        <button type="submit">Rimuovi Slot</button>
    </form>

    <script>
        $(document).ready(function() {
            $('#formRimuoviSlot').submit(function(event) {
                event.preventDefault();
                var formData = $(this).serialize();
                $.post("ajax/rimuoviSlot.php", formData, function(data) {
                    alert(data.messaggio);
                }).fail(function(xhr, status, error) {
                    console.error(xhr.responseText);
                });
            });
        });
    </script>
</body>
</html>
