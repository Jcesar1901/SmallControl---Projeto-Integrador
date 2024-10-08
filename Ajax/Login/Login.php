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

//Verifica o RECAPTCHA
if (!isset($_POST['g-recaptcha-response']) || empty($_POST['g-recaptcha-response'])) {
    $message = ['status' => 'info', 'message'=>'Por favor, marque o reCAPTCHA!', 'redirect'=>''];
    echo json_encode($message);
    return;
}
$captcha_data = $_POST['g-recaptcha-response'];
//Verificação do reCaptcha
$url ="https://www.google.com/recaptcha/api/siteverify";
$secret = "6LcXOcopAAAAAFyHqBnRh-PLDLNmWefmbb-mhm8Z";
$resposta = file_get_contents("https://www.google.com/recaptcha/api/siteverify?secret=" . $secret . "&response=" . $captcha_data);
if (!$resposta) {
    $message = ['status' => 'error', 'message'=>'Falha ao verificar o reCAPTCHA. Tente novamente mais tarde.', 'redirect'=>''];
    echo json_encode($message);
    return;
}

$recaptcha_result = json_decode($resposta);
if (!$recaptcha_result->success) {
    // Se o reCAPTCHA não foi validado com sucesso
    $message = ['status' => 'error', 'message'=>'Erro no reCAPTCHA. Tente novamente.', 'redirect'=>''];
    echo json_encode($message);
    return;
}
// Se o reCAPTCHA foi validado com sucesso, continue com o processo de login

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
