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

    <link rel="stylesheet" href="../../css/style.css">
</head>
<body>

<script>

    //controllo sessione
    $( document ).ready(function() {
        $.post("../../session/getSession.php", {}, function (data) {
            console.log("ciaoioo");
            console.log(data);
        });
        
        $.post("../../session/controlloSessioneCliente.php", {}, function (data) {
            console.log(data);
            if(data == 404){
                window.location.href = "../../index.php"; 
            }
        });
    });


    var map;
    var selectedStation = null; // Variabile per salvare il nome della stazione selezionata

    function initializeMap() {
        // Impostazioni della mappa
        var options = {
            center: [45.4642, 9.1900], // Coordinate di Milano
            zoom: 12
        };

        // Crea la mappa
        map = L.map('map', options);

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
        $.post("../../php/getStazioneMappa.php", {}, function (stazioni) {
            stazioni.forEach(function (stazione) {
                var marker = L.marker([stazione.lat, stazione.longi]).addTo(map);
                marker.bindPopup("<b>" + stazione.nome + "</b><br>" + stazione.altro);

                marker.on('click', function (e) {
                    selectedStation = stazione.nome; // Salva il nome della stazione selezionata
                    $.post("../../php/visualizzaInfoStazione.php", { nome: selectedStation }, function (data) {
                        $("#infoStazione").html(data);
                    });
                });

            });
        }, 'json');
    }

    function effettuaPrenotazione() {
        if (selectedStation) {
            window.location.href = "effettuaPrenotazione.php?stazione=" + encodeURIComponent(selectedStation);
        } else {
            alert("Seleziona prima una stazione cliccando su un marker sulla mappa.");
        }
    }

    function visualizzaStorico() {
        window.location.href = "../personali/storicoNoleggi.php";
    }

    function aggiornaProfilo() {
        window.location.href = "../personali/aggiornaProfilo.php";
    }

    function statisticheProfilo() {
        window.location.href = "../personali/statisticheProfilo.php";
    }

    // Inizializza la mappa quando il DOM è completamente caricato
    document.addEventListener('DOMContentLoaded', function () {
        initializeMap();
    });
</script>

<h2>Dashboard Cliente</h2> 
<nav>
    <ul>
        <li><a href="../../session/logout.php?redirect=../index.php">LOGOUT</a></li>
    </ul>
</nav>

<div id="map" style="height: 400px; width: 100%;"></div>

<div class="container">
    <div>
        <button onclick="effettuaPrenotazione()">Scegli una stazione ed effettuare una prenotazione</button><br>
        <button onclick="visualizzaStorico()">Visualizzare lo storico dei noleggi effettuati</button><br>
        <button onclick="aggiornaProfilo()">Aggiornare le informazioni del profilo utente</button><br>
        <button onclick="statisticheProfilo()">Tutte le tue statistiche riguardante te</button>
    </div>
<br>



<h2>INFORMAZIONI STAZIONE: (click market poi scorri in basso)</h2>
</div>
<div class="container">
    <div id="infoStazione">
        <!-- Qui verranno visualizzate le informazioni sulla stazione -->
    </div>
</div>




</body>
</html>
