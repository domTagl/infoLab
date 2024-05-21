<?php
// Connessione al database
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "biciclette";

// Connessione
$conn = new mysqli($servername, $username, $password, $dbname);

// Verifica della connessione
if ($conn->connect_error) {
    die("Connessione fallita: " . $conn->connect_error);
}

// Ricevi il nome della stazione dalla richiesta POST
$nomeStazione = $_POST['nome'];

// Esegui la query per ottenere le informazioni sulla stazione
$sqlStazione = "SELECT * FROM stazione WHERE nome = '$nomeStazione'";
$resultStazione = $conn->query($sqlStazione);

if ($resultStazione->num_rows > 0) {
    // Output dei dati della stazione
    while($row = $resultStazione->fetch_assoc()) {
        echo "<h2>Informazioni sulla stazione</h2>";
        echo "<p><strong>Nome:</strong> " . $row["nome"] . "</p>";
        echo "<p><strong>Altro:</strong> " . $row["altro"] . "</p>";
        echo "<p><strong>Slot totali:</strong> " . $row["slotTotali"] . "</p>";

        // Calcola il numero di posti liberi nella stazione
        $IDstazione = $row["ID"];
        $sqlPostiLiberi = "SELECT COUNT(*) AS postiLiberi FROM bicicletta WHERE IDstazione = '$IDstazione'";
        $resultPostiLiberi = $conn->query($sqlPostiLiberi);
        $rowPostiLiberi = $resultPostiLiberi->fetch_assoc();
        $postiLiberi = $row["slotTotali"] - $rowPostiLiberi["postiLiberi"];

        echo "<p><strong>Posti liberi:</strong> " . $postiLiberi . "</p>";
    }
} else {
    echo "Nessuna informazione trovata per questa stazione.";
}

// Chiudi la connessione al database
$conn->close();
?>
