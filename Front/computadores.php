<?php
if (isset($_POST['submit'])) {

    include_once('../banco/config.php');

    $modelo = $_POST['modelo'];
    $fabricante = $_POST['fabricante'];
    $categoria = $_POST['categoria'];
    $situacao = $_POST['situacao'];
    $matricula = $_POST['matricula'];
    $numero_serie = $_POST['numero_serie'];

    $stmt = $conexao->prepare("INSERT INTO computadores (modelo, fabricante, categoria, situacao, matricula, numero_serie) VALUES (?, ?, ?, ?, ?, ?)");
    $stmt->bind_param("ssssss", $modelo, $fabricante, $categoria, $situacao, $matricula, $numero_serie);

    if ($stmt->execute()) {
        echo "Item cadastrado com sucesso!";
    } else {
        echo "Erro ao cadastrar item: " . $stmt->error;
    }
}
?>


<!DOCTYPE html>
<html lang="pt-BR">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="../Front/css/computadores.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" />
  <title>Dashboard</title>
</head>

<body>
  <div class="container">
    <nav>
      <ul>
        <li><a href="#" class="logo">
            <img src="" alt="">
            <span class="nav-item">Smart Estoque</span>
          </a></li>
        <li><a href="#">
            <i class="fas fa-home"></i>
            <span id="btn_dash" class="nav-item">Dashboard</span>
          </a></li>
        <li><a href="">
            <i class="fas fa-laptop"></i>
            <span class="nav-item">Computadores</span>
          </a></li>
        <li><a href="">
            <i class="fas fa-plus"></i>
            <span class="nav-item">Orçamento</span>
          </a></li>
        <li><a href="">
            <i class="fas fa-keyboard"></i>
            <span class="nav-item">Equipamentos</span>
          </a></li>
        <li><a href="">
            <i class="fas fa-file-code"></i>
            <span class="nav-item">Relatorios</span>
          </a></li>
        <li><a href="" class="logout">
            <i class="fas fa-sign-out-alt"></i>
            <span class="nav-item">Sair</span>
          </a></li>
      </ul>
    </nav>

    <section class="main">
      <div class="main-top">
        <br>
        <i class="fas fa-user-cog"></i>
      </div>
      <div class="main-skills">
        <div class="card">
          <i class="fas fa-plus"></i>
          <h3>Adicionar Equipamento</h3>
          <button id="btn_adicionar_equip">Adicionar</button>
        </div>
        <div class="card">
          <i class="fas fa-plus"></i>
          <h3>Visualizar Estoque de Computadores</h3>
          <button id="btn_ver_estoque">Selecionar</button>
        </div>
      </div>

      <div class="popup">
    <div class="close-btn">&times;</div>
    <form action="computadores.php" method="POST">
        <fieldset>
            <div class="form">
                <h2>Adicionar Computador</h2>
                <div class="form-element">
                    <label for="modelo" class="labelInput">Modelo:</label>
                    <input type="text" name="modelo" id="modelo" class="inputUser" required placeholder="Modelo:">
                </div>
                <div class="form-element">
                    <label for="fabricante" class="labelInput">Fabricante:</label>
                    <input type="text" name="fabricante" id="fabricante" class="inputUser" required placeholder="Fabricante:">
                </div>
                <div class="form-element">
                    <label for="categoria" class="labelInput">Categoria:</label>
                    <input type="text" name="categoria" id="categoria" class="inputUser" required placeholder="Categoria:">
                </div>
                <div class="form-element">
                    <label for="situacao" class="labelInput">Situacao:</label>
                    <input type="text" name="situacao" id="situacao" class="inputUser" required placeholder="Situação:">
                </div>
                <div class="form-element">
                    <label for="matricula" class="labelInput">Matricula:</label>
                    <input type="text" name="matricula" id="matricula" class="inputUser" required placeholder="Matricula:">
                </div>
                <div class="form-element">
                    <label for="numero_serie" class="labelInput">Numero de serie:</label>
                    <input type="text" name="numero_serie" id="numero_serie" class="inputUser" required placeholder="Numero de Serie:">
                </div>
                <div class="form-element">
                    <button type="submit" name="submit" id="submit">Adicionar</button>  
                </div>
            </div>
        </fieldset>
    </form>
</div>

      
      <!-- Popup de alerta -->
      <div id="alert-popup" class="alert-popup">
        <div class="alert-popup-content">
          <span class="alert-close-btn">&times;</span>
          <p id="alert-message"></p>
        </div>
      </div>
    </section>
  </div>

  <script src="../front/js/computadores.js"></script>
</body>

</html>