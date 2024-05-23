<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "biciclette";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    //riceve in post un codice ad esempio "codiceManutenzioneYGFOUI87897YFDA534G" (codice presente sulla tessera
    //che la torretta/slot può leggere)m
    //l'id della stazione e RFID della bicicletta (tutti dati che la torretta ha). il ws allora sa chi ha aggiustato 
    //il codice tramite "codiceManutenzioneYGFOUI87897YFDA534G" per esempio
    
    $codiceManutenzione = $_POST['codiceManutenzione'];
    $stazioneId = $_POST['stazioneId'];
    $RFID = $_POST['RFID'];

    // Verifica chi ha aggiustato la bici
    $query = $conn->prepare("SELECT IDutente FROM codici_manutenzione WHERE codice = ?");
    $query->bind_param("s", $codiceManutenzione);
    $query->execute();
    $result = $query->get_result();

    if ($result->num_rows > 0) {
        $dipendente = $result->fetch_assoc()['IDutente'];

        // Aggiorna lo stato della bici
        $updateQuery = $conn->prepare("UPDATE bicicletta SET stato = 'disponibile' WHERE RFID = ?");
        $updateQuery->bind_param("s", $RFID);
        $updateQuery->execute();

        // Registra la manutenzione
        $insertQuery = $conn->prepare("INSERT INTO storico_manutenzioni (IDutente, IDstazione, RFID, data_manutenzione) VALUES (?, ?, ?, NOW())");
        $insertQuery->bind_param("iis", $dipendente, $stazioneId, $RFID);
        $insertQuery->execute();

        echo "Bici riparata con successo.";
    } else {
        echo "Codice manutenzione non valido.";
    }
}
?>
