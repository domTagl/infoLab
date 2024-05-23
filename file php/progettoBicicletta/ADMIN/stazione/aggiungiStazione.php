<!DOCTYPE html>
<html lang="it">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Aggiungi Stazione</title>
    <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
</head>
<body>
    <h2>Aggiungi Stazione</h2>
    <form id="formAggiungiStazione">
        <label for="nome">Nome Stazione:</label>
        <input type="text" id="nome" name="nome" required><br>

        <label for="latitudine">Latitudine:</label>
        <input type="text" id="latitudine" name="latitudine" required><br>

        <label for="longitudine">Longitudine:</label>
        <input type="text" id="longitudine" name="longitudine" required><br>

        <button type="submit">Aggiungi Stazione</button>
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
            $('#formAggiungiStazione').submit(function(event) {
                event.preventDefault();
                var formData = $(this).serialize();
                $.post("ajax/aggiungiStazione.php", formData, function(data) {
                    alert(data.messaggio);
                }).fail(function(xhr, status, error) {
                    console.error(xhr.responseText);
                });
            });
        });
    </script>
</body>
</html>
