<!DOCTYPE html>
<html lang="it">
<head>
    <title>Login Cliente</title>
    <link rel="stylesheet" href="css/style.css">
</head>
<body>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>

<script>
    function controlloCredenziali(email, password) {
        $.post("php/gestioneLoginCliente.php", { email: email, password: password }, function(data) {
            console.log(data);
            if (data.stato == "successo") {
                $("#responseMessage").text("Login effettuato con successo.");
                window.location.href = "1.1mappaCliente.php";
            } else {
                $("#responseMessage").text("Si è verificato un errore durante il login: " + data.messaggio);
            }
        }, "json");
    };
        
    function registra() {
        window.location.href = "1.0registraCliente.php"; 
    };
</script>
<div class="container">
<h2>Login Cliente</h2>

<label for="email">Email:</label><br>
<input type="text" id="email" name="email" required><br>
<label for="password">Password:</label><br>
<input type="password" id="password" name="password" required><br><br>
<button type="button" onclick="controlloCredenziali($('#email').val(), $('#password').val())">Accedi</button>

<button type="button" onclick="registra()">Registrati</button>

<p id="responseMessage"></p> <!-- Aggiunto un paragrafo per visualizzare messaggi di risposta -->
</div>
</body>
</html>
