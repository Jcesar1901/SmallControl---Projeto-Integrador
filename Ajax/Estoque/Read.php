<?php
session_start();

include_once '../../includes/config.php';

$message = '';

$Searching = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRIPPED);
$Search = array_map('strip_tags', $Searching);

// Checar o campo "Nota Fiscal de Entrada"
if(empty($Search['searching']) && $Search['type'] == 'n'){
    $message = ['status'=> 'info', 'message'=> 'Por favor, preencha o campo de numero do pedido ou tipo de operação !', 'Redirect'=>'', 'lines' => 0];
    echo json_encode($message);
    return; 
}

unset($_SESSION['stock']);

// ENTRADA
if($Search['type'] == 1 && empty($Search['searching'])){
    $Read = $pdo->prepare("SELECT entrada_nf, entrada_codigo, entrada_produto_id, entrada_status FROM " . DB_STOCKIN . " WHERE entrada_status = :entrada_status");
    $Read->bindValue(':entrada_status', 1);
    $Read->execute();

    $Lines = $Read->rowCount();

    foreach($Read as $Show){
        $pedido[] = strip_tags($Show['entrada_codigo']);
        $nf[] = strip_tags($Show['entrada_nf']);
        $status[] = strip_tags($Show['entrada_status'] == 1 ? 'Ativo' : 'Inativo');
        $id[] = strip_tags($Show['entrada_produto_id']);
        $operacao[] = 'Entrada';
    }
    
    $message = ['status' => 'success', 'pedido' => $pedido, 'nf' => $nf, 'stat' => $status, 'id' => $id, 'operacao' => $operacao];
    echo json_encode($message);
    return; 

}

// SAIDA
if($Search['type'] == 2 && empty($Search['searching'])){
    $Read = $pdo->prepare("SELECT saida_nf, saida_codigo, saida_id, saida_status FROM " . DB_STOCKOUT . " WHERE saida_status = :saida_status");
    $Read->bindValue(':saida_status', 1);
    $Read->execute();

    $Lines = $Read->rowCount();

    foreach($Read as $Show){
        $pedido[] = strip_tags($Show['saida_codigo']);
        $nf[] = strip_tags($Show['saida_nf']);
        $status[] = strip_tags($Show['saida_status'] == 1 ? 'Ativo' : 'Inativo');
        $id[] = strip_tags($Show['saida_id']);
        $operacao[] = 'Saída';
    }
    
    $message = ['status' => 'success', 'pedido' => $pedido, 'nf' => $nf, 'stat' => $status, 'id' => $id, 'operacao' => $operacao];
    echo json_encode($message);
    return; 
}

// DEVOLUÇÃO 
if($Search['type'] == 3 && empty($Search['searching'])){
    $Read = $pdo->prepare("SELECT devolucao_nf, devolucao_codigo, devolucao_id, devolucao_status FROM " . DB_DEVOLUTION . " WHERE devolucao_status = :devolucao_status");
    $Read->bindValue(':devolucao_status', 1);
    $Read->execute();

    $Lines = $Read->rowCount();

    foreach($Read as $Show){
        $pedido[] = strip_tags($Show['devolucao_codigo']);
        $nf[] = strip_tags($Show['devolucao_nf']);
        $status[] = strip_tags($Show['devolucao_status'] == 1 ? 'Ativo' : 'Inativo');
        $id[] = strip_tags($Show['devolucao_id']);
        $operacao[] = 'Saída';
    }
    
    $message = ['status' => 'success', 'pedido' => $pedido, 'nf' => $nf, 'stat' => $status, 'id' => $id, 'operacao' => $operacao];
    echo json_encode($message);
    return; 
}

// CANCELADO 
if($Search['type'] == 3 && empty($Search['searching'])){
    $Read = $pdo->prepare("SELECT devolucao_sessao FROM " . DB_DEVOLUTION . " WHERE devolucao_sessao = :devolucao_sessao");
    $Read->bindValue(':devolucao_sessao', $Session);
    $Read->execute();
}

// PEDIDO
if($Search['type'] == 'n' && !empty($Search['searching'])){
    $Read = $pdo->prepare("SELECT entrada_nf, entrada_codigo, entrada_produto_id, entrada_status FROM " . DB_STOCKIN . " WHERE entrada_nf = :entrada_nf");
    $Read->bindValue(':entrada_nf', $Search['searching']);
    $Read->execute();
    $Lines = $Read->rowCount();

    foreach($Read as $Show){}

    $pedido = strip_tags($Show['entrada_codigo']);
    $nf = strip_tags($Show['entrada_nf']);
    $status = strip_tags($Show['entrada_status'] == 1 ? 'Ativo' : 'Inativo');
    $id = strip_tags($Show['entrada_produto_id']);
    $operacao = 'Entrada';
}

// PEDIDO + TIPO DE OPERAÇÃO
if($Search['type'] =! 'n' && empty($Search['searching'])){
    $Read = $pdo->prepare("SELECT entrada_sessao FROM " . DB_STOCKIN . " WHERE entrada_sessao = :entrada_sessao");
    $Read->bindValue(':entrada_sessao', $Session);
    $Read->execute();
}
