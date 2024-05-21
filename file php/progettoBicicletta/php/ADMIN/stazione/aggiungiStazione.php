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
$latitudine = $conn->real_escape_string($_POST['latitudine']);
$longitudine = $conn->real_escape_string($_POST['longitudine']);

$sql = "INSERT INTO stazione (nome, latitudine, longitudine) VALUES ('$nome', '$latitudine', '$longitudine')";

if ($conn->query($sql) === TRUE) {
    echo json_encode(array("messaggio" => "Stazione aggiunta con successo."));
} else {
    echo json_encode(array("messaggio" => "Errore: " . $conn->error));
}

$conn->close();
?>
