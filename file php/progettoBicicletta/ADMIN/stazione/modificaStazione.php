<!DOCTYPE html>
<html lang="it">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Modifica Stazione</title>
    <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
</head>
<body>
    <h2>Modifica Stazione</h2>
    <form id="formModificaStazione">
        <label for="nomeVecchio">Nome Stazione Attuale:</label>
        <input type="text" id="nomeVecchio" name="nomeVecchio" required><br>

        <label for="nomeNuovo">Nuovo Nome Stazione:</label>
        <input type="text" id="nomeNuovo" name="nomeNuovo" required><br>

        <label for="latitudine">Nuova Latitudine:</label>
        <input type="text" id="latitudine" name="latitudine" required><br>

        <label for="longitudine">Nuova Longitudine:</label>
        <input type="text" id="longitudine" name="longitudine" required><br>

        <button type="submit">Modifica Stazione</button>
    </form>

    <script>
        $(document).ready(function() {
            $('#formModificaStazione').submit(function(event) {
                event.preventDefault();
                var formData = $(this).serialize();
                $.post("ajax/modificaStazione.php", formData, function(data) {
                    alert(data.messaggio);
                }).fail(function(xhr, status, error) {
                    console.error(xhr.responseText);
                });
            });
        });
    </script>
</body>
</html>
