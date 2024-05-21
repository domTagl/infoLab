<script>
    setInterval(function() {
        $.post("aggiornaPosizioneBici.php", function(data) {
            console.log("Posizione biciclette aggiornata");
        });
    }, 30000);
</script>