<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "biciclette";

echo("SEI NELLA STAZIONE: ");
echo($_GET['stazione']);
echo("<br>");

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
        echo "<br>codice carta Comune se si vuole prenotare una bici <br>";
        echo "<input type=\"text\" id=\"codiceCartaComune\" name=\"codiceCartaComune\" required><br>";
        $counter = 0;
        while($row = $resultStazione->fetch_assoc()) {
            $counter++;

            echo "<p><strong>SLOT numero '$counter'</strong></p>";
            echo "<p><strong>Stato Slot:</strong> " . $row["stato"] . "</p>";
            if($row["stato"] == "Disponibile"){
                echo "<button id=\"bottoneRFID\" value=\" " . $row["RFID"] . "\">". "prenota la bicicletta" ."</button>";
            }
        }

        echo "<br> inserire RFID della bici<br>";
        echo "<input type=\"text\" id=\"RFID\" name=\"RFID\" required><br>";
        $var = 50 - $counter;
        for($i = 0; $i < $var; $i++){
            $counter++;
            echo "<p><strong>SLOT numero '$counter'</strong></p>";
            echo "<p><strong>Stato Slot:</strong> " . "vuoto -bici non disponibile-" . "</p>";
            echo "<button id=\"bottonePostoLibero\" onclick=\"bottonePostoLibero()\">". "posizione bici" ."</button>";
        }

    } else {
        echo "<br>Nessuna informazione trovata per questa stazione.<br>";
    }

    $conn->close();
}
?>
