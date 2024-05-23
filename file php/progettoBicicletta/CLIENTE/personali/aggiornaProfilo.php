<!DOCTYPE html>
<html lang="it">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Aggiorna Profilo</title>
    <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
    <link rel="stylesheet" href="../../css/style2.css">
    <link rel="stylesheet" href="../../css/style3.css">
</head>
<body>
<div class="container">
    <h2>Aggiorna Profilo</h2>

    <form id="formAggiornaProfilo">
        <label for="nome">Nome:</label>
        <input type="text" id="nome" name="nome" required><br>

        <label for="cognome">Cognome:</label>
        <input type="text" id="cognome" name="cognome" required><br>

        <label for="numTelefono">Numero di Telefono:</label>
        <input type="text" id="numTelefono" name="numTelefono" required><br>

        <label for="email">Email:</label>
        <input type="email" id="email" name="email" required><br>

        <label for="password">Nuova Password:</label>
        <input type="password" id="password" name="password" required><br>

        <h3>Località</h3>

        <label for="via">Via:</label>
        <input type="text" id="via" name="via" required><br>

        <label for="citta">Città:</label>
        <input type="text" id="citta" name="citta" required><br>

        <label for="cap">CAP:</label>
        <input type="text" id="cap" name="cap" required><br>

        <label for="provincia">Provincia:</label>
        <input type="text" id="provincia" name="provincia" required><br>
        
        <button type="submit">Aggiorna Profilo</button>
    </form>

    <div class="container">
        <br><button onclick="modificaCarta()">Modifica il numero della carta</button><br>
    </div>
</div>
    <script>
        $(document).ready(function() {
            $.post("session/controlloSessioneCliente.php", {}, function (data) {
                if(data == 404){
                    window.location.href = "index.php"; 
                }
            });

            $('#formAggiornaProfilo').submit(function(event) {
                event.preventDefault();
                var formData = $(this).serialize();

                $.post("php/aggiornaProfilo.php", formData, function(data) {
                    alert(data.messaggio);
                }, 'json').fail(function(xhr, status, error) {
                    alert('Errore durante l\'aggiornamento del profilo.');
                    console.error(xhr.responseText);
                });
            });
        });

        function modificaCarta() {
            window.location.href = "aggiornaCarta.php";
        }
    </script>

</body>
</html>
