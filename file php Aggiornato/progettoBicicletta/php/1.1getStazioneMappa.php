<?php
header('Content-Type: application/json');

// Connessione al database
$servername = "localhost"; 
$username = "root"; 
$password = "";
$database = "biciclette"; 

// Creazione della connessione
$conn = new mysqli($servername, $username, $password, $database);
$sql = "SELECT * FROM stazione";
$result = $conn->query($sql);

$stazioni = array(); 
while (($row = $result->fetch_assoc()) != null) {
    $stazioni[] = $row;
}

echo json_encode($stazioni);

$conn->close();
?>
