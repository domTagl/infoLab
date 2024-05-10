<!DOCTYPE html>
<html lang="it">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registra Cliente</title>
    <link rel="stylesheet" href="css/style.css">
</head>
<body>
<script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>

<script>

    function controlloCredenziali(nome, cognome, email, numTel, password, via, citta, cap, provincia) {
        $.post("php/gestioneRegistraCliente.php", { nome: nome, cognome: cognome, 
            email: email, numTel: numTel, password: password, via: via, citta: citta, cap: cap, provincia: provincia}, function(data) {
            console.log(data);
            if (data.stato === "successo") {
                $("#responseMessage").text("Registrazione effettuata con successo.");
                window.location.href = "1.1mappaCliente.php"; 
            } else {
                $("#responseMessage").text("Si è verificato un errore durante la registrazione: " + data.messaggio);
            }
        }, "json");
    };

    function indietro() {
        window.location.href = "1.0loginCliente.php"; 
    };
</script>

<div class="container">
<h2>Registra Cliente</h2>

<form id="registraForm">
    <label for="nome">Nome:</label><br>
    <input type="text" id="nome" name="nome" required><br>
    <label for="cognome">Cognome:</label><br>
    <input type="text" id="cognome" name="cognome" required><br>
    <label for="email">Email:</label><br>
    <input type="email" id="email" name="email" required><br>
    <label for="numTel">Numero di Telefono:</label><br>
    <input type="tel" id="numTel" name="numTel" required><br>
    <label for="password">Password:</label><br>
    <input type="password" id="password" name="password" required><br>
    <label for="via">Via:</label><br>
    <input type="text" id="via" name="via" required><br>
    <label for="citta">Città:</label><br>
    <input type="text" id="citta" name="citta" required><br>
    <label for="cap">CAP:</label><br>
    <input type="text" id="cap" name="cap" required><br>
    <label for="provincia">Provincia:</label><br>
    <input type="text" id="provincia" name="provincia" required><br><br>
    <button type="button" onclick="controlloCredenziali($('#nome').val(), $('#cognome').val()
,$('#email').val(), $('#numTel').val(),$('#password').val(), $('#via').val()
,$('#citta').val(), $('#cap').val(),$('#provincia').val())">Registrati</button><br>
</form>

<button type="button" onclick="indietro()">indietro</button>

<div id="responseMessage"></div>
</div>
</body>
</html>
