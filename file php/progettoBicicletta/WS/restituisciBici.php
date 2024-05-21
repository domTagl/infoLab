<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "biciclette";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die(json_encode(array("success" => false, "message" => "Connessione al database fallita: " . $conn->connect_error)));
}

$RFID = intval($_POST['RFID']);
$IDstazione = intval($_POST['IDstazione']);

// Verifica bicicletta
$sqlBici = "SELECT ID, stato, metri FROM bicicletta WHERE RFID = $RFID AND stato = 'noleggiata'";
$resultBici = $conn->query($sqlBici);

if ($resultBici->num_rows > 0) {
    $rowBici = $resultBici->fetch_assoc();
    $IDbicicletta = $rowBici['ID'];
    $metriPercorsi = $rowBici['metri'];

    // Verifica operazione
    $sqlOperazione = "SELECT ID, IDcliente, dataOperazione FROM operazione WHERE IDbicicletta = $IDbicicletta AND tipoOperazione = 'noleggio' ORDER BY dataOperazione DESC LIMIT 1";
    $resultOperazione = $conn->query($sqlOperazione);

    if ($resultOperazione->num_rows > 0) {
        $rowOperazione = $resultOperazione->fetch_assoc();
        $IDoperazione = $rowOperazione['ID'];
        $IDcliente = $rowOperazione['IDcliente'];
        $dataInizio = new DateTime($rowOperazione['dataOperazione']);
        $dataFine = new DateTime();
        $interval = $dataInizio->diff($dataFine);
        $oreUtilizzo = $interval->h + ($interval->days * 24);

        // Calcolo costo
        $costo = $oreUtilizzo * 5; // 5 euro all'ora

        // Aggiorna stato bicicletta
        $nuovoStato = ($metriPercorsi >= 30000) ? 'manutenzione' : 'disponibile';
        $sqlUpdateBici = "UPDATE bicicletta SET stato = '$nuovoStato', IDstazione = $IDstazione WHERE ID = $IDbicicletta";
        $conn->query($sqlUpdateBici);

        // Aggiorna numero slot disponibili nella stazione
        $sqlUpdateStazione = "UPDATE stazione SET slotTotali = slotTotali + 1 WHERE ID = $IDstazione";
        $conn->query($sqlUpdateStazione);

        // Registra operazione di restituzione
        $sqlOperazioneRestituzione = "INSERT INTO operazione (IDbicicletta, IDcliente, dataOperazione, tipoOperazione) VALUES ($IDbicicletta, $IDcliente, NOW(), 'riconsegna')";
        $conn->query($sqlOperazioneRestituzione);

        // Registra transazione
        $sqlTransazione = "INSERT INTO transizioni (IDcliente, TipoTransizione, importo, motivo) VALUES ($IDcliente, 'pagamento', $costo, 'noleggio bici')";
        $conn->query($sqlTransazione);

        echo json_encode(array("success" => true, "message" => "Bicicletta restituita con successo."));
    } else {
        echo json_encode(array("success" => false, "message" => "Operazione di noleggio non trovata."));
    }
} else {
    echo json_encode(array("success" => false, "message" => "Bicicletta non trovata o non in noleggio."));
}

$conn->close();
?>
