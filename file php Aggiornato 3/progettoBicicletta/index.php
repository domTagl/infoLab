<!DOCTYPE html>
<html lang="it">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard Cliente</title>
    <meta name="description" content="Dashboard per i clienti con mappa interattiva e login per clienti e dipendenti.">
    <meta name="keywords" content="dashboard, cliente, mappa, login, dipendenti">
    <!-- Collegamento alle API della mappa -->
    <link rel="stylesheet" href="https://unpkg.com/leaflet/dist/leaflet.css" />
    <script src="https://unpkg.com/leaflet/dist/leaflet.js"></script>
    <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
    <link rel="stylesheet" href="css/style.css">
</head>
<body>
<script>
    var map; // Dichiarazione globale della variabile map

    function inizializzaMappa() {
        // Imposta le opzioni della mappa
        var options = {
            center: [45.4642, 9.1900], // Coordinate di Milano, per esempio
            zoom: 12 // Livello di zoom della mappa
        };

        // Crea una nuova mappa nell'elemento con id "map"
        map = L.map('map').setView(options.center, options.zoom);

        // Aggiunge il layer della mappa
        L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
            maxZoom: 19,
            attribution: '© <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors'
        }).addTo(map);

        aggiungiTagStazioni();
    }

    function aggiungiTagStazioni(){
        console.log("aggiungiTagStazioni");
        $.post("php/getStazioneMappa.php", {}, function(stazioni) {
            stazioni.forEach(function(stazione) {
                var marker = L.marker([stazione.lat, stazione.longi]).addTo(map);
                marker.bindPopup("<b>" + stazione.nome + "</b><br>" + stazione.altro);
            });
        }, 'json');
    }

    function loginCliente() {
        window.location.href = "CLIENTE/loginCliente.php";
    }

    function loginDipendente() {
        window.location.href = "ADMIN/loginAdmin.php";
    }
</script>

<h2>Dashboard Cliente</h2>

<div id="map" style="height: 400px; width: 100%;"></div>

<div class="container">
    <div>
        <button class="button button-login-cliente" onclick="loginCliente()">Login Cliente, così puoi usufruire del servizio!</button>
        <br>
        <button class="button button-login-dipendente" onclick="loginDipendente()">Login Dipendente</button>
    </div>
</div>

<script>
    // Inizializza la mappa dopo che il DOM è completamente caricato
    document.addEventListener('DOMContentLoaded', function () {
        inizializzaMappa();
    });
</script>

</body>
</html>
