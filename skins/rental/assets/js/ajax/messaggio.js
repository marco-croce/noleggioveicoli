$(document).ready(function() {
    $('#form').submit(function(e) {
        e.preventDefault();
        invia();
    });
    $('#nome, #cognome, #email1, #oggetto, #testo').on("click", function() {
        $('#label').html("");
    });
});

function invia() {
    let nome = $('#nome').val();
    let cognome = $('#cognome').val();
    let email = $('#email1').val();
    let oggetto = $('#oggetto').val();
    let messaggio =  $('#testo').val();

    $.ajax({
        url: 'message.php', 
        method: 'POST',
        data: {
            nome: nome,
            cognome: cognome,
            email: email,
            oggetto: oggetto,
            messaggio: messaggio
        },
        success: function() {
            $('#label').html("<span class='bi bi-check h1 text-success'></span>Invio effettuato");
            $('#form')[0].reset();
        }
    });
}