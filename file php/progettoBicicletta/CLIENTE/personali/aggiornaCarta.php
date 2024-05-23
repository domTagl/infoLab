<!DOCTYPE html>
<html lang="it">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Modifica Numero Carta</title>
    <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
    <link rel="stylesheet" href="../../css/style.css">
</head>
<body>
<div class="container">
    <h2>Modifica Numero Carta</h2>

    <form id="formModificaCarta">
        <label for="numeroCartaAttuale">Numero Carta Attuale:</label>
        <input type="text" id="numeroCartaAttuale" name="numeroCartaAttuale" readonly><br>

        <label for="nuovoNumeroCarta">Nuovo Numero di Carta:</label>
        <input type="text" id="nuovoNumeroCarta" name="nuovoNumeroCarta" required pattern="\d{16}" title="Inserisci un numero di carta valido (16 cifre)"><br>

        <button type="submit">Modifica Numero Carta</button>
    </form>
</div>
    <script>
        $(document).ready(function() {
            $.post("../../session/controlloSessioneCliente.php", {}, function (data) {
                if(data == 404){
                    window.location.href = "index.php"; 
                }
            });

            // Carica il numero della carta corrente
            $.get("../../php/CLIENTE/visualizzaCarta.php", function(data) {
                $('#numeroCartaAttuale').val(data.numeroCarta);
            }, 'json');

            $('#formModificaCarta').submit(function(event) {
                event.preventDefault();
                var formData = $(this).serialize();

                $.post("../../php/CLIENTE/modificaCarta.php", formData, function(data) {
                    alert(data.messaggio);
                }, 'json').fail(function(xhr, status, error) {
                    alert('Errore durante la modifica del numero di carta.');
                    console.error(xhr.responseText);
                });
            });
        });
    </script>

</body>
</html>
