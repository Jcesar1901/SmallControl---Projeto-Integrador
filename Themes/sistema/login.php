<?php 
	include_once 'includes/config.php';
	$pages = 'login';
?>

<section class="login">
	<div class="bgcolor-white login_div">
	
		<form method="post" id="form_login">
			<h1 class="font-text-medium text-center color-dark">Sistema de Login de Acesso:</h1><br>
			<label for="email" class="font-text-min text-left color-dark ">Digite o Seu E-mail:</label><br>
			<input type="email" name="email" id="email" required class="font-text-min text-left color-dark bgcolor-white-dark "><br><br>
			
			<label for="password" class="font-text-min text-left color-dark ">Digite a sua Senha:</label><br>
			<input type="password" name="password" id="password" required class="font-text-light-min text-left color-dark bgcolor-white-dark "><br><br>
			
			<button name="btn-login" id="btn-login" class="btn_edit radius"> Logar</button>
			<p class="text-center font-text-sub text-margin"><br><a href="mail-pass" class="color-dark font-weight-max">Esqueceu a Senha?</a></p>
		</form>
	
	</div>
<section>