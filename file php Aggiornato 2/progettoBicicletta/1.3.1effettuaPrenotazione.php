<!DOCTYPE html>
<html lang="it">
<head>
    <link rel="stylesheet" href="css/style.css">
</head>
<body>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>

<script>
    $(document).ready(function(){

        //ottiene in get dalla pagine precendete (1.1.mappaCliente) il nome della stazione scelta
        $.get("php/visTutteSlotBici.php", { stazione: "<?php echo $_GET['stazione']; ?>" }, function(data) {
            console.log(data);
            $('#tuttiPostiBici').html(data);

            
        });





    });
</script>




<div class="container">

<h2>sei andato in una stazione "fisicamente" ed ora devi avvicianare la tua tessera al lettore per prendere la bicicletta
</h2>

<div class="container">
    <div id="tuttiPostiBici"></div>

    </div>
</div>


</body>
</html>
