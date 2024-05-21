<?php
header('Content-Type: application/json');

// Connessione al database
$servername = "localhost"; 
$username = "root"; 
$password = "";
$database = "biciclette"; 

// Creazione della connessione
$conn = new mysqli($servername, $username, $password, $database);

if ($conn->connect_error) {
    die(json_encode(array("success" => false, "message" => "Connessione al database fallita: " . $conn->connect_error)));
}

// Recupera le stazioni
$sqlStazioni = "SELECT * FROM stazione";
$resultStazioni = $conn->query($sqlStazioni);

$stazioni = array(); 
if ($resultStazioni->num_rows > 0) {
    while ($row = $resultStazioni->fetch_assoc()) {
        $stazione = array(
            "lat" => $row["lat"],
            "longi" => $row["longi"],
            "nome" => $row["nome"],
            "altro" => $row["altro"]
        );
        $stazioni[] = $stazione;
    }
} else {
    echo json_encode(array("success" => false, "message" => "Nessuna stazione trovata"));
    exit();
}

// Recupera le biciclette
$sqlBiciclette = "SELECT * FROM bicicletta";
$resultBiciclette = $conn->query($sqlBiciclette);

$biciclette = array(); 
if ($resultBiciclette->num_rows > 0) {
    while ($row = $resultBiciclette->fetch_assoc()) {
        $bicicletta = array(
            "lat" => $row["lat"],
            "longi" => $row["longi"],
            "RFID" => $row["RFID"],
            "stato" => $row["stato"],
            "IDstazione" => $row["IDstazione"]
        );
        $biciclette[] = $bicicletta;
    }
} else {
    echo json_encode(array("success" => false, "message" => "Nessuna bicicletta trovata"));
    exit();
}

$response = array(
    "success" => true,
    "stazioni" => $stazioni,
    "biciclette" => $biciclette
);

echo json_encode($response);

$conn->close();
?>
