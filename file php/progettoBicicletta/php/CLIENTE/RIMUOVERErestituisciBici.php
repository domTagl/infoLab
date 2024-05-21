<?php
session_start();
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "biciclette";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connessione fallita: " . $conn->connect_error);
}

$rfid = $conn->real_escape_string($_POST['rfid']);

// Query per ottenere l'ID dell'ultima operazione di riconsegna fatta con quell'RFID
$sql_last_return = "SELECT IDcliente FROM operazione 
                    WHERE IDbicicletta = (SELECT ID FROM bicicletta WHERE RFID = '$rfid') 
                    ORDER BY dataInizio DESC LIMIT 1";

$result_last_return = $conn->query($sql_last_return);

if ($result_last_return && $result_last_return->num_rows > 0) {
    $row_last_return = $result_last_return->fetch_assoc();
    $userID = $row_last_return['IDcliente'];

    // Query per inserire l'operazione di restituzione nel database
    $sql = "INSERT INTO operazione (IDbicicletta, IDcliente, dataInizio, tipoOperazione)
            VALUES ((SELECT ID FROM bicicletta WHERE RFID = '$rfid'), '$userID', NOW(), 'riconsegna')";

    if ($conn->query($sql) === TRUE) {
        $conn->query("UPDATE bicicletta SET stato = 'disponibile' WHERE RFID = '$rfid'");
        $response = array("messaggio" => "Bicicletta restituita con successo!");
    } else {
        $response = array("messaggio" => "Errore durante la restituzione della bicicletta: " . $conn->error);
    }
} else {
    $response = array("messaggio" => "Nessuna operazione di restituzione trovata per questa bicicletta.");
}

$conn->close();
header('Content-Type: application/json');
echo json_encode($response);
?>
