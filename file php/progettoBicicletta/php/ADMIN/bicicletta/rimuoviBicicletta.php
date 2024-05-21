<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "biciclette";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die(json_encode(array("messaggio" => "Connessione al database fallita: " . $conn->connect_error)));
}

$RFID = $conn->real_escape_string($_POST['RFID']);

$sql = "DELETE FROM bicicletta WHERE RFID = '$RFID'";

if ($conn->query($sql) === TRUE) {
    echo json_encode(array("messaggio" => "Bicicletta rimossa con successo."));
} else {
    echo json_encode(array("messaggio" => "Errore: " . $conn->error));
}

$conn->close();
?>
