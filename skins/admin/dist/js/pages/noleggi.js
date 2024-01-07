$(document).ready(function() {
    $('#button-search').click(function() {
        let targa = document.getElementById('veicolo-search').value;
        if(targa != "")
            loadFilteredRental(targa);
    });
    $('#reset-search').click(function() {
        document.getElementById('veicolo-search').value = "";
        loadFilteredRental("no");
    });
});

function loadFilteredRental(targa) {
    $.ajax({
        url: 'admin_load_rental.php', 
        method: 'POST',
        data: {
            targa: targa
        },
        success: function(data) {
            console.log(data);
            $('#noleggi').html(data);
        }
    });
}
