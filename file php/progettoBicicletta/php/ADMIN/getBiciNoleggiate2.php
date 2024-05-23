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
        DATEDIFF(NOW(), operazione.dataOperazione) as giorniNoleggio
    FROM bicicletta
    JOIN operazione ON bicicletta.ID = operazione.IDbicicletta
    WHERE operazione.tipoOperazione = 'noleggio'
    HAVING giorniNoleggio > 1
";

$resultBiciNoleggiate = $conn->query($sqlBiciNoleggiate);

if ($resultBiciNoleggiate->num_rows > 0) {
    echo "<table border='1'>";
    echo "<tr><th>ID Bicicletta</th><th>RFID</th><th>ID Stazione</th><th>Giorni di Noleggio</th></tr>";
    while ($row = $resultBiciNoleggiate->fetch_assoc()) {
        echo "<tr>
                <td>" . htmlspecialchars($row['ID']) . "</td>
                <td>" . htmlspecialchars($row['RFID']) . "</td>
                <td>" . htmlspecialchars($row['IDstazione']) . "</td>
                <td>" . htmlspecialchars($row['giorniNoleggio']) . "</td>
              </tr>";
    }
    echo "</table>";
} else {
    echo "Nessuna bicicletta noleggiata da più di un giorno trovata.";
}

$conn->close();
?>
