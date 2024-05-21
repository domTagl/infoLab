<!DOCTYPE html>
<html lang="it">
<head>
    <title>dashboardAdmin</title>
    <link rel="stylesheet" href="../css/style2.css">
</head>
<body>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>

<script>
    function BICISTAZIONE() {
        window.location.href = "visualizzaStazioniBiciclette.php"; 
    };

    function aggiungiStazione() {
        window.location.href = "stazione/aggiungiStazione.php"; 
    };
    function rimuoviStazione() {
        window.location.href = "stazione/rimuoviStazione.php"; 
    };
    function modificaStazione() {
        window.location.href = "stazione/modificaStazione.php"; 
    };
    
    function aggiungislotStazione() {
        window.location.href = "slotStazione/aggiungiSlot.php"; 
    };
    function rimuovislotStazione() {
        window.location.href = "slotStazione/rimuoviSlot.php"; 
    };
    function modificaslotStazione() {
        window.location.href = "slotStazione/modificaSlot.php"; 
    };

    function aggiungiBicicletta() {
        window.location.href = "bicicletta/aggiungiBicicletta.php"; 
    };
    function rimuoviBicicletta() {
        window.location.href = "bicicletta/rimuoviBicicletta.php"; 
    };
    function modificaBicicletta() {
        window.location.href = "bicicletta/modificaBicicletta.php"; 
    };
</script>
<div class="container">

<h1>MAPPA BICI/STAZIONE</h1>
<br><button type="button" onclick="BICISTAZIONE()">MAPPA BICI/STAZIONE</button>

<h1>STAZIONE</h1>
<br><button type="button" onclick="aggiungiStazione()">aggiungi Stazione</button>
<br><button type="button" onclick="rimuoviStazione()">rimuovi Stazione</button>
<br><button type="button" onclick="modificaStazione()">modifica Stazione</button>

<h1>SLOT STAZIONE</h1>
<br><button type="button" onclick="aggiungislotStazione()">aggiungi slot Stazione</button>
<br><button type="button" onclick="rimuovislotStazione()">rimuovi slot Stazione</button>
<br><button type="button" onclick="modificaslotStazione()">modifica slot Stazione</button>

<h1>BICICLETTA</h1>
<br><button type="button" onclick="aggiungiBicicletta()">aggiungi Bicicletta</button>
<br><button type="button" onclick="rimuoviBicicletta()">rimuovi Bicicletta</button>
<br><button type="button" onclick="modificaBicicletta()">modifica Bicicletta</button>

<p id="responseMessage"></p>
</div>
</body>
</html>
