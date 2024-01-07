$(document).ready(function() {
    $('#login').on('submit', function(event) { 
        controlla(event);
    });
    $('#email, #password').on("click", function() {
        $('#error').html("");
    });
});

function controlla(event) {
    let email = $('#email').val();
    let password = $('#password').val();

    $.ajax({
        url: 'check_login.php', 
        method: 'POST',
        data: {
            email: email,
            password: password,
        }
    }).done(function(data) {
            if (data == 0) {
                $('#error').html("<span class='bi bi-x h5 text-danger'></span>Errore del server");
                return;
            }
            if (data == 1) {
                $('#error').html("<span class='bi bi-x h3 text-danger'></span>Credenziali errate");
                return;
            }
            if(data != " admin.php") {
                if(document.getElementById('inizio') &&
                    document.getElementById('fine') && 
                        document.getElementById('orario')) {
                    if(document.getElementById('inizio').value != "" &&
                        document.getElementById('fine').value != "" &&
                            document.getElementById('orario').value != "" ) {
                                let params = (new URL(document.location)).searchParams;
                                let id = params.get("id");
                                location.href = 'car.php?id=' + id + 
                                                        "&inizio=" + document.getElementById('inizio').value + 
                                                        "&fine=" + document.getElementById('fine').value + 
                                                        "&orario=" + document.getElementById('orario').value;
                                return;
                    }
                }       
            }     
            location.href = data;
        });
        event.preventDefault();
    }