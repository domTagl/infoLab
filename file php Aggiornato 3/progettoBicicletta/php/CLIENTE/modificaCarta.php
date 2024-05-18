<?php
session_start();
$ip = "localhost";
$root = "root";
$psw = "";
$nome = "biciclette";

// Connessione al database
$conn = new mysqli($ip, $root, $psw, $nome);

if ($conn->connect_error) {
    die("Connessione fallita: " . $conn->connect_error);
}

// Recupera i dati inviati dal form
$nuovoNumeroCarta = $conn->real_escape_string($_POST['nuovoNumeroCarta']);

// Supponendo che l'ID dell'utente sia passato tramite sessione
$userID = $_SESSION['IDutente'];

// Query per aggiornare il numero della carta
$sql = "UPDATE cliente SET carta = '$nuovoNumeroCarta' WHERE ID = $userID";

if ($conn->query($sql) === TRUE) {
    $response = array("messaggio" => "Numero di carta aggiornato con successo!");
} else {
    $response = array("messaggio" => "Errore durante l'aggiornamento del numero di carta: " . $conn->error);
}

$conn->close();

// Restituisce la risposta in formato JSON
header('Content-Type: application/json');
echo json_encode($response);
?>
