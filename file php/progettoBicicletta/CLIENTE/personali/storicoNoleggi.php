<!DOCTYPE html>
<html lang="it">
<head>
    <meta charset="UTF-8">
    <title>Storico Noleggi</title>
    <link rel="stylesheet" href="../../css/style2.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
</head>
<body>
    <div class="container">
        <h1>Storico Noleggi</h1>
        <table id="storicoNoleggiTable" border="1">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Data Inizio</th>
                    <th>Data Fine</th>
                    <th>Tipo Operazione</th>
                    <th>Transizione</th>
                </tr>
            </thead>
            <tbody>
                <!-- I dati verranno popolati tramite JavaScript -->
            </tbody>
        </table>
    </div>

    <script>
        $(document).ready(function() {
            $.ajax({
                url: "../../php/CLIENTE/storicoNoleggi.php",
                method: "GET",
                dataType: "json",
                success: function(data) {
                    if (data.success === false) {
                        alert(data.message);
                        return;
                    }

                    var tbody = $("#storicoNoleggiTable tbody");
                    tbody.empty();

                    data.forEach(function(noleggio) {
                        var row = "<tr>" +
                            "<td>" + noleggio.ID + "</td>" +
                            "<td>" + noleggio.dataInizio + "</td>" +
                            "<td>" + (noleggio.dataFine ? noleggio.dataFine : "In corso") + "</td>" +
                            "<td>" + noleggio.tipoOperazione + "</td>" +
                            "<td>" + noleggio.transizione + "</td>" +
                            "</tr>";
                        tbody.append(row);
                    });
                },
                error: function(jqXHR, textStatus, errorThrown) {
                    alert("Errore durante il recupero dei dati: " + textStatus);
                }
            });
        });
    </script>
</body>
</html>
