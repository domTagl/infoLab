<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "biciclette";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connessione al database fallita: " . $conn->connect_error);
}

// Query per ottenere le biciclette noleggiate da più di un giorno
$sqlBiciNoleggiate = "
    SELECT 
        bicicletta.ID, 
        bicicletta.RFID, 
        bicicletta.IDstazione, 
        bicicletta.longi,
        bicicletta.lat,
        DATEDIFF(NOW(), operazione.dataOperazione) as giorniNoleggio
    FROM bicicletta
    JOIN operazione ON bicicletta.ID = operazione.IDbicicletta
    WHERE operazione.tipoOperazione = 'noleggio'
    HAVING giorniNoleggio > 1
";

$resultBiciNoleggiate = $conn->query($sqlBiciNoleggiate);

$biciclette = [];

if ($resultBiciNoleggiate->num_rows > 0) {
    while ($row = $resultBiciNoleggiate->fetch_assoc()) {
        $biciclette[] = [
            'ID' => $row['ID'],
            'RFID' => $row['RFID'],
            'IDstazione' => $row['IDstazione'],
            'longi' => $row['longi'],
            'lat' => $row['lat'],
            'giorniNoleggio' => $row['giorniNoleggio']
        ];
    }
    header('Content-Type: application/json');
    echo json_encode($biciclette);
} else {
    echo json_encode([]);
}

$conn->close();
?>
