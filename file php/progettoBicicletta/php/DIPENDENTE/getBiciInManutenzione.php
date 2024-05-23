<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "biciclette";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die(json_encode(array("success" => false, "message" => "Connessione al database fallita: " . $conn->connect_error)));
}


$query = "SELECT * FROM bicicletta WHERE stato = 'Manutenzione'";
$result = $conn->query($query);

$bici = array();
while ($row = $result->fetch_assoc()) {
    $bici[] = $row;
}

echo json_encode($bici);
?>
