<!DOCTYPE html>
<html lang="it">
<head>
    <link rel="stylesheet" href="css/style2.css">
</head>
<body>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>

<script>
    $(document).ready(function(){

        //ottiene in get dalla pagine precendete (1.1.mappaCliente) il nome della stazione scelta
        $.get("php/visTuttiSlotBici.php", { stazione: "<?php echo $_GET['stazione']; ?>" }, function(data) {
            console.log(data);
            $('#tuttiPostiBici').html(data);
        });


        function bottonePostoLibero() {
            //var valoreBottone = document.getElementById("bottoneRFID").value;
            alert("bottonePostoLibero");
            var RFIDbicicletta = document.getElementById("RFID").value;
            alert("RFID");
        }


    });
</script>




<div class="container">

<div class="container">
    <div id="tuttiPostiBici"></div>

    </div>
</div>


</body>
</html>
