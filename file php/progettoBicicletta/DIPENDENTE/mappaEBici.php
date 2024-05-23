<!DOCTYPE html>
<html lang="it">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Bici in Manutenzione</title>
    <link rel="stylesheet" href="https://unpkg.com/leaflet/dist/leaflet.css" />
    <script src="https://unpkg.com/leaflet/dist/leaflet.js"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <link rel="stylesheet" href="../css/style2.css">
    <link rel="stylesheet" href="../css/style3.css">
    <style>
        #map {
            height: 500px;
        }
        #infoStazione {
            margin-top: 20px;
        }
        table {
            width: 100%;
            border-collapse: collapse;
        }
        table, th, td {
            border: 1px solid black;
        }
        th, td {
            padding: 10px;
            text-align: left;
        }
    </style>
</head>
<body onload="initializeMap()">

<nav>
    <ul>
        <li><a href="../session/logout.php?redirect=../index.php">LOGOUT</a></li>
    </ul>
</nav>

    <h1>Bici in Manutenzione</h1>
    <div id="map"></div>
    <div id="infoStazione"></div>
    <div id="biciRotte">
<div class="container">
        <h2>Bici in Manutenzione</h2>
        <table id="biciTable">
            <thead>
                <tr>
                    <th>RFID</th>
                    <th>stato</th>
                    <th>longi</th>
                    <th>lat</th>
                </tr>
            </thead>
            <tbody>
                <!-- javaScript -->
            </tbody>
        </table>
    </div>
</div>

    <script>
        var map;
        var selectedStation = null;

        function initializeMap() {
            var options = {
                center: [45.4642, 9.1900], 
                zoom: 12
            };
            map = L.map('map', options);
            L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
                maxZoom: 19,
                attribution: '© <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors'
            }).addTo(map);
            addStationMarkers();
        }

        function addStationMarkers() {
            console.log("addStationMarkers");
            $.post("../php/getStazioneMappa.php", {}, function (stazioni) {
                stazioni.forEach(function (stazione) {
                    var marker = L.marker([stazione.lat, stazione.longi]).addTo(map);
                    marker.bindPopup("<b>" + stazione.nome + "</b><br>" + stazione.altro);
                    marker.on('click', function (e) {
                        selectedStation = stazione.nome; 
                        $.post("../../php/visualizzaInfoStazione.php", { nome: selectedStation }, function (data) {
                            $("#infoStazione").html(data);
                        });
                    });
                });
            }, 'json');
        }

        function loadBiciRotte() {
            $.post("../php/DIPENDENTE/getBiciInManutenzione.php", {}, function (bici) {
                var tableBody = $("#biciTable tbody");
                tableBody.empty();
                bici.forEach(function (bici) {
                    var row = `<tr>
                        <td>${bici.RFID}</td>
                        <td>${bici.stato}</td>
                        <td>${bici.longi}</td>
                        <td>${bici.lat}</td>
                    </tr>`;
                    tableBody.append(row);
                });
            }, 'json');
        }

        $(document).ready(function () {
            loadBiciRotte();
        });
    </script>
</body>
</html>
