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
$stato = $conn->real_escape_string($_POST['stato']);
$IDstazione = $conn->real_escape_string($_POST['IDstazione']);

// Otteniamo lat e long dalla tabella stazione
$sqlStazione = "SELECT lat, longi FROM stazione WHERE ID = '$IDstazione'";
$resultStazione = $conn->query($sqlStazione);

if ($resultStazione->num_rows > 0) {
    $row = $resultStazione->fetch_assoc();
    $lat = $row["lat"];
    $long = $row["longi"];

    $metri = 0;

    $sql = "INSERT INTO bicicletta (ID, RFID, stato, IDstazione, metri, lat, longi) 
            VALUES (NULL, '$RFID', '$stato', '$IDstazione', '$metri', '$lat', '$long')";

    if ($conn->query($sql) === TRUE) {
        echo json_encode(array("messaggio" => "Bicicletta aggiunta con successo."));
    } else {
        echo json_encode(array("messaggio" => "Errore nell'inserimento: " . $conn->error));
    }
} else {
    echo json_encode(array("messaggio" => "Nessuna stazione trovata con l'ID specificato. Query: $sqlStazione"));
}


$conn->close();
?>
