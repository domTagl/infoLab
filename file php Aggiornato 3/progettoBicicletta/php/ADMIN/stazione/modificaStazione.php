<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "biciclette";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die(json_encode(array("messaggio" => "Connessione al database fallita: " . $conn->connect_error)));
}

$nomeVecchio = $conn->real_escape_string($_POST['nomeVecchio']);
$nomeNuovo = $conn->real_escape_string($_POST['nomeNuovo']);
$latitudine = $conn->real_escape_string($_POST['latitudine']);
$longitudine = $conn->real_escape_string($_POST['longitudine']);

$sql = "UPDATE stazione SET nome = '$nomeNuovo', latitudine = '$latitudine', longitudine = '$longitudine' WHERE nome = '$nomeVecchio'";

if ($conn->query($sql) === TRUE) {
    echo json_encode(array("messaggio" => "Stazione modificata con successo."));
} else {
    echo json_encode(array("messaggio" => "Errore: " . $conn->error));
}

$conn->close();
?>
