<?php
      session_start(); // Iniciar a sessão

      // Incluir a conexão com MYSQL
      include('../banco/config.php');

      // Verificar se a variável $conexao está definida
      if (isset($conexao)) {
          // Verificar se existe a variável global
          if (isset($_SESSION['msg'])) {
              // Imprimir o valor que está dentro da variável global
              echo $_SESSION['msg'];
              // Destruir a variável global
              unset($_SESSION['msg']);
          }

          // QUERY para recuperar os registros do banco de dados
          $query_estoque = "SELECT id, produto, quantidade, fornecedor, nota_fiscal, estado_uso FROM estoque ORDER BY id DESC";

          // Executar a QUERY
          if ($result_estoque = $conexao->query($query_estoque)) {
              // Acessa o IF quando encontrar registro no banco de dados
              if ($result_estoque->num_rows > 0) {
                  // Ler os registros retornados do banco de dados
                  while ($row_estoque = $result_estoque->fetch_assoc()) {
                      // Extrair os dados do array para imprimir através do nome da coluna
                      $id = $row_estoque['id'];
                      $produto = $row_estoque['produto'];
                      $quantidade = $row_estoque['quantidade'];
                      $fornecedor = $row_estoque['fornecedor'];
                      $nota_fiscal = $row_estoque['nota_fiscal'];
                      $estado_uso = $row_estoque['estado_uso'];
                  }
              } else { // Acessa o ELSE quando não encontrar nenhum registro no BD
                  echo "<p style='color: #f00;'>Erro: Nenhum registro encontrado!</p>";
              }
          } else {
              echo "<p style='color: #f00;'>Erro: " . $conexao->error . "</p>"; // Mostra erro da consulta
          }
      } else {
          echo "<p style='color: #f00;'>Erro: Conexão com o banco de dados não estabelecida!</p>";
      }
      ?>

<!DOCTYPE html>
<html lang="pt-BR">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="../Front/css/relatorio.css">
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
            <span class="nav-item">Relatórios</span>
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
          <h3>Relatório de Equipamentos</h3>
          <button id="btn_fazer_orc" onclick="window.location.href='../back/gerar_relatorio.php'">Gerar Relatório</button>
        </div>
        <div class="card">
          <i class="fas fa-plus"></i>
          <h3>Relatório de Computadores</h3>
          <button id="btn_fazer_orc" onclick="window.location.href='../back/gerar_relatorio_comp.php'">Gerar Relatório</button>
        </div>
      </div>

    </section>
  </div>

  <script src="../front/js/relatorio.js"></script>
</body>

</html>
