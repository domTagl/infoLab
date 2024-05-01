<!DOCTYPE html>
<html lang="it">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard Cliente</title>
    <!-- Collegamento alle API della mappa -->
    <script src="https://maps.googleapis.com/maps/api/js?key=TUA_API_KEY&callback=inizializzaMappa" async defer></script>
</head>
<body>
    
<script>
    // Funzione per inizializzare la mappa
    function inizializzaMappa() {
        // Imposta le opzioni della mappa
        var options = {
            center: { lat: 45.4642, lng: 9.1900 }, // Coordinate di Milano, per esempio
            zoom: 12 // Livello di zoom della mappa
        };

        // Crea una nuova mappa nell'elemento con id "map"
        var map = new google.maps.Map(document.getElementById('map'), options);
    }

    // Funzione per effettuare una prenotazione
    function effettuaPrenotazione() {
        // Reindirizza l'utente alla pagina di prenotazione
        window.location.href = "effettuaPrenotazione.php";
    }

    // Funzione per visualizzare lo storico dei noleggi
    function visualizzaStorico() {
        // Reindirizza l'utente alla pagina dello storico dei noleggi
        window.location.href = "storicoNoleggi.php";
    }

    // Funzione per aggiornare le informazioni del profilo utente
    function aggiornaProfilo() {
        // Reindirizza l'utente alla pagina di aggiornamento del profilo
        window.location.href = "aggiornaProfilo.php";
    }
</script>


<h2>Dashboard Cliente</h2>

<div id="map" style="height: 400px; width: 100%;"></div>

<div>
    <button onclick="effettuaPrenotazione()">Effettuare una prenotazione</button>
    <button onclick="visualizzaStorico()">Visualizzare lo storico dei noleggi effettuati</button>
    <button onclick="aggiornaProfilo()">Aggiornare le informazioni del profilo utente</button>
</div>

</body>
</html>
