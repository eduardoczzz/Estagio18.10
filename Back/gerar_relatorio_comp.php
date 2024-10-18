<?php

session_start(); // Iniciar a sessão

// Limpar o buffer
ob_start();

// Incluir a conexão com MYSQL
include('../banco/config.php');

// QUERY para recuperar os registros do banco de dados
$query_computador = "SELECT id, modelo, fabricante, categoria, situacao, matricula, numero_serie FROM computadores ORDER BY id DESC";

// Executar a QUERY
$result_computador = $conexao->query($query_computador);

// Acessa o IF quando encontrar registro no banco de dados
if ($result_computador && $result_computador->num_rows > 0) {
    // Aceitar csv ou texto 
    header('Content-Type: text/csv; charset=utf-8');

    // Nome arquivo
    header('Content-Disposition: attachment; filename=estoque_computadores.csv');

    // Gravar no buffer
    $resultado = fopen("php://output", 'w');

    // Criar o cabeçalho do Excel - Usar a função mb_convert_encoding para converter caracteres especiais
    $cabecalho = ['id', 'Modelo', 'Fabricante', 'Categoria', 'Situação', 'Matrícula', 'Número de Série'];

    // Escrever o cabeçalho no arquivo
    fputcsv($resultado, $cabecalho, ';');

    // Ler os registros retornados do banco de dados
    while ($row_computador = $result_computador->fetch_assoc()) {
        // Escrever o conteúdo no arquivo
        fputcsv($resultado, $row_computador, ';');
    }

    // Fechar arquivo
    fclose($resultado);
    exit(); // Termina o script após o download
} else { // Acessa O ELSE quando não encontrar nenhum registro no BD
    $_SESSION['msg'] = "<p style='color: #f00;'>Nenhum registro encontrado no banco de dados.</p>";
    header("Location: relatorio.php");
    exit(); // Termina o script após redirecionar
}
