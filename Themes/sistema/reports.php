<?php 
	include_once 'includes/config.php';
	$pages = 'reports.php';
?>

<!-- Não imprimir menu, header e footer -->
<style media="print">
	@media print{
		.noPrint{
		   display: none !important;
		}
	   
		table td{padding: 1% 0%; border: 2px solid #eee !important; font-size: 1em;}
	}
	
</style>

<main>
	<section class="content_left noPrint">
		<!-- Chama o menu da página-->
		<?php require 'includes/left.php';?>
	</section>
	
	<section class="content_right">
		<!-- Chama o cabeçalho da página-->
		<?php require 'includes/header.php';?>
		
		<article class="bgcolor-white">
			
			<div class="searching">
				<form method="post" id="form_search" class="noPrint">
					<div class="espaco-min"></div>
					<h2 class="text-margin text-center">Escolha as opções abaixo para sua consulta.</h2>
					<div class="divisor4">
						<label for="searching">Busca Por Tipo:</label>
						<select name="searching" id="searching" required>
							<option value="n"> Escolha uma opção</option>
							<option value="1"> Produtos</option>
							<option value="2"> Entrada </option>
							<option value="3"> Saída </option>
							<option value="4"> Estoque </option>
							<option value="5"> Fornecedores </option>
							<option value="6"> Clientes </option>
							<option value="7"> Usuários </option>
							<option value="8"> Acessos </option>
						</select>
					</div>
					
					<div class="divisor4">
						<label for="type">Tipo de Relatório</label>
						<select name="type" id="type" required>
							<option value="n"> Escolha uma opção </option>
							<option value="1"> De Hoje </option>
							<option value="2"> Da Semana </option>
							<option value="3"> Do Mês </option>
							<option value="4"> Do Ano </option>
							<option value="5"> Do Período </option>
						</select>
					</div>
					
					<div class="divisor4 date" style="display:none">
						<div class="divisor2" style="margin: 0 !important;">
							<label for="initial">Data Inicial</label>
							<input type="date" id="initial" name="initial">
						</div>
						
						<div class="divisor2" style="margin: 0 !important;">
							<label for="final">Data Final</label>
							<input type="date" id="final" name="final">
						</div>
						
					</div>
					
					<div class="divisor4">
						<br><button name="btn_search" id="btn_search" class="btn_edit radius" style="float: left"><i class="fa fa-search"></i> Pesquisar</button>
					</div>
					
					<div class="clear"></div>
					<div class="espaco-min"></div>
				</form>
				
				<?php
					//Através da escolha das opções mostra o relatório aqui.
					include 'reports-stock.php';
				?>
			</div>
			<div class="espaco-min"></div>
		</article>
		<div class="espaco-min"></div>
	</section>
	<div class="clear"></div>
</main>
