<?php

header('Content-Type: application/json');

include 'StatoMessaggio.php'; // Assumo che questo file contenga la definizione della classe StatoMessaggio

if (!isset($_SESSION)) {
    session_start();
}

$ip = "localhost";
$root = "root";
$psw = "";
$nome = "dbpreverifica";

if (isset($_POST['username']) && isset($_POST['password'])) {
    $username = $_POST["username"];
    $password = $_POST["password"];

    // Connessione al database
    $mysqli = new mysqli($ip, $root, $psw, $nome);

    // Controllo credenziali dell'admin
    $stmt = $mysqli->prepare("SELECT * FROM `utente` WHERE username=? AND password=? AND isAdmin=1");
    $stmt->bind_param("ss", $username, $password);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows == 1) {
        // Admin trovato nel database
        $admin = $result->fetch_assoc();
        $_SESSION['admin'] = $admin;

        $json = new StatoMessaggio();
        $json->stato = "successo";
        $json->messaggio = "Login effettuato con successo.";
        echo json_encode($json);
    } else {
        // Credenziali non valide
        $json = new StatoMessaggio();
        $json->stato = "errore";
        $json->messaggio = "Credenziali non valide.";
        echo json_encode($json);
    }
} else {
    // Parametri mancanti nella richiesta POST
    $json = new StatoMessaggio();
    $json->stato = "errore";
    $json->messaggio = "Parametri mancanti nella richiesta POST.";
    echo json_encode($json);
}

?>
