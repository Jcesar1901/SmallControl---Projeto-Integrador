<?php

?>

<!doctype html>
<html lang="pt-br">
	<head>
		<meta charset="utf-8">
		<title>Login Auth 2.0</title>
        <meta name="viewport" content="width=device-width,initial-scale=1,maximum-scale=1,user-scalable=0">
        <meta name="robots" content="noindex, nofollow"/>
        <link href="Views/Views.css" rel="stylesheet">
        <link href="https://fonts.googleapis.com/css2?family=Kumbh+Sans:wght@300;700&display=swap" rel="stylesheet">
        <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.6.3/css/all.css" integrity="sha384-UHRtZLI+pbxtHCWp1t77Bi1L4ZtiqrqD80Kn4Z8NTSRyMA2Fd33n5dQ8lWUE00s/" crossorigin="anonymous">

	</head>
	
	<body>

    <div class="result"></div>

    <main >
        <article class="container_login">
            <h1 class="log_title">Sistema de Acesso </h1>
            <form method="post" id="form_login">
                <label for="login_email">E-mail de Acesso: <label>
                <input type="email" name="login_email" id="login_email" required value="">

                <label for="login_password">Senha de Acesso: <a id="showPass"><span class="fa fa-eye"></span></a></label>
                <input type="password" name="login_password" id="login_password" required value="">

                <div><input type="checkbox" name="login_remember" id="remember" > Lembrar Senha</div>

                <button name="btn_login" id="btn_login"><span class="fa fa-paper-plane"></span> Logar!</button>
                <a href="recovery.php"><u>Nova Senha!</u></a>
				
				<p class="demo">DEMO: Email: admin@admin.com - Password: admin</p>
            </form>
        </article>
    </main>
    <script src="Views/jquery.js"></script>
    <script src="Views/Views.js"></script>
    <script src="Ajax/Ajax.js"></script>
	</body>
</html>