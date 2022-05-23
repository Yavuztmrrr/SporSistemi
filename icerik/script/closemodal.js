var modal = document.getElementById('id01');
var modal2 = document.getElementById('id02');
var spankapat = document.getElementById('kapat');
var span = document.getElementsByClassName("kapat")[0];

span.onclick = function() {
    modal.style.display = "none";
}
spankapat.onclick = function() {
    modal2.style.display = "none";
    
}

window.onclick = function(event) {
    if (event.target == modal) {
        modal.style.display = "none";
        
    }
    if (event.target == modal2) {
        modal2.style.display = "none";
    
    }
}

