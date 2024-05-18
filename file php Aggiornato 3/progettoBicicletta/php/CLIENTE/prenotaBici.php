<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "biciclette";

// Connessione al database
$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connessione fallita: " . $conn->connect_error);
}

// Codice della carta comunale e RFID dalla richiesta POST
$codiceCartaComune = $conn->real_escape_string($_POST['codiceCartaComune']);
$rfid = $conn->real_escape_string($_POST['rfid']);

// Query per ottenere l'ID dell'utente in base al numero della carta comunale
$sql_utente = "SELECT ID FROM cliente WHERE cartaComunale = '$codiceCartaComune'";
$result_utente = $conn->query($sql_utente);

if ($result_utente && $result_utente->num_rows == 1) {
    // Estrai l'ID dell'utente
    $row_utente = $result_utente->fetch_assoc();
    $userID = $row_utente['ID'];

    // Query per inserire l'operazione di noleggio nel database
    $sql = "INSERT INTO operazione (IDbicicletta, IDcliente, dataInizio, tipoOperazione)
            SELECT ID, '$userID', NOW(), 'noleggio' FROM bicicletta WHERE RFID = '$rfid'";

    if ($conn->query($sql) === TRUE) {
        // Aggiorna lo stato della bicicletta
        $conn->query("UPDATE bicicletta SET stato = 'noleggiata' WHERE RFID = '$rfid'");
        $response = array("messaggio" => "Bicicletta prenotata con successo!");
    } else {
        $response = array("messaggio" => "Errore durante la prenotazione della bicicletta: " . $conn->error);
    }
} else {
    // Nessun utente trovato con il numero della carta comunale fornito
    $response = array("messaggio" => "Nessun utente trovato con il numero della carta comunale fornito o più di un utente trovato.");
}

// Chiudi la connessione al database
$conn->close();

// Restituisci la risposta come JSON
header('Content-Type: application/json');
echo json_encode($response);
?>
