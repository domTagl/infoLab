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
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        // Crea un array associativo per ogni stazione e aggiungilo all'array $stazioni
        $stazione = array(
            "lat" => $row["lat"],
            "longi" => $row["longi"],
            "nome" => $row["nome"],
            "altro" => $row["altro"]
        );
        $stazioni[] = $stazione;
    }
} else {
    echo "Nessun risultato trovato nella tabella 'stazione'";
}

echo json_encode($stazioni);

$conn->close();
?>
