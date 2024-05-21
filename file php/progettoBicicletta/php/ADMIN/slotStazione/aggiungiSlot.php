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
$RFID = $conn->real_escape_string($_POST['RFID']);
$stato = $conn->real_escape_string($_POST['stato']);

// Ottieni ID della stazione
$sqlStazione = "SELECT ID FROM stazione WHERE nome = '$stazione'";
$resultStazione = $conn->query($sqlStazione);
if ($resultStazione->num_rows > 0) {
    $rowStazione = $resultStazione->fetch_assoc();
    $IDstazione = $rowStazione['ID'];

    // Inserisci nuovo slot
    $sql = "INSERT INTO bicicletta (RFID, stato, IDstazione) VALUES ('$RFID', '$stato', '$IDstazione')";

    if ($conn->query($sql) === TRUE) {
        echo json_encode(array("messaggio" => "Slot aggiunto con successo."));
    } else {
        echo json_encode(array("messaggio" => "Errore: " . $conn->error));
    }
} else {
    echo json_encode(array("messaggio" => "Stazione non trovata."));
}

$conn->close();
?>
