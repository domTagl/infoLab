<?php

header('Content-Type: application/json');

include 'StatoMessaggio.php'; 

if (!isset($_SESSION)) {
    session_start();
}

$ip = "localhost";
$root = "root";
$psw = "";
$nome = "bicicletta";

if (isset($_POST['email']) && isset($_POST['password'])) {
    $email = $_POST["email"];
    $password = $_POST["password"];

    $mysqli = new mysqli($ip, $root, $psw, $nome);
    $stmt = $mysqli->prepare("SELECT * FROM `cliente` WHERE email=? AND password=?");
    $stmt->bind_param("ss", $email, $password);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows == 1) {
        // Utente trovato nel database
        $utente = $result->fetch_assoc();
        $_SESSION['utente'] = $utente;

        $json = new StatoMessaggio();
        $json->stato = "successo";
        $json->messaggio = "Login effettuato con successo";
        echo json_encode($json);
    } else {
        // Utente non trovato nel database
        $json = new StatoMessaggio();
        $json->stato = "errore";
        $json->messaggio = "Credenziali non valide";
        echo json_encode($json);
    }
} else {
    // Errore nella richiesta POST
    $json = new StatoMessaggio();
    $json->stato = "errore";
    $json->messaggio = "Errore nella richiesta POST";
    echo json_encode($json);
}

?>
