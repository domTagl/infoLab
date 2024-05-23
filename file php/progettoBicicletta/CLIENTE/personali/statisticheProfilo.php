<?php
session_start();

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "biciclette";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connessione al database fallita: " . $conn->connect_error);
}

$clienteID = $_SESSION['IDutente'];

// Query per ottenere le statistiche dei noleggi
$sqlNoleggi = "SELECT COUNT(*) as totaleNoleggi, SUM(TIMESTAMPDIFF(HOUR, dataOperazione, dataOperazione)) as oreTotali FROM operazione WHERE IDcliente = $clienteID AND tipoOperazione = 'noleggio'";
$resultNoleggi = $conn->query($sqlNoleggi);
$rowNoleggi = $resultNoleggi->fetch_assoc();

// Query per ottenere le spese totali
$sqlSpese = "SELECT SUM(importo) as speseTotali FROM transizioni WHERE IDcliente = $clienteID AND TipoTransizione = 'pagamento'";
$resultSpese = $conn->query($sqlSpese);
$rowSpese = $resultSpese->fetch_assoc();

// Query per ottenere la data del primo e ultimo noleggio
$sqlDate = "SELECT MIN(dataOperazione) as primoNoleggio, MAX(dataOperazione) as ultimoNoleggio FROM operazione WHERE IDcliente = $clienteID AND tipoOperazione = 'noleggio'";
$resultDate = $conn->query($sqlDate);
$rowDate = $resultDate->fetch_assoc();

$conn->close();
?>

<!DOCTYPE html>
<html lang="it">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Statistiche Noleggi</title>
    <link rel="stylesheet" href="../../css/style3.css">
</head>
<body>
    <div class="container">
        <h1>Statistiche Noleggi</h1>
        <p><strong>Numero totale di noleggi:</strong> <?php echo $rowNoleggi['totaleNoleggi']; ?></p>
        <p><strong>Ore totali di utilizzo:</strong> <?php echo $rowNoleggi['oreTotali']; ?> ore</p>
        <p><strong>Spese totali:</strong> €<?php echo $rowSpese['speseTotali']; ?></p>
        <p><strong>Data del primo noleggio:</strong> <?php echo $rowDate['primoNoleggio']; ?></p>
        <p><strong>Data dell'ultimo noleggio:</strong> <?php echo $rowDate['ultimoNoleggio']; ?></p>
    </div>
</body>
</html>
