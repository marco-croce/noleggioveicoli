$(document).ready(function() {
    $('#button-search').click(function() {
        let targa = document.getElementById('veicolo-search').value;
        if(targa != "")
            loadFilteredVehicles(targa);
    });
    $('#reset-search').click(function() {
        document.getElementById('veicolo-search').value = "";
        loadFilteredVehicles("no");
    });
});

function loadFilteredVehicles(targa) {
    $.ajax({
        url: 'admin_load_vehicles.php', 
        method: 'POST',
        data: {
            targa: targa
        },
        success: function(data) {
            console.log(data);
            $('#veicoli').html(data);
        }
    });
}
