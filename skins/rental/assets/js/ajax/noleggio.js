document.getElementById('inizio').setAttribute('min', new Date().toISOString().split("T")[0]);
let params = (new URL(document.location)).searchParams;
let inizio = params.get("inizio");
let fine = params.get("fine");
let orario = params.get("orario");
if(inizio != null && fine != null & orario != null) {
    document.getElementById('inizio').value = inizio;
    document.getElementById('fine').value = fine;
    document.getElementById('orario').value = orario;
    calcolaCosto();
    $('html, body').animate({
        scrollTop: $("#noleggio").offset().top
    }, 2000);
}

$(document).ready(function() {
    $('#inizio').on('change', function() { 
        if(document.getElementById('inizio').value != "") {
            document.getElementById('fine').setAttribute('min', document.getElementById('inizio').value);
            document.getElementById('fine').disabled = false;
        }
        else {
            document.getElementById('fine').value = "";
            document.getElementById('fine').disabled = true;
        }
    });
    $('#inizio, #fine, #orario').change(function() {
        if(document.getElementById('inizio').value != "" &&
                document.getElementById('fine').value != "" &&
                    document.getElementById('orario').value != "" )
            calcolaCosto();
        else {
            $('#label').html("");
            $('#prezzo').html("");
        }
    });
    $('#noleggio').on('submit', function(event) { 
        check(event);
    });
});

function calcolaCosto() {
    let costo = 0;
    let id = params.get("id");
    let inizio = $('#inizio').val();
    let fine = $('#fine').val();
    let[orario, minuti] = $('#orario').val().split(":");

    $.ajax({
        url: 'noleggio.php', 
        method: 'POST',
        data: {
            id: id,
            inizio: inizio,
            fine: fine,
            orario: orario,
            costo: costo
        }
    }).done(function(result) {
        $('#label').html("Il costo del noleggio è pari a €");
        $('#prezzo').html("<b>" + result + "</b>");
        });
}

function check(event) {
    let id = params.get("id");
    let inizio = $('#inizio').val();
    let fine = $('#fine').val();
    let orario = $('#orario').val();
    let costo = $('#prezzo').text();
    let logged = false;

    $.ajax({
        url: 'check_login.php', 
        method: 'POST',
        data: {
            inizio: inizio,
            fine: fine,
            orario: orario,
            id: id,
            costo: costo,
            logged: logged
        }
    }).done(function(data) {
            if (data != true) {
                $("#navbarDropdown").trigger('click');
                $('#error').html("<span class='bi bi-x h5 text-danger'></span>Effettuare l'autenticazione!");
                return;
            }
            location.href = "noleggio.php?id=" + id + "&inizio=" + inizio + "&fine=" + fine + "&orario=" + orario + "&costo=" + costo;
        });
        event.preventDefault();
    }