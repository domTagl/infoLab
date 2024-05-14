<?php
include 'config.php';

// Controlla se l'utente è autenticato, altrimenti reindirizza alla pagina di login
// Includi anche tutte le altre operazioni necessarie per controllare l'autenticazione

// Ottieni i dati inviati dal form
$nome = $_POST['nome'];
$cognome = $_POST['cognome'];
$domicilio = $_POST['domicilio'];
$numTelefono = $_POST['numTelefono'];
$email = $_POST['email'];
$password = md5($_POST['password']); // Assumendo che la password sia stata inviata in forma criptata MD5

// Aggiorna le informazioni del profilo utente nel database
$sql = "UPDATE cliente SET nome=?, cognome=?, domicilio=?, numTelefono=?, email=?, password=? WHERE ID=?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("ssssssi", $nome, $cognome, $domicilio, $numTelefono, $email, $password, $_SESSION['utente']['ID']); // Supponendo che $_SESSION['utente']['ID'] contenga l'ID del cliente autenticato
$stmt->execute();

// Verifica se l'aggiornamento è stato eseguito correttamente
if ($stmt->affected_rows > 0) {
    // Invia una risposta JSON di successo
    $response = array("success" => true, "messaggio" => "Profilo aggiornato con successo.");
    echo json_encode($response);
} else {
    // Invia una risposta JSON di errore
    $response = array("success" => false, "messaggio" => "Si è verificato un errore durante l'aggiornamento del profilo.");
    echo json_encode($response);
}

$stmt->close();
$conn->close();
?>
