<?php

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
$nome = $conn->real_escape_string($_POST['nome']);
$cognome = $conn->real_escape_string($_POST['cognome']);
$numTelefono = $conn->real_escape_string($_POST['numTelefono']);
$email = $conn->real_escape_string($_POST['email']);
$password = $conn->real_escape_string($_POST['password']);
$password_hash = password_hash($password, PASSWORD_BCRYPT);

$via = $conn->real_escape_string($_POST['via']);
$citta = $conn->real_escape_string($_POST['citta']);
$cap = $conn->real_escape_string($_POST['cap']);
$provincia = $conn->real_escape_string($_POST['provincia']);

// Supponendo che l'ID dell'utente sia passato tramite sessione
session_start();
$userID = $_SESSION['IDutente'];

// Recupera l'IDlocalita dell'utente
$result = $conn->query("SELECT IDlocalita FROM cliente WHERE ID = $userID");
if ($result->num_rows > 0) {
    $row = $result->fetch_assoc();
    $IDlocalita = $row['IDlocalita'];
} else {
    die("Errore: utente non trovato.");
}

// Query per aggiornare i dati del cliente
$sqlCliente = "UPDATE cliente SET 
                nome = '$nome', 
                cognome = '$cognome', 
                numTelefono = '$numTelefono', 
                email = '$email', 
                password = '$password_hash' 
            WHERE ID = $userID";

// Query per aggiornare i dati della località
$sqlLocalita = "UPDATE localita SET 
                via = '$via', 
                citta = '$citta', 
                cap = '$cap', 
                provincia = '$provincia' 
            WHERE ID = $IDlocalita";

if ($conn->query($sqlCliente) === TRUE && $conn->query($sqlLocalita) === TRUE) {
    $response = array("messaggio" => "Profilo aggiornato con successo!");
} else {
    $response = array("messaggio" => "Errore durante l'aggiornamento del profilo: " . $conn->error);
}

$conn->close();

// Restituisce la risposta in formato JSON
header('Content-Type: application/json');
echo json_encode($response);
?>
