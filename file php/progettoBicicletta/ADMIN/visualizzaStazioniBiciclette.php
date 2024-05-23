<!DOCTYPE html>
<html lang="it">
<head>
    <meta charset="UTF-8">
    <title>Visualizza Stazioni e Biciclette</title>
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.7.1/dist/leaflet.css" />
    <link rel="stylesheet" href="../css/style3.css">
    <link rel="stylesheet" href="../css/style2.css">
    <style>
        #map {
            height: 600px;
        }
        .info {
            margin: 20px;
        }
    </style>
</head>
<body>
    <div class="info">
        <h1>Stazioni e Biciclette in Tempo Reale</h1>
    </div>
    <div id="map"></div>
    <div class="container">
    <h3>click su bici per vedere dettagli (i colori rappresentano lo stato della bici)<br>
    rosso -> noleggiata<br>
    verde -> disponibile<br>
    grigia -> manutenzione<br>    </div>
    </div>

    <script src="https://unpkg.com/leaflet@1.7.1/dist/leaflet.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
    <script>
        var map;
        var markers = {
            stazioni: [],
            biciclette: []
        };

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

            // Aggiunge i marker iniziali
            updateMarkers();
        }

        function updateMarkers() {
            $.post("../php/getStazioneBiciMappa.php", {}, function(response) {
                if (response.success) {
                    // Rimuove i marker esistenti
                    markers.stazioni.forEach(function(marker) {
                        map.removeLayer(marker);
                    });
                    markers.biciclette.forEach(function(marker) {
                        map.removeLayer(marker);
                    });
                    markers.stazioni = [];
                    markers.biciclette = [];

                    // Aggiunge i marker delle stazioni
                    response.stazioni.forEach(function(stazione) {
                        var marker = L.marker([stazione.lat, stazione.longi]).addTo(map);
                        marker.bindPopup("<b>" + stazione.nome + "</b><br>" + stazione.altro);
                        markers.stazioni.push(marker);
                    });

                    // Aggiunge i marker delle biciclette
                    response.biciclette.forEach(function(bicicletta) {
                        var marker = L.marker([bicicletta.lat, bicicletta.longi], {icon: getBiciclettaIcon(bicicletta.stato)}).addTo(map);
                        marker.bindPopup("<b>Bicicletta RFID: " + bicicletta.RFID + "</b><br>Stato: " + bicicletta.stato);
                        markers.biciclette.push(marker);
                    });
                } else {
                    alert(response.message);
                }
            }, 'json');
        }

        function getBiciclettaIcon(stato) {
            var iconUrl;
            if (stato === "disponibile") {
                iconUrl = 'icons/bike-green.png'; // Cambia con il percorso della tua icona
            } else if (stato === "noleggiata") {
                iconUrl = 'icons/bike-red.png'; // Cambia con il percorso della tua icona
            } else {
                iconUrl = 'icons/bike-gray.png'; // Cambia con il percorso della tua icona
            }

            return L.icon({
                iconUrl: iconUrl,
                iconSize: [25, 25], // dimensioni icona
                iconAnchor: [12, 25], // punto dell'icona che corrisponde alla posizione del marker
                popupAnchor: [0, -25] // punto da cui la popup si apre in relazione all'iconAnchor
            });
        }

        $(document).ready(function() {
            initializeMap();
            setInterval(updateMarkers, 30000); // Aggiorna ogni 30 secondi
        });
    </script>
</body>
</html>
