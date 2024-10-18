<?php

session_start(); // Iniciar a sessão

// Limpar o buffer
ob_start();

// Incluir a conexão com MYSQL
include('../banco/config.php');

// QUERY para recuperar os registros do banco de dados
$query_estoque = "SELECT id, produto, quantidade, fornecedor, nota_fiscal, estado_uso FROM estoque ORDER BY id DESC";

// Executar a QUERY
$result_estoque = $conexao->query($query_estoque);

// Acessa o IF quando encontrar registro no banco de dados
if ($result_estoque && $result_estoque->num_rows > 0) {
    // Aceitar csv ou texto 
    header('Content-Type: text/csv; charset=utf-8');

    // Nome arquivo
    header('Content-Disposition: attachment; filename=relatorio_equipamentos.csv');

    // Gravar no buffer
    $resultado = fopen("php://output", 'w');

    // Criar o cabeçalho do Excel - Usar a função mb_convert_encoding para converter caracteres especiais
    $cabecalho = ['id', 'Produto', 'Quantidade', 'Fornecedor', 'Nota Fiscal', 'Estado de Uso'];

    // Escrever o cabeçalho no arquivo
    fputcsv($resultado, $cabecalho, ';');

    // Ler os registros retornados do banco de dados
    while ($row_estoque = $result_estoque->fetch_assoc()) {
        // Escrever o conteúdo no arquivo
        fputcsv($resultado, $row_estoque, ';');
    }

    // Fechar arquivo
    fclose($resultado);
    exit(); // Termina o script após o download
} else { // Acessa O ELSE quando não encontrar nenhum registro no BD
    $_SESSION['msg'] = "<p style='color: #f00;'></p>";
    header("Location: relatorio.php");
    exit(); // Termina o script após redirecionar
}
