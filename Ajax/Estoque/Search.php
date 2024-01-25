<?php
session_start();

include_once '../../includes/config.php';

$message = '';

$Search = strip_tags(filter_input(INPUT_GET, 'searching', FILTER_SANITIZE_STRIPPED));
$Type = strip_tags(filter_input(INPUT_GET, 'type', FILTER_SANITIZE_STRIPPED));

if(empty($Search)){
    $message = ['status'=> 'info', 'message'=> 'Por favor, preencha o campo de busca !', 'Redirect'=> '', 'lines' => 0];
    echo json_encode($message);
    return; 
}

// ENTRADA
if($Type == 'Entrada'){
    $Read = $pdo->prepare("SELECT entrada_nf, entrada_codigo, entrada_quantidade, entrada_produto_id, entrada_status FROM " . DB_STOCKIN . " WHERE entrada_status = :entrada_status AND entrada_produto_id = :entrada_produto_id");
    $Read->bindValue(':entrada_status', 1);
    $Read->bindValue(':entrada_produto_id', $Search);
    $Read->execute();

    $Lines = $Read->rowCount();

    if($Lines == 0){
        $message = ["status" => "info", "message" => "Não foi encontrado nenhum resultado!", "Lines" => 0];
        echo json_encode($message);
        return; 
    }

    foreach($Read as $Show){
        $pedido[] = strip_tags($Show['entrada_codigo']);
        $quantity[] = strip_tags($Show['entrada_quantidade']);
        $status[] = strip_tags($Show['entrada_status'] == 1 ? 'Ativo' : 'Inativo');
        $id[] = strip_tags($Show['entrada_produto_id']);
        $operacao[] = 'Entrada';
    }
    
    $message = ['status' => 'success', 'pedido' => $pedido, 'quantity' => $quantity, 'stat' => $status, 'id' => $id, 'operacao' => $operacao];
    echo json_encode($message);
    return; 

}

// SAIDA
if($Type == 'Saída'){
    $Read = $pdo->prepare("SELECT saida_nf, saida_codigo, saida_id, saida_status FROM " . DB_STOCKOUT . " WHERE saida_status = :saida_status AND saida_id = :saida_id");
    $Read->bindValue(':saida_status', 1);
    $Read->bindValue(':saida_id', $Search['searching']);
    $Read->execute();

    $Lines = $Read->rowCount();

    if($Lines == 0){
        $message = ["status" => "info", "message" => "Não foi encontrado nenhum resultado!", "Lines" => 0];
        echo json_encode($message);
        return; 
    }

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
if($Type == 'Devolução'){
    $Read = $pdo->prepare("SELECT devolucao_nf, devolucao_codigo, devolucao_id, devolucao_status FROM " . DB_DEVOLUTION . " WHERE devolucao_status = :devolucao_status AND devolucao_id = :devolucao_id");
    $Read->bindValue(':devolucao_status', 1);
    $Read->bindValue(':devolucao_id', $Search['searching']);
    $Read->execute();

    $Lines = $Read->rowCount();

    if($Lines == 0){
        $message = ["status" => "info", "message" => "Não foi encontrado nenhum resultado!", "Lines" => 0];
        echo json_encode($message);
        return; 
    }

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
if($Type == 'Cancelado'){
    $Read = $pdo->prepare("SELECT a.entrada_nf, a.entrada_codigo, a.entrada_produto_id, a.entrada_status, b.saida_nf, b.saida_codigo, b.saida_id, b.saida_status, c.devolucao_nf, c.devolucao_codigo, c.devolucao_id, c.devolucao_status FROM si_entrada a INNER JOIN si_saida b ON (b.saida_nf = a.entrada_nf) INNER JOIN si_devolucao c ON (c.devolucao_nf = a.entrada_nf) WHERE a.entrada_status = :entrada_status");
    $Read->bindValue(':entrada_status', 0);
    $Read->execute();

    $Lines = $Read->rowCount();

    if($Lines == 0){
        $message = ["status" => "info", "message" => "Não foi encontrado nenhum resultado!", "Lines" => 0];
        echo json_encode($message);
        return; 
    }
    
    $pedido = [];
    $nf = [];
    $status = [];
    $id = [];
    $operacao = [];
    
    foreach($Read as $Show){
        $pedido[] = strip_tags($Show['entrada_codigo']);
        $nf[] = strip_tags($Show['entrada_nf']);
        $status[] = strip_tags($Show['entrada_status'] == 1 ? 'Ativo' : 'Inativo');
        $id[] = strip_tags($Show['entrada_produto_id']);
        $operacao[] = 'Entrada';

        $pedido[] = strip_tags($Show['saida_codigo']);
        $nf[] = strip_tags($Show['saida_nf']);
        $status[] = strip_tags($Show['saida_status'] == 1 ? 'Ativo' : 'Inativo');
        $id[] = strip_tags($Show['saida_id']);
        $operacao[] = 'Saída';

        $pedido[] = strip_tags($Show['devolucao_codigo']);
        $nf[] = strip_tags($Show['devolucao_nf']);
        $status[] = strip_tags($Show['devolucao_status'] == 1 ? 'Ativo' : 'Inativo');
        $id[] = strip_tags($Show['devolucao_id']);
        $operacao[] = 'Devolução';

    }    
    $message = ["pedido" => $pedido, "nf" => $nf, "stat" => $status, "id" => $id, "operacao" => $operacao];
    echo json_encode($message);
    return;
}
$Lines = $Read->rowCount();

if($Lines == 0){
    $message = ['status'=> 'info', 'message'=> 'Nenhum resultado encontrado.', 'redirect'=> '', 'lines' => 0];
    echo json_encode($message);
    return; 
}

foreach($Read as $Show){
    $Price = number_format($Show['produto_preco'], 2, ',' , '.');
    $Category = strip_tags($Show['produto_categoria']);
    $ProductId = strip_tags($Show['produto_id']);
    $ProductName = strip_tags($Show['produto_nome']);
    $Quantity = strip_tags($Show['produto_quantidade']);
}

for($i = 0; $i < $LinesCat; $i++){
    $message = ['status'=> 'success', 
        'product_id'=> strip_tags($ProductId),
        'product'=> strip_tags($ProductName),
        'quantity'=> strip_tags($Quantity),
        'price'=> strip_tags($Price)];
    $result[$i] = $message;
}    
//var_dump($result);
echo json_encode($result);
return;
