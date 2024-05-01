<?php

header('Content-Type: application/json');

include 'StatoMessaggio.php'; 

if (!isset($_SESSION)) {
    session_start();
}

$ip = "localhost";
$root = "root";
$psw = "";
$nome = "dbpreverifica";

if (isset($_POST['nome']) && isset($_POST['cognome']) && isset($_POST['email']) && isset($_POST['numTel']) && isset($_POST['password']) && isset($_POST['via']) && isset($_POST['citta']) && isset($_POST['cap']) && isset($_POST['provincia'])) {
    $nome = $_POST["nome"];
    $cognome = $_POST["cognome"];
    $email = $_POST["email"];
    $numTel = $_POST["numTel"];
    $password = $_POST["password"];
    $via = $_POST["via"];
    $citta = $_POST["citta"];
    $cap = $_POST["cap"];
    $provincia = $_POST["provincia"];

    // Connessione al database
    $mysqli = new mysqli($ip, $root, $psw, $nome);

    // Inserimento del domicilio nella tabella localita
    $stmt = $mysqli->prepare("INSERT INTO localita (via, citta, cap, provincia) VALUES (?, ?, ?, ?)");
    $stmt->bind_param("ssis", $via, $citta, $cap, $provincia);
    $stmt->execute();

    // Ottieni l'ID della località appena inserita
    $localitaID = $stmt->insert_id;

    // Inserimento del cliente nella tabella cliente
    $stmt = $mysqli->prepare("INSERT INTO cliente (nome, cognome, email, numTelefono, password, IDlocalita) VALUES (?, ?, ?, ?, ?, ?)");
    $stmt->bind_param("sssssi", $nome, $cognome, $email, $numTel, $password, $localitaID);
    $stmt->execute();

    $json = new StatoMessaggio();
    $json->stato = "successo";
    $json->messaggio = "Registrazione effettuata con successo.";
    echo json_encode($json);
} else {
    // Parametri mancanti nella richiesta POST
    $json = new StatoMessaggio();
    $json->stato = "errore";
    $json->messaggio = "Parametri mancanti nella richiesta POST.";
    echo json_encode($json);
}

?>
