<!DOCTYPE html>
<html lang="it">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard Cliente</title>
    <!-- Collegamento alle API della mappa -->
    <link rel="stylesheet" href="https://unpkg.com/leaflet/dist/leaflet.css" />
    <script src="https://unpkg.com/leaflet/dist/leaflet.js"></script>
    <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>

    <link rel="stylesheet" href="css/style.css">
</head>
<body>
    
<script>
    var map;
    var selectedStation = null; // Variabile per salvare il nome della stazione selezionata

    function initializeMap() {
        // Impostazioni della mappa
        var options = {
            center: [45.4642, 9.1900], // Coordinate di Milano
            zoom: 12
        };

        // Crea la mappa
        map = L.map('map').setView([45.4642, 9.1900], 12);

        // Aggiunge il layer della mappa
        L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
            maxZoom: 19,
            attribution: '© <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors'
        }).addTo(map);

        // Aggiunge i marker delle stazioni
        addStationMarkers();
    }

    function addStationMarkers() {
        console.log("addStationMarkers");
        $.post("php/1.1getStazioneMappa.php", {}, function (stazioni) {
            stazioni.forEach(function (stazione) {
                var marker = L.marker([stazione.longi, stazione.lat]).addTo(map);
                marker.bindPopup("<b>" + stazione.nome + "</b><br>" + stazione.altro);

                marker.on('click', function (e) {
                    selectedStation = stazione.nome; // Salva il nome della stazione selezionata
                    $.post("php/visualizzaInfoStazione.php", { nome: selectedStation }, function (data) {
                        $("#infoStazione").html(data);
                    });
                });

            });
        }, 'json');
    }

    function effettuaPrenotazione() {
        if (selectedStation) {
            window.location.href = "1.3.1effettuaPrenotazione.php?stazione=" + encodeURIComponent(selectedStation);
        } else {
            alert("Seleziona prima una stazione cliccando su un marker sulla mappa.");
        }
    }

    function visualizzaStorico() {
        window.location.href = "1.2.1storicoNoleggi.php";
    }

    function aggiornaProfilo() {
        window.location.href = "1.2.2aggiornaProfilo.php";
    }

    // Inizializza la mappa quando il DOM è completamente caricato
    document.addEventListener('DOMContentLoaded', function () {
        initializeMap();
    });
</script>




<h2>Dashboard Cliente</h2>

<div id="map" style="height: 400px; width: 100%;"></div>

<div class="container">
    <div>
        <button onclick="effettuaPrenotazione()">Scegli una stazione ed effettuare una prenotazione</button><br>
        <button onclick="visualizzaStorico()">Visualizzare lo storico dei noleggi effettuati</button><br>
        <button onclick="aggiornaProfilo()">Aggiornare le informazioni del profilo utente</button>
    </div>
</div>

<script>
    // Inizializza la mappa dopo che il DOM è completamente caricato
    document.addEventListener('DOMContentLoaded', function () {
        inizializzaMappa();
    });
</script>

<div class="container">
    <div id="infoStazione">
        <!-- Qui verranno visualizzate le informazioni sulla stazione -->
    </div>
</div>

</body>
</html>
