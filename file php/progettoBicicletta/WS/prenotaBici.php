<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "biciclette";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die(json_encode(array("success" => false, "message" => "Connessione al database fallita: " . $conn->connect_error)));
}

$cartaComunale = intval($_POST['cartaComunale']);
$RFID = intval($_POST['RFID']);
$azione = $conn->real_escape_string($_POST['azione']); // "noleggia" o "restituisci"

// Verifica cliente
$sqlCliente = "SELECT ID FROM cliente WHERE cartaComunale = $cartaComunale";
$resultCliente = $conn->query($sqlCliente);

if ($resultCliente->num_rows > 0) {
    $rowCliente = $resultCliente->fetch_assoc();
    $IDcliente = $rowCliente['ID'];

    if ($azione == "noleggia") {
        // Verifica bicicletta
        $sqlBici = "SELECT ID, IDstazione, stato FROM bicicletta WHERE RFID = $RFID AND stato = 'disponibile'";
        $resultBici = $conn->query($sqlBici);

        if ($resultBici->num_rows > 0) {
            $rowBici = $resultBici->fetch_assoc();
            $IDbicicletta = $rowBici['ID'];
            $IDstazione = $rowBici['IDstazione'];

            // Aggiorna stato bicicletta
            $sqlUpdateBici = "UPDATE bicicletta SET stato = 'noleggiata', IDstazione = NULL WHERE ID = $IDbicicletta";
            $conn->query($sqlUpdateBici);

            // Aggiorna numero slot disponibili nella stazione
            $sqlUpdateStazione = "UPDATE stazione SET slotTotali = slotTotali - 1 WHERE ID = $IDstazione";
            $conn->query($sqlUpdateStazione);

            // Registra operazione
            $sqlOperazione = "INSERT INTO operazione (IDbicicletta, IDcliente, dataOperazione, tipoOperazione) VALUES ($IDbicicletta, $IDcliente, NOW(), 'noleggio')";
            $conn->query($sqlOperazione);

            echo json_encode(array("success" => true, "message" => "Bicicletta noleggiata con successo."));
        } else {
            echo json_encode(array("success" => false, "message" => "Bicicletta non disponibile o già noleggiata."));
        }
    } else {
        echo json_encode(array("success" => false, "message" => "Azione non valida."));
    }
} else {
    echo json_encode(array("success" => false, "message" => "Cliente non trovato."));
}

$conn->close();
?>
