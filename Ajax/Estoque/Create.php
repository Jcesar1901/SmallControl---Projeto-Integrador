<?php
session_start();

include_once '../../includes/config.php';

$message = '';

$Searching = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRIPPED);
$Search = array_map('strip_tags', $Searching);

// Checar o campo "Nota Fiscal de Entrada"
if(empty($Search['invoiceNew'])){
    $message = ['status'=> 'info', 'message'=> 'Por favor, preencha o campo de Nota Fiscal de Entrada !', 'Redirect'=>'', 'lines' => 0];
    echo json_encode($message);
    return; 
}

// Checar o campo "Valor da nota fiscal"
if(empty($Search['invoiceValueNew'])){
    $message = ['status'=> 'info', 'message'=> 'Por favor, preencha o campo de valor da Nota Fiscal !', 'Redirect'=>'', 'lines' => 0];
    echo json_encode($message);
    return; 
}

// Checar o campo "Produto"
if(empty($Search['productNew'])){
    $message = ['status'=> 'info', 'message'=> 'Por favor, preencha o nome do Produto !', 'Redirect'=>'', 'lines' => 0];
    echo json_encode($message);
    return; 
}

// Checar o campo "Quantidade"
if(empty($Search['quantityNew'])){
    $message = ['status'=> 'info', 'message'=> 'Por favor, preencha o campo Quantidade !', 'Redirect'=>'', 'lines' => 0];
    echo json_encode($message);
    return; 
}

// Checar o campo "unidade de medida"
if(empty($Search['unity'])){
    $message = ['status'=> 'info', 'message'=> 'Por favor, preencha o campo Unidade de Medida !', 'Redirect'=>'', 'lines' => 0];
    echo json_encode($message);
    return; 
}

// Checar o campo "validade"
if(empty($Search['vality'])){
    $message = ['status'=> 'info', 'message'=> 'Por favor, preencha o campo Validade !', 'Redirect'=>'', 'lines' => 0];
    echo json_encode($message);
    return; 
}

// Checar o campo "Fornecedor"
if(empty($Search['provider'])){
    $message = ['status'=> 'info', 'message'=> 'Por favor, preencha o campo Fornecedor !', 'Redirect'=>'', 'lines' => 0];
    echo json_encode($message);
    return; 
}

// Checar o campo "Tipo de operação"
if(empty($Search['typeNew']) || $Search['typeNew'] == 'n'){
    $message = ['status'=> 'info', 'message'=> 'Por favor, selecione o tipo de operação !', 'Redirect'=>'', 'lines' => 0];
    echo json_encode($message);
    return; 
}

// Checar o campo "status"
if(empty($Search['statusNew']) || $Search['statusNew'] == 'n'){
    $message = ['status'=> 'info', 'message'=> 'Por favor, selecione o status!', 'Redirect'=>'', 'lines' => 0];
    echo json_encode($message);
    return; 
}

unset($_SESSION['stock']);
$_SESSION['stock'] = rand(100, 10000).time();
$Session = $_SESSION['stock'];

$Read = $pdo->prepare("SELECT entrada_sessao FROM " . DB_STOCKIN . " WHERE entrada_sessao = :entrada_sessao");
$Read->bindValue(':entrada_sessao', $Session);
$Read->execute();

$Lines = $Read->rowCount();

if($Lines >= 1){
    $message = ['status'=> 'info', 'message'=> 'Esta operação já foi registrada!', 'redirect'=> '', 'lines' => 0];
    echo json_encode($message);
    return; 
}
//Consulta na tabela de produtos
$ReadProd = $pdo->prepare("SELECT * FROM " . DB_PRODUCT . " WHERE produto_nome = :produto_nome");
$ReadProd->bindValue(':produto_nome', $Search['productNew']);
$ReadProd->execute();

$LinesProd = $ReadProd -> rowCount();

if($Lines >= 1){
    $message = ['status'=> 'info', 'message'=> 'Este produto está inativo ou nao existe mais!', 'redirect'=> '', 'lines' => 0];
    echo json_encode($message);
    return;
}

foreach($ReadProd as $Show){}

$Price = strip_tags($Show['produto_preco']);
$Category = strip_tags($Show['produto_categoria']);
$PriceInvoice = str_replace(['.', ','] , ['', '.'], $Search['invoiceValueNew']);

$StockQuantity = strip_tags($Search['quantityNew']);
$StockBack = strip_tags($Show['produto_quantidade']);
$StockNow = $StockBack + $StockQuantity;

$Token = rand(100000, 100000000);
$Create = $pdo->prepare("INSERT INTO " . DB_STOCKIN . "(entrada_produto_nome, entrada_quantidade, entrada_quantidade_estoque_atual, entrada_quantidade_estoque, entrada_medidas, entrada_validade, entrada_nf, entrada_codigo, entrada_fornecedor, entrada_valor_nf, entrada_sessao, entrada_status)
VALUES(:entrada_produto_nome, :entrada_quantidade, :entrada_quantidade_estoque_atual, :entrada_quantidade_estoque, :entrada_medidas, :entrada_validade, :entrada_nf, :entrada_codigo, :entrada_fornecedor, :entrada_valor_nf, :entrada_sessao, :entrada_status)");
$Create->bindValue(':entrada_produto_nome', $Search['productNew']);
$Create->bindValue(':entrada_quantidade', $StockQuantity);
$Create->bindValue(':entrada_quantidade_estoque_atual', $StockBack);
$Create->bindValue(':entrada_quantidade_estoque', $StockNow);
$Create->bindValue(':entrada_medidas', $Search['unity']);
$Create->bindValue(':entrada_validade', $Search['vality']);
$Create->bindValue(':entrada_nf', $Search['invoiceNew']);
$Create->bindValue(':entrada_codigo', $Token);
$Create->bindValue(':entrada_fornecedor', $Search['provider']);
$Create->bindValue(':entrada_valor_nf', $PriceInvoice);
$Create->bindValue(':entrada_sessao', $Session);
$Create->bindValue(':entrada_status', $Search['statusNew']);
$Create->execute();

$Update = $pdo->prepare("UPDATE " . DB_PRODUCT . " SET produto_quantidade = :produto_quantity WHERE produto_nome = :produto_nome");
$Update -> bindValue(':produto_quantity', $StockNow);
$Update -> bindValue(':produto_nome', $Search['productNew']);
$Update -> execute();

$message = ['status' => 'success', 'message' => 'Operação cadastrada com sucesso!', 'redirect'=> 'stock'];
echo json_encode($message);
return; 
