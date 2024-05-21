<?php
session_start();
header('Content-Type: application/json');

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "biciclette";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die(json_encode(array("success" => false, "message" => "Connessione al database fallita: " . $conn->connect_error)));
}

$sql = "SELECT operazione.ID, operazione.dataOperazione AS dataInizio, operazione.tipoOperazione, 
               IF(operazione.tipoOperazione = 'noleggio', NULL, operazione.dataOperazione) AS dataFine, 
               transizioni.importo, transizioni.motivo 
        FROM operazione 
        LEFT JOIN transizioni ON operazione.IDcliente = transizioni.IDcliente 
        WHERE operazione.IDcliente = ? 
        ORDER BY operazione.dataOperazione DESC";

$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $_SESSION['utente']['ID']);
$stmt->execute();
$result = $stmt->get_result();

$storicoNoleggi = array();

while ($row = $result->fetch_assoc()) {
    $noleggio = array(
        "ID" => $row['ID'],
        "dataInizio" => $row['dataInizio'],
        "dataFine" => $row['dataFine'],
        "tipoOperazione" => $row['tipoOperazione'],
        "transizione" => "Importo: " . $row['importo'] . ", Motivo: " . $row['motivo']
    );
    $storicoNoleggi[] = $noleggio;
}

echo json_encode($storicoNoleggi);

$conn->close();
?>
