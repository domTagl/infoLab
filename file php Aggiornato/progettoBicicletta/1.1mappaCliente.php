<!DOCTYPE html>
<html lang="it">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard Cliente</title>
    <!-- Collegamento alle API della mappa -->
    <link rel="stylesheet" href="https://unpkg.com/leaflet/dist/leaflet.css" />
    <script src="https://unpkg.com/leaflet/dist/leaflet.js"></script>
</head>
<body>
    
<script>

    function inizializzaMappa() {
        // Imposta le opzioni della mappa
        var options = {
            center: [45.4642, 9.1900], // Coordinate di Milano, per esempio
            zoom: 12 // Livello di zoom della mappa
        };

        // Crea una nuova mappa nell'elemento con id "map"
        var map = L.map('map').setView([45.4642, 9.1900], 12);

        // Aggiunge il layer della mappa
        L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
            maxZoom: 19,
            attribution: '© <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors'
        }).addTo(map);

        aggiungiTagStazioni();
    }

    function aggiungiTagStazioni(){
        // Effettua una richiesta AJAX per ottenere i dati delle stazioni
        var xhr = new XMLHttpRequest();
        xhr.open("GET", "php/1.1getStazioneMappa.php", true); 
        xhr.onreadystatechange = function () {
            if (xhr.readyState === 4 && xhr.status === 200) {
                // Dati delle stazioni ottenuti con successo
                var stazioni = JSON.parse(xhr.responseText);
                
                // Aggiungi un marker per ogni stazione sulla mappa
                stazioni.forEach(function(stazione) {
                    var marker = L.marker([stazione.lat, stazione.longi]).addTo(map);
                    marker.bindPopup("<b>" + stazione.nome + "</b><br>" + stazione.altro);
                });
            }
        };
        xhr.send();
    }



    function effettuaPrenotazione() {
        window.location.href = "effettuaPrenotazione.php";
    }
    function visualizzaStorico() {
        window.location.href = "storicoNoleggi.php";
    }
    function aggiornaProfilo() {
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

<script>
    // Inizializza la mappa dopo che il DOM è completamente caricato
    document.addEventListener('DOMContentLoaded', function () {
        inizializzaMappa();
    });
</script>

</body>
</html>
