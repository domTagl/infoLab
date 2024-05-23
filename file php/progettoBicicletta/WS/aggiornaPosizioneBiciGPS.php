<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "biciclette";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connessione al database fallita: " . $conn->connect_error);
}

// Simulazione della ricezione delle coordinate GPS delle biciclette tramite un POST
// Suppongo che le coordinate GPS siano inviate come longi e lat tramite un array $_POST

// Esempio di ricezione delle coordinate GPS dalla richiesta POST
// $coordinateGPS = $_POST['coordinateGPS'];

// Simulazione delle coordinate GPS
$coordinateGPS = array(
    array('RFID' => 123456, 'longi' => 9.1900, 'lat' => 45.4642), // Esempio di coordinate per la bicicletta con RFID 123456
    array('RFID' => 789012, 'longi' => 9.2000, 'lat' => 45.4700), // Esempio di coordinate per la bicicletta con RFID 789012
    // Aggiungi altre biciclette con le relative coordinate
);

foreach ($coordinateGPS as $bicicletta) {
    $RFID = $bicicletta['RFID'];
    $longi = $bicicletta['longi'];
    $lat = $bicicletta['lat'];

    // Query per ottenere le coordinate precedenti e i metri percorsi
    $sql = "SELECT longi, lat, metri FROM bicicletta WHERE RFID = $RFID";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $longiPrecedente = $row['longi'];
        $latPrecedente = $row['lat'];
        $metriPrecedenti = $row['metri'];

        // Calcolo della distanza percorsa in linea d'aria (in metri)
        $distanza = distance($latPrecedente, $longiPrecedente, $lat, $longi);

        // Aggiornamento dei metri percorsi nel database
        $nuoviMetri = $metriPrecedenti + $distanza;
        $sqlUpdate = "UPDATE bicicletta SET longi = $longi, lat = $lat, metri = $nuoviMetri WHERE RFID = $RFID";
        $conn->query($sqlUpdate);
    }
}

$conn->close();

// Funzione per calcolare la distanza in linea d'aria tra due coordinate GPS
function distance($lat1, $lon1, $lat2, $lon2) {
    $theta = $lon1 - $lon2;
    $dist = sin(deg2rad($lat1)) * sin(deg2rad($lat2)) +  cos(deg2rad($lat1)) * cos(deg2rad($lat2)) * cos(deg2rad($theta));
    $dist = acos($dist);
    $dist = rad2deg($dist);
    $miles = $dist * 60 * 1.1515 * 1609.344; // Converti in metri
    return $miles;
}
?>
