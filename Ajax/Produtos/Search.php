<?php
session_start();

include_once '../../includes/config.php';

$message = '';

$Search = strip_tags(filter_input(INPUT_GET, 'val', FILTER_SANITIZE_STRIPPED));

if(empty($Search)){
    $message = ['status'=> 'info', 'message'=> 'Por favor, preencha o campo de busca !', 'Redirect'=> '', 'lines' => 0];
    echo json_encode($message);
    return; 
}

$Read = $pdo->prepare("SELECT produto_id, produto_nome, produto_preco, produto_categoria, produto_status FROM " . DB_PRODUCT . " 
                                WHERE produto_id = :produto_id");
$Read->bindValue(':produto_id', $Search);
$Read->execute();

$Lines = $Read->rowCount();

if($Lines == 0){
    $message = ['status'=> 'info', 'message'=> 'Nenhum resultado encontrado.', 'redirect'=> '', 'lines' => 0];
    echo json_encode($message);
    return; 
}

foreach($Read as $Show){
    $message = ['status'=> 'success', 
        'user'=> strip_tags($Show['produto_nome']),
        'email'=> strip_tags($Show['produto_email']),
        'level'=> strip_tags($Show['produto_nivel'])];
    echo json_encode($message);
    return;
}