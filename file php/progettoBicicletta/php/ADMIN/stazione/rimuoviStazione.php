<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "biciclette";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die(json_encode(array("messaggio" => "Connessione al database fallita: " . $conn->connect_error)));
}

$nome = $conn->real_escape_string($_POST['nome']);

$sql = "DELETE FROM stazione WHERE nome = '$nome'";

if ($conn->query($sql) === TRUE) {
    echo json_encode(array("messaggio" => "Stazione rimossa con successo."));
} else {
    echo json_encode(array("messaggio" => "Errore: " . $conn->error));
}

$conn->close();
?>
