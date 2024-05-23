<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "biciclette";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connessione al database fallita: " . $conn->connect_error);
}

$sqlStatistiche = "
    SELECT 
        cliente.ID, 
        cliente.nome, 
        cliente.cognome, 
        COUNT(operazione.ID) as totaleNoleggi, 
        SUM(CASE WHEN operazione.tipoOperazione = 'noleggio' THEN 1 ELSE 0 END) as noleggiEffettuati,
        SUM(CASE WHEN operazione.tipoOperazione = 'restituzione' THEN 1 ELSE 0 END) as restituzioniEffettuate,
        SUM(transizioni.importo) as speseTotali
    FROM cliente
    LEFT JOIN operazione ON cliente.ID = operazione.IDcliente
    LEFT JOIN transizioni ON cliente.ID = transizioni.IDcliente
    GROUP BY cliente.ID
";

$resultStatistiche = $conn->query($sqlStatistiche);

if ($resultStatistiche->num_rows > 0) {
    echo "<table border='1'>";
    echo "<tr><th>ID Cliente</th><th>Nome</th><th>Cognome</th><th>Totale Noleggi</th><th>Noleggi Effettuati</th><th>Restituzioni Effettuate</th><th>Spese Totali</th></tr>";
    while ($row = $resultStatistiche->fetch_assoc()) {
        echo "<tr>
                <td>" . htmlspecialchars($row['ID']) . "</td>
                <td>" . htmlspecialchars($row['nome']) . "</td>
                <td>" . htmlspecialchars($row['cognome']) . "</td>
                <td>" . htmlspecialchars($row['totaleNoleggi']) . "</td>
                <td>" . htmlspecialchars($row['noleggiEffettuati']) . "</td>
                <td>" . htmlspecialchars($row['restituzioniEffettuate']) . "</td>
                <td>€" . htmlspecialchars($row['speseTotali']) . "</td>
              </tr>";
    }
    echo "</table>";
} else {
    echo "Nessuna informazione trovata.";
}

$conn->close();
?>
