<?php
    require '../../Developers/Config.php';
    $Get = filter_input(INPUT_GET, 'action', FILTER_SANITIZE_STRIPPED);
    $GetFilters = strip_tags($Get);

    $message = null;

    if(!$Get || $Get = '' || $Get = null){
        $message = ['status' => 'warning', 'message'=>'Nenhuma ação pode ser realizada!', 'redirect'=>'home.php'];
        echo json_encode($message);
        return;
    }else{
        session_destroy();
        unset($_SESSION['user_name']);
        unset($_SESSION['user_level']);
        unset($_SESSION['user_email']);
        unset($_SESSION['user_id']);
        unset($_SESSION['user_token']);
        unset($_SESSION['logged']);
    

        $message = ['status' => 'success', 'message'=>'Logout realizado com sucesso!', 'redirect'=>'../login.php'];
        echo json_encode($message);
        return;
    }
?>
