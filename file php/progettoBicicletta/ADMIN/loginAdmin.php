<!DOCTYPE html>
<html lang="it">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Admin</title>
    <link rel="stylesheet" href="../css/style.css">
</head>
<body>
<script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>

<script>
    
    function controlloCredenziali(username, password) {

        $.post("../php/ADMIN/loginAdmin.php", { username: username, password: password }, function(data) {
            console.log(data);
            if (data.stato == "successo") {
                $("#responseMessage").text("Login effettuato con successo.");
                window.location.href = "dashboardAdmin.php";
            } else {
                $("#responseMessage").text("Si è verificato un errore durante il login: " + data.messaggio);
            }
        }, "json");
    };

</script>
<div class="container">
<h2>Login Admin</h2>

<form id="loginForm">
    <label for="username">Username:</label><br>
    <input type="text" id="username" name="username" required><br>
    <label for="password">Password:</label><br>
    <input type="password" id="password" name="password" required><br><br>
    <button type="button" onclick="controlloCredenziali($('#username').val(), $('#password').val())">Accedi</button>
<div id="responseMessage"></div>
</div>
</body>
</html>
