<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "biciclette";

if(isset($_GET["stazione"])) {
    $conn = new mysqli($servername, $username, $password, $dbname);

    if ($conn->connect_error) {
        die("Connessione fallita: " . $conn->connect_error);
    }

    $nomeStazione = $conn->real_escape_string($_GET['stazione']);

    $sqlStazione = "SELECT * 
                    FROM bicicletta as b
                    JOIN stazione as s ON b.IDstazione = s.ID
                    WHERE s.nome = '$nomeStazione'";
    $resultStazione = $conn->query($sqlStazione);

    if ($resultStazione->num_rows > 0) {
        echo "SEI NELLA STAZIONE: " . htmlspecialchars($nomeStazione) . "<br><br>";

        echo "Codice Carta Comune (per prenotare una bici):<br>";
        echo "<input type=\"text\" id=\"codiceCartaComune\" name=\"codiceCartaComune\" required><br><br>";
        echo "<br>Inserisci RFID della bici (per restituire):<br>";
        echo "<input type=\"text\" id=\"RFID\" name=\"RFID\" required><br><br>";
        echo "<table>";

        $counter = 0;
        while ($row = $resultStazione->fetch_assoc()) {
            $counter++;
            echo "<tr>";
            echo "<td>";
            echo "<p><strong>SLOT numero $counter</strong></p>";
            echo "<p><strong>Stato Slot:</strong> " . htmlspecialchars($row["stato"]) . "</p>";
            if ($row["stato"] == "disponibile") {
                echo "<button class=\"prenotaBici\" value=\"" . htmlspecialchars($row["RFID"]) . "\">Prenota la Bicicletta</button>";
            } elseif ($row["stato"] == "Manutenzione") {
                echo "<p><strong>Bicicletta in Manutenzione</strong></p>";
            } elseif ($row["stato"] == "noleggiata") {
                echo "<p><strong>Stato Slot:</strong> vuoto - bici non disponibile - - parcheggia la tua bici - </p>";
                echo "<button class=\"restituisciBici\" >Restitisci la Bicicletta</button>";
            }
            else{
                echo $row["stato"];
                echo $row["ID"];
                echo $row["RFID"];
            }
            echo "</td>";
            echo "</tr>";
        }

        $var = 50 - $counter;
        for($i = 0; $i < $var; $i++){
            $counter++;
            echo "<tr>";
            echo "<td>";
            echo "<p><strong>SLOT numero $counter</strong></p>";
            echo "<p><strong>Stato Slot:</strong> vuoto - bici non disponibile - - parcheggia la tua bici -</p>";
            echo "<button class=\"restituisciBici\" >Restitisci la Bicicletta</button>";
            echo "</td>";
            echo "</tr>";
        }

        echo "</table>";


    } else {
        echo "Nessuna informazione trovata per questa stazione.<br>";
    }

    $conn->close();
}
?>
