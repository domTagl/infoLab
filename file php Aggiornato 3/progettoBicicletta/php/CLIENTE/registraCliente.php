<?php

header('Content-Type: application/json');

include 'StatoMessaggio.php';

if (!isset($_SESSION)) {
    session_start();
}

$ip = "localhost";
$root = "root";
$psw = "";
$nome_db = "biciclette";

if (
    isset($_POST['nome']) && isset($_POST['cognome']) && isset($_POST['email']) &&
    isset($_POST['numTel']) && isset($_POST['password']) && isset($_POST['via']) &&
    isset($_POST['citta']) && isset($_POST['cap']) && isset($_POST['provincia'])
) {
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
    $mysqli = new mysqli($ip, $root, $psw, $nome_db);

    // Verifica della connessione al database
    if ($mysqli->connect_error) {
        $json = new StatoMessaggio();
        $json->stato = "errore";
        $json->messaggio = "Errore di connessione al database: " . $mysqli->connect_error;
        echo json_encode($json);
        exit();
    }

    // Inserimento del domicilio nella tabella localita
    $stmt = $mysqli->prepare("INSERT INTO localita (via, citta, cap, provincia) VALUES (?, ?, ?, ?)");
    if ($stmt) {
        $stmt->bind_param("ssis", $via, $citta, $cap, $provincia);
        $stmt->execute();
        $localitaID = $stmt->insert_id;
        $stmt->close();
    } else {
        $json = new StatoMessaggio();
        $json->stato = "errore";
        $json->messaggio = "Errore nella preparazione della query per la tabella localita.";
        echo json_encode($json);
        exit();
    }

    // Inserimento del cliente nella tabella cliente
    $Password = md5($password);
    $stmt = $mysqli->prepare("INSERT INTO cliente (nome, cognome, email, numTelefono, password, IDlocalita) VALUES (?, ?, ?, ?, ?, ?)");
    if ($stmt) {
        $stmt->bind_param("sssssi", $nome, $cognome, $email, $numTel, $Password, $localitaID);
        $stmt->execute();

        // Ottenimento dell'ID utente appena inserito
        $utenteID = $stmt->insert_id;

        // Recupero dei dati dell'utente appena inserito
        $stmt->close();
        $stmt = $mysqli->prepare("SELECT * FROM cliente WHERE ID = ?");
        $stmt->bind_param("i", $utenteID);
        $stmt->execute();
        $result = $stmt->get_result();
        $utente = $result->fetch_assoc();

        $_SESSION['utente'] = $utente;
        $_SESSION['IDutente'] = $utente['ID'];

        $json = new StatoMessaggio();
        $json->stato = "successo";
        $json->messaggio = "Registrazione effettuata con successo.";
        echo json_encode($json);
        $stmt->close();
    } else {
        $json = new StatoMessaggio();
        $json->stato = "errore";
        $json->messaggio = "Errore nella preparazione della query per la tabella cliente.";
        echo json_encode($json);
        exit();
    }

    // Chiude la connessione al database
    $mysqli->close();
} else {
    // Parametri mancanti nella richiesta POST
    $json = new StatoMessaggio();
    $json->stato = "errore";
    $json->messaggio = "Parametri mancanti nella richiesta POST.";
    echo json_encode($json);
}

?>
