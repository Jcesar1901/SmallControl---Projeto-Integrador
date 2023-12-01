<?php
    ob_start();
    require 'Developers/Config.php';

    //Verifica se o cookie de bloqueio existe.
    if(!empty($_COOKIE['Lblocked'])){
        $_SESSION['blocked'] = 1;
        $_SESSION['counter'] = TIMESBLOCKED;
    }
    //unset($_SESSION['logout']);
    $_SESSION['logout'] = '';
    $_SESSION['blocked'] = '';
    if(!empty($_COOKIE['LE']) && !empty($_COOKIE['LP']) && $_SESSION['logout'] == 0 && $_SESSION['blocked'] == 0) {
       //header('location: Ajax/Login/Active.php');
    }
?>

<!doctype html>
<html lang="pt-br">
	<head>
		<meta charset="utf-8">
		<title>Login Smallcontrol</title>
        <meta name="viewport" content="width=device-width,initial-scale=1,maximum-scale=1,user-scalable=0">
        <meta name="robots" content="noindex, nofollow"/>
        <link href="Views/Views.css" rel="stylesheet">
        <link href="https://fonts.googleapis.com/css2?family=Kumbh+Sans:wght@300;700&display=swap" rel="stylesheet">
        <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.6.3/css/all.css" integrity="sha384-UHRtZLI+pbxtHCWp1t77Bi1L4ZtiqrqD80Kn4Z8NTSRyMA2Fd33n5dQ8lWUE00s/" crossorigin="anonymous">

	</head>
	
	<body>

    <div class="result"></div>

    <main <?= (isset($_COOKIE['LE']) && ($_COOKIE['LE'] == '' || $_COOKIE['LE'] == null) ? '' : 'id="body_register"') ?>>
        <article class="container_login">
            <h1 class="log_title">Sistema de acesso ao <?= TITLE_LOGIN ?></h1>
            <form method="post" id="form_login">
                <label for="login_email">E-mail de Acesso: </label>
                <input type="email" name="login_email" id="login_email" required value="<?= (isset($_COOKIE['LE']) ? $_COOKIE['LE'] : ''); ?>" placeholder="Digite seu email">

                <label for="login_password">Senha de Acesso: <a id="showPass"><span class="fa fa-eye"></span></a></label>
                <input type="password" name="login_password" id="login_password" required value="<?= (isset($_COOKIE['LP']) ? $_COOKIE['LP'] : ''); ?>" placeholder="Digite sua senha">

                <div><input type="checkbox" name="login_remember" id="remember" <?= (isset($_COOKIE['LE']) && !empty($_COOKIE['LE']) ? 'checked' : ''); ?>> Lembrar Senha</div>

                <button name="btn_login" id="btn_login"><span class="fa fa-paper-plane"></span> Entrar</button>
                <a href="recovery.php"><u>Nova Senha!</u></a>
				
				<p class="demo">Exemplo: Email: admin@admin.com - Password: admin</p>
            </form>
        </article>
    </main>
    <script src="Views/jquery.js"></script>
    <script src="Views/Views.js"></script>
    <script src="Ajax/Ajax.js"></script>
	</body>
</html>
<?php
    ob_end_flush();
?>