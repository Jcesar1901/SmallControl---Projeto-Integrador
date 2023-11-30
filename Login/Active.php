<?php
    require 'Developers/Config.php';

    $message = null;
    
    $counter = 0;
    
    //Responsavel por calulcar o numero de tentativas de login
    if($counter == TIMESBLOCKED){
        $_SESSION['counter'] = $counter + 1;
        unset($_SESSION['user_name']);
        unset($_SESSION['user_level']);
        unset($_SESSION['user_email']);
        unset($_SESSION['user_id']);
        unset($_SESSION['user_token']);
        unset($_SESSION['logged']);
        header('location: login.php');
    }

    //Bloqueio de acesso
    if(BLOCKED == 1 && $counter == TIMESBLOCKED || $_SESSION['blocked'] == 1) {
        unset($_SESSION['user_name']);
        unset($_SESSION['user_level']);
        unset($_SESSION['user_email']);
        unset($_SESSION['user_id']);
        unset($_SESSION['user_token']);
        unset($_SESSION['logged']);

        $_SESSION['blocked'] = 1;
        setcookie("LBlocked", 1, 86400, '/');
        header('location: login.php');
    }
    //Verifica se o email é valido
    $Email = $_COOKIE['LE'];
    if(!$Email || empty($Email) || $Email == null || filter_var($Email, FILTER_VALIDATE_EMAIL)){
        unset($_SESSION['user_name']);
        unset($_SESSION['user_level']);
        unset($_SESSION['user_email']);
        unset($_SESSION['user_id']);
        unset($_SESSION['user_token']);
        unset($_SESSION['logged']);
        session_destroy();
        header('location: login.php');
    }

    //Consulta para verificar se o email já existe
    $Read = $pdo->prepare("SELECT user_id, user_email, user_password, user_firstname, user_lastname, user_token FROM users WHERE user_email = :user_email");
    $Read->bindValue(':user_email', $Email);
    $Read->execute();

    $Lines = $Read->rowCount();

    if($Lines == 0 ){
        $_SESSION['counter'] = $counter + 1;
        
        if($counter == TIMESBLOCKED){
            unset($_SESSION['user_name']);
            unset($_SESSION['user_level']);
            unset($_SESSION['user_email']);
            unset($_SESSION['user_id']);
            unset($_SESSION['user_token']);
            unset($_SESSION['logged']);
            session_destroy();
            header('location: login.php');
        }else{
            unset($_SESSION['user_name']);
            unset($_SESSION['user_level']);
            unset($_SESSION['user_email']);
            unset($_SESSION['user_id']);
            unset($_SESSION['user_token']);
            unset($_SESSION['logged']);
            session_destroy();
            header('location: login.php');
        }
    }

    //Recuperando os dados
    foreach($Read as $Show){}

    //Verificar e checar a senha
    $VerifyPass = password_verify($_COOKIE['LP'], $Show['user_password']);

    //Verifica se o model de lembrar senha está ativo
    if($VerifyPass){
        
        // Cria as sessões de acesso
        $_SESSION['user_id'] = $Show['user_id'];
        $_SESSION['user_name'] = $Show['user_firstname']. ' ' . $Show['user_lastname'];
        $_SESSION['user_email'] = $Show['user_email'];
        $_SESSION['user_level'] = $Show['user_level'];
        $_SESSION['user_token'] = $Show['user_token'];
        $_SESSION['logged'] = 1;

        unset($_SESSION['counter']);
        header('location: Admin/home.php');

    }else{
        unset($_SESSION['user_name']);
        unset($_SESSION['user_level']);
        unset($_SESSION['user_email']);
        unset($_SESSION['user_id']);
        unset($_SESSION['user_token']);
        unset($_SESSION['logged']);
        session_destroy();
        header('location: login.php');
    }
?>
