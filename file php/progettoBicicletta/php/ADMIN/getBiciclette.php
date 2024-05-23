<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "biciclette";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connessione al database fallita: " . $conn->connect_error);
}

$sqlBiciclette = "SELECT * FROM bicicletta";

$resultBiciclette = $conn->query($sqlBiciclette);

if ($resultBiciclette->num_rows > 0) {
    echo "<table>";
    echo "<tr><th>ID</th><th>RFID</th><th>ID Stazione</th><th>Stato</th><th>Metri Percorsi</th></tr>";
    while ($row = $resultBiciclette->fetch_assoc()) {
        echo "<tr>";
        echo "<td>" . $row["ID"] . "</td>";
        echo "<td>" . $row["RFID"] . "</td>";
        echo "<td>" . $row["IDstazione"] . "</td>";
        echo "<td>" . $row["stato"] . "</td>";
        echo "<td>" . $row["metri"] . "</td>";
        echo "</tr>";
    }
    echo "</table>";
} else {
    echo "Nessuna bicicletta trovata nel database.";
}

$conn->close();
?>
