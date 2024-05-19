<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "biciclette";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die(json_encode(array("messaggio" => "Connessione al database fallita: " . $conn->connect_error)));
}

$stazione = $conn->real_escape_string($_POST['stazione']);
$RFIDVecchio = $conn->real_escape_string($_POST['RFIDVecchio']);
$RFIDNuovo = $conn->real_escape_string($_POST['RFIDNuovo']);
$stato = $conn->real_escape_string($_POST['stato']);

// Ottieni ID della stazione
$sqlStazione = "SELECT ID FROM stazione WHERE nome = '$stazione'";
$resultStazione = $conn->query($sqlStazione);
if ($resultStazione->num_rows > 0) {
    $rowStazione = $resultStazione->fetch_assoc();
    $IDstazione = $rowStazione['ID'];

    // Modifica slot
    $sql = "UPDATE bicicletta SET RFID = '$RFIDNuovo', stato = '$stato' WHERE RFID = '$RFIDVecchio' AND IDstazione = '$IDstazione'";

    if ($conn->query($sql) === TRUE) {
        echo json_encode(array("messaggio" => "Slot modificato con successo."));
    } else {
        echo json_encode(array("messaggio" => "Errore: " . $conn->error));
    }
} else {
    echo json_encode(array("messaggio" => "Stazione non trovata."));
}

$conn->close();
?>
