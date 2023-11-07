<?php
session_start();

include_once '../../includes/config.php';

$message = '';

$Search = strip_tags(filter_input(INPUT_GET, 'val', FILTER_SANITIZE_STRIPPED));

$Delete = $pdo->prepare("DELETE FROM ".DB_CLIENTS." WHERE cliente_id = :cliente_id");
$Delete->bindValue(':cliente_id', $Search);
$Delete->execute();

$message = ['status'=> 'success', 'message' => 'Cliente Deletado!' ,'redirect' => 'clients'];

echo json_encode($message);
return;