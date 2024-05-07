<!DOCTYPE html>
<html lang="it">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Storico Noleggi</title>
    <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
</head>

<body>

    <script>
        $(document).ready(function() {
            $.get("ajax/storicoNoleggi.php", {}, function(response) {
                // creazione dinamica 
                $.each(response, function(index, noleggio) {
                    var row = "<tr>" +
                        "<td>" + noleggio.ID + "</td>" +
                        "<td>" + noleggio.dataInizio + "</td>" +
                        "<td>" + noleggio.dataFine + "</td>" +
                        "<td>" + noleggio.tariffa + "</td>" +
                        "<td>" + noleggio.transizione + "</td>" +
                        "</tr>";
                    $('#tbodyNoleggi').append(row);
                });
            })
        });
    </script>

    <h2>Storico Noleggi</h2>

    <table>
        <thead>
            <tr>
                <th>ID Noleggio</th>
                <th>Data Inizio</th>
                <th>Data Fine</th>
                <th>Tariffa</th>
                <th>Transizione</th>
            </tr>
        </thead>
        <tbody id="tbodyNoleggi">
            <!-- Qui verranno inseriti dinamicamente i noleggi -->
        </tbody>
    </table>

</body>
</html>