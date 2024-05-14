<!DOCTYPE html>
<html lang="it">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Aggiorna Profilo</title>
    <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
</head>

<body>

    <script>
        $(document).ready(function() {
            $('#formAggiornaProfilo').submit(function(event) {
                //per submit
                event.preventDefault();
                var formData = $(this).serialize();

                $.post("ajax/aggiornaProfilo.php", {}, function(data) {
                    alert(data.messaggio);
                }).fail(function(xhr, status, error) {
                    console.error(xhr.responseText);
                });
            });
        });
    </script>


    <h2>Aggiorna Profilo</h2>

    <form id="formAggiornaProfilo">
        <label for="nome">Nome:</label>
        <input type="text" id="nome" name="nome" required><br>

        <label for="cognome">Cognome:</label>
        <input type="text" id="cognome" name="cognome" required><br>

        <label for="domicilio">Domicilio:</label>
        <input type="text" id="domicilio" name="domicilio" required><br>

        <label for="numTelefono">Numero di Telefono:</label>
        <input type="text" id="numTelefono" name="numTelefono" required><br>

        <label for="email">Email:</label>
        <input type="email" id="email" name="email" required><br>

        <label for="password">Nuova Password:</label>
        <input type="password" id="password" name="password" required><br>

        <button type="submit">Aggiorna Profilo</button>
    </form>

</body>

</html>
