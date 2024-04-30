<?php
    session_start();
    include_once '../../includes/config.php';
    require_once '../../vendor/autoload.php';
    
    use GuzzleHttp\Client;
    
    $Post = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRIPPED);
    $PostFilters = array_map('strip_tags', $Post);
    
    $message = null;
    
    $counter = (isset($_SESSION['counter']) ? $_SESSION['counter'] : 0);
    //$counter = 0;
    //unset($_SESSION['blocked']);    
    //var_dump($PostFilters);
    //Responsavel por calulcar o numero de tentativas de login
    if($counter == TIMESBLOCKED && $_SESSION['blocked'] == 0) {
        $_SESSION['counter'] = TIMESBLOCKED + 1;
        $message = ['status' => 'warning', 'message'=>'Você só possui mais uma tentativa', 'redirect'=>''];
        echo json_encode($message);
        return;
    }else{
        $_SESSION['counter'] = $counter + 1;
    }

    //Bloqueio de acesso
    if ((defined('BLOCKED') && BLOCKED == 1 && $counter > TIMESBLOCKED) || (isset($_SESSION['blocked']) && $_SESSION['blocked'] == 1)) {
        unset($_SESSION['user_firstname']);
        unset($_SESSION['user_level']);
        unset($_SESSION['user_email']);
        unset($_SESSION['user_id']);
        unset($_SESSION['user_token']);
        unset($_SESSION['logged']);

        $_SESSION['blocked'] = 1;
        setcookie("LBlocked", 1, 86400, '/');
        $message = ['status' => 'error', 'message'=>'Seu acesso foi blockeado! fale com o admin!', 'redirect'=>''];
        echo json_encode($message);
        return;
    }
    //Verifica se o email é valido
    $Email = $PostFilters['login_email'];
    if(!$Email || empty($Email) || $Email == null || !filter_var($Email, FILTER_VALIDATE_EMAIL)){

        $message = ['status' => 'info', 'message'=>'Email invalido !', 'redirect'=>''];
        echo json_encode($message);
        return;
    }

    //Consulta para verificar se o email já existe
    $Read = $pdo->prepare("SELECT user_id, user_email, user_password, user_firstname, user_level, user_token FROM ".DB_LOGIN."  WHERE user_email = :user_email");
    $Read->bindValue(':user_email', $Email);
    $Read->execute();

    $Lines = $Read->rowCount();
    
    if($Lines == 0 ){
        $_SESSION['counter'] = $counter + 1;
        
        if($counter == TIMESBLOCKED){
            $message = ['status' => 'warning', 'message'=>'Você só possui mais uma tentativa', 'redirect'=>''];
            echo json_encode($message);
            return;
        }else{
            $message = ['status' => 'info', 'message'=>'Email ou senha incorretos', 'redirect'=>''];
            echo json_encode($message);
            return;
        }
    }
    
    //Recuperando os dados
    foreach($Read as $Show){}
    
    //Verificar e checar a senha
    $VerifyPass = password_verify($PostFilters['login_password'], $Show['user_password']);

    //Verifica o RECAPTCHA
    if(isset($_POST['btn_login'])){
        if(!empty($_POST['g-recaptcha-response'])){
            $url = 'https://www.google.com/recaptcha/api/siteverify';
            $secret = '6LcXOcopAAAAAFyHqBnRh-PLDLNmWefmbb-mhm8Z';
            $response = $_POST['g-recaptcha-response'];
            $variaveis = "secret=" . $secret . "&response=" . $response;

            $ch = curl_init($url);
            curl_setopt( $ch, CURLOPT_POST, 1);
            curl_setopt( $ch, CURLOPT_POSTFIELDS, $variaveis);
            curl_setopt( $ch, CURLOPT_FOLLOWLOCATION, 1);
            curl_setopt( $ch, CURLOPT_HEADER, 0);
            curl_setopt( $ch, CURLOPT_RETURNTRANSFER, 1);
            $resposta = curl_exec($ch);
            var_dump($resposta);
        }
    }

    if($VerifyPass){        
        // Cria as sessões de acesso
        $_SESSION['user_id'] = $Show['user_id'];
        $_SESSION['user_firstname'] = $Show['user_firstname'];
        $_SESSION['user_email'] = $Show['user_email'];
        $_SESSION['user_level'] = $Show['user_level'];
        $_SESSION['user_token'] = $Show['user_token'];
        $_SESSION['logged'] = 1;
        //var_dump($_SESSION);
        unset($_SESSION['counter']);
        
        $message = ['status' => 'success', 'message'=>'Login realizado com sucesso!', 'redirect'=>'../dashboard'];
        echo json_encode($message);
        return;
    } else{
        $message = ['status' => 'info', 'message'=>'Email ou senha incorretos!', 'redirect'=>''];
        echo json_encode($message);
        return;
    }
?>
