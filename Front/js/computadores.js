document.addEventListener('DOMContentLoaded', function() {
    // Obtém o botão btn_ver_estoque
    var btnVerEstoque = document.getElementById("btn_ver_estoque");

    // Adiciona um evento de clique ao botão
    btnVerEstoque.addEventListener("click", function() {
        // Redireciona para estoque.php
        window.location.href = "estoque_computadores.php";
    });


    // Obtém os elementos relacionados ao popup
    var openButton = document.querySelector('#btn_adicionar_equip');
    var closeButton = document.querySelector('.close-btn');
    var popup = document.querySelector('.popup');

    if (openButton && closeButton && popup) {
        // Adiciona evento de clique para abrir o popup
        openButton.addEventListener('click', function() {
            popup.classList.add('active');
        });

        // Adiciona evento de clique para fechar o popup
        closeButton.addEventListener('click', function() {
            popup.classList.remove('active');
            // Limpa os campos do formulário
            document.getElementById('modelo').value = '';
            document.getElementById('fabricante').value = '';
            document.getElementById('categoria').value = '';
            document.getElementById('situacao').value = '';
            document.getElementById('matricula').value = '';
            document.getElementById('numero_serie').value = '';
        });
    }

    // Redireciona para dashboard.html ao clicar no botão de dashboard
    var botaoDash = document.getElementById("btn_dash");
    botaoDash.addEventListener("click", function() {
        window.location.href = "dashboard.html";
    });

    // Adiciona validação ao formulário antes de submeter
    document.querySelector('form').addEventListener('submit', function(event) {
        let modelo = document.getElementById('modelo').value;
        let fabricante = document.getElementById('fabricante').value;
        let categoria = document.getElementById('categoria').value;
        let situacao = document.getElementById('situacao').value;
        let matricula = document.getElementById('matricula').value;
        let numero_serie = document.getElementById('numero_serie').value;

    
        let modeloRegex = /^[a-zA-Z\s]+$/;
        let numberRegex = /^\d+$/;
    
        let alertPopup = document.getElementById('alert-popup');
        let alertMessage = document.getElementById('alert-message');
        let alertCloseBtn = document.querySelector('.alert-close-btn');
    
    });
});