<?php
?>

<!DOCTYPE html>
<html lang="it">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Biciclette Noleggiate da più di un Giorno</title>
    <link rel="stylesheet" href="https://unpkg.com/leaflet/dist/leaflet.css" />
    <link rel="stylesheet" href="../css/style2.css">
    <link rel="stylesheet" href="../css/style3.css">
    <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
    <script src="https://unpkg.com/leaflet/dist/leaflet.js"></script>
</head>
<body>
    <div class="container">
        <h2>Biciclette Noleggiate da più di un Giorno</h2>
        <div id="bicicletteNoleggiate">
            <!-- Qui verranno visualizzate le biciclette noleggiate da più di un giorno -->
        </div>
        <div id="map" style="height: 500px;"></div>
    </div>

    <div class="container">
        <h2>Biciclette Noleggiate da più di un Giorno</h2>
        <div id="bicicletteNoleggiate2">
            <!-- Qui verranno visualizzate le biciclette noleggiate da più di un giorno -->
        </div>
    </div>


    <script>
        var map;
        var selectedStation = null;

        function initializeMap() {
            var options = {
                center: [45.4642, 9.1900], // Coordinate di Milano
                zoom: 12
            };

            map = L.map('map', options);

            L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
                maxZoom: 19,
                attribution: '© <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors'
            }).addTo(map);

            addBikeMarkers();
        }

        function addBikeMarkers() {
            console.log("addBikeMarkers");
            $.post("../php/ADMIN/getBiciNoleggiate.php", {}, function (biciclette) {
                biciclette.forEach(function (bicicletta) {
                    var marker = L.marker([bicicletta.lat, bicicletta.longi]).addTo(map);
                    marker.bindPopup("<b>Bicicletta ID:</b> " + bicicletta.ID + "<br><b>RFID:</b> " + bicicletta.RFID + "<br><b>Giorni di Noleggio:</b> " + bicicletta.giorniNoleggio);
                });
            }, 'json');
        }

        $(document).ready(function() {
            $.post("../php/ADMIN/getBiciNoleggiate.php", {}, function(data) {
                $('#bicicletteNoleggiate').html(data);
                initializeMap();
            }).fail(function(xhr, status, error) {
                console.error(xhr.responseText);
            });

            $.post("../php/ADMIN/getBiciNoleggiate2.php", {}, function(data) {
                $('#bicicletteNoleggiate2').html(data);
            }).fail(function(xhr, status, error) {
                console.error(xhr.responseText);
            });
        });
    </script>
</body>
</html>
