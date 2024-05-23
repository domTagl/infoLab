<!DOCTYPE html>
<html lang="it">
<head>
    <title>dashboardAdmin</title>
    <link rel="stylesheet" href="../css/style2.css">
</head>
<body>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>

<script>
    //controllo sessione
    $( document ).ready(function() {
        $.post("../session/getSession.php", {}, function (data) {
            console.log("ciaoioo");
            console.log(data);
        });
        
        $.post("../session/controlloSessioneDipendente.php", {}, function (data) {
            console.log(data);
            if(data == 404){
                window.location.href = "../index.php"; 
            }
        });
    });

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
    function informazioniBicicletta() {
        window.location.href = "bicicletta/informazioniBicicletta.php"; 
    };

    function statisticheBici() {
        window.location.href = "biciNoleggiate.php"; 
    };
    function statisticheCliente() {
        window.location.href = "statisticheClienti.php"; 
    };
</script>
<div class="container">

<h1>MAPPA BICI/STAZIONE in tempo reale</h1>
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
<br><button type="button" onclick="informazioniBicicletta()">informazioni di tutte le biciclette</button>

<h1>STATISTICHE VARIE BICI/CLIENTI</h1>
<br><button type="button" onclick="statisticheBici()">statistiche bici (tipo bici noleggiate da più di un gg)</button>
<br><button type="button" onclick="statisticheCliente()">statistiche cliente</button>

<nav>
    <ul>
        <li><a href="../session/logout.php?redirect=../index.php">LOGOUT</a></li>
    </ul>
</nav>

<p id="responseMessage"></p>
</div>
</body>
</html>
