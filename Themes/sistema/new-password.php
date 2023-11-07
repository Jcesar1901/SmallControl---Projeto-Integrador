<?php 
	include_once 'includes/config.php';
	$pages = 'new-password';
?>
	
	<section class="login">
		<article  class="bgcolor-white login_div">
		
			<form method="post">
				<h1 class="font-text-hard-two text-center color-dark">Redefinir Nova Senha:</h1><br>
				<label for="token" class="font-text-light-extra text-left color-dark ">Digite o token:</label><br>
				<input type="text" name="token" id="token" required  class="font-text-light-extra text-left color-dark bgcolor-white-dark ">
				<br><br>
				
				<label for="pass" class="font-text-light-extra text-left color-dark ">Digite a sua Nova Senha:</label><br>
				<input type="password" name="pass" required  id="pass" class="font-text-light-extra text-left color-dark bgcolor-white-dark "><br><br>
				
				<label for="repass" class="font-text-light-extra text-left color-dark ">Confirme Nova Senha:</label><br>
				<input type="password" name="repass" id="repass" required  class="font-text-light-extra text-left color-dark bgcolor-white-dark "><br><br>
				
				<button name="btn-newPass" id="btn-newPass" class="btn_edit radius">Renovar Senha!</button>
				<p class="text-center font-text-sub text-margin"><br><a href="login" class="color-dark font-weight-max">Voltar ao Login</a></p>
			</form>
		
		</article>
	<section>
