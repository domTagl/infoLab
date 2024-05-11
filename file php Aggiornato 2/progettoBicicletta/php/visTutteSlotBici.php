<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "biciclette";

echo($_GET['stazione']);
if(isset($_GET["stazione"])){
    $conn = new mysqli($servername, $username, $password, $dbname);

    if ($conn->connect_error) {
        die("Connessione fallita: " . $conn->connect_error);
    }
    
    $nomeStazione = $_GET['stazione'];
    
    $sqlStazione = "SELECT * 
                    FROM bicicletta as b
                    JOIN stazione as s ON b.IDstazione = s.ID
                    WHERE s.nome = '$nomeStazione'";
    $resultStazione = $conn->query($sqlStazione);
    if ($resultStazione->num_rows > 0) {
        $var = 50;
        $counter = 0;
        while($row = $resultStazione->fetch_assoc()) {
            $counter++;

            echo "<h2>SLOT numero '$counter'</h2>";
            echo "<p><strong>Stato Slot:</strong> " . $row["stato"] . "</p>";
        }
    } else {
        echo "<br>Nessuna informazione trovata per questa stazione.<br>";
    }

    $conn->close();
}
?>
