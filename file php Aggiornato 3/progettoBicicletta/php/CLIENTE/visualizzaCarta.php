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

// Supponendo che l'ID dell'utente sia passato tramite sessione
$userID = $_SESSION['IDutente'];

// Query per recuperare il numero della carta
$sql = "SELECT carta FROM cliente WHERE ID = $userID";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    $row = $result->fetch_assoc();
    $numeroCarta = substr($row['carta'], 0, 4) . str_repeat('*', 12); // Mostra solo le prime 4 cifre
    $response = array("numeroCarta" => $numeroCarta);
} else {
    $response = array("numeroCarta" => "****");
}

$conn->close();

// Restituisce la risposta in formato JSON
header('Content-Type: application/json');
echo json_encode($response);
?>
