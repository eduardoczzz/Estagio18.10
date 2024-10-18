document.addEventListener('DOMContentLoaded', function() {
    
    // Redireciona para dashboard.html ao clicar no botão de dashboard
    var botaoDash = document.getElementById("btn_dash");
    botaoDash.addEventListener("click", function() {
        window.location.href = "dashboard.html";
    });

});