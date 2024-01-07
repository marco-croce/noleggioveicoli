$(document).ready(function() {
    let params = (new URL(document.location)).searchParams;
    let cat = params.get("cat");
    if(cat != null) {
        loadFilteredVehicles(cat);
        document.getElementById("filtro-categoria").value = cat;
    }
    $('#filtro-marca, #filtro-cambio, #filtro-alimentazione, #filtro-categoria, #prezzo-da, #prezzo-a').change(function() {
        loadFilteredVehicles(0);
    });
});

function loadFilteredVehicles(cat) {
    let marca = $('#filtro-marca').val();
    let cambio = $('#filtro-cambio').val();
    let alimentazione = $('#filtro-alimentazione').val();
    let categoria;
    if(cat == 0)
        categoria = $('#filtro-categoria').val();
    else 
        categoria = cat;
    let prezzoDa = $('#prezzo-da').val();
    let prezzoA = $('#prezzo-a').val();

    $.ajax({
        url: 'load_vehicles.php', 
        method: 'POST',
        data: {
            marca: marca,
            cambio: cambio,
            alimentazione: alimentazione,
            categoria: categoria,
            prezzoDa: prezzoDa,
            prezzoA: prezzoA
        },
        success: function(data) {
            $('#veicoli').html(data);
        }
    });
}
