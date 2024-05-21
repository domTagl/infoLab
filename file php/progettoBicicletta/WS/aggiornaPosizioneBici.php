<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "biciclette";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connessione al database fallita: " . $conn->connect_error);
}

$sql = "SELECT ID, longi, lat, metri FROM bicicletta WHERE stato = 'noleggiata'";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $ID = $row['ID'];
        $longi = $row['longi'];
        $lat = $row['lat'];
        $metri = $row['metri'];

        // Simulazione del movimento
        $nuovaLongi = $longi + (rand(-5, 5) / 10000);
        $nuovaLat = $lat + (rand(-5, 5) / 10000);
        $nuoviMetri = $metri + rand(50, 200);

        // Aggiornamento del database
        $sqlUpdate = "UPDATE bicicletta SET longi = $nuovaLongi, lat = $nuovaLat, metri = $nuoviMetri WHERE ID = $ID";
        $conn->query($sqlUpdate);
    }
}

$conn->close();
?>
