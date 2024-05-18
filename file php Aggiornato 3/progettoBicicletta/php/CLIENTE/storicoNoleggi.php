<?php
header('Content-Type: application/json');

$ip = "localhost";
$root = "root";
$psw = "";
$nome = "biciclette";

$sql = "SELECT operazione.*, transizioni.importo, transizioni.motivo FROM operazione LEFT JOIN transizioni ON operazione.ID = transizioni.IDcliente WHERE operazione.IDcliente = ?";
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
        "tariffa" => $row['tariffa'],
        "transizione" => "Importo: " . $row['importo'] . ", Motivo: " . $row['motivo']
    );
    $storicoNoleggi[] = $noleggio;
}

echo json_encode($storicoNoleggi);
?>
