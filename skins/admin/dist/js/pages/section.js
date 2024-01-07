$(document).ready(function() {
    onSelectLoad();
});

function onSelectLoad(){
    $('[id^="select"]').each(function() {
        let id = $(this).attr('id');
        if(document.getElementById(id).value == 0) {
            document.getElementById(id).style.color = "yellow";
        }
        else {
            document.getElementById(id).style.color = "white";
        }
      });
}

function onSelectChange(){
    $('[id^="select"]').each(function() {
        let id = $(this).attr('id');
        if(document.getElementById(id).value == 0) {
            document.getElementById(id).style.color = "yellow";
        }
        else {
            document.getElementById(id).style.color = "white";
        }
      });
}