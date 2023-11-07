<?php 
	include_once 'includes/config.php';
	$pages = 'services';
?>
	<main>
		<!-- Modal visualizar pedido -->
		<div class="new" style="display:none">
			<div class="modal_container radius">
				<p class="text-right">
					<br><a href="#" title="Fechar a modal" class="btn_delete radius modal-close"><i class="fa fa-times-circle"></i></a>
				</p>
				
				<h1 class="text-center font-text-min">Dados do Pedido</h1>
				
				<form method="post" enctype="multipart/form-data" id="form_Order">
					
					<div class="divisor2">
						<label for="numberOrder">Nº Pedido*</label>
						<input type="text" name="numberOrder" id="numberOrder" required>
					</div>
					
					<div class="divisor2">
						<label for="typeOrder">Tipo de Remessa*</a></label>
						<select name="typeOrder" id="typeOrder" required>
							<option value="n">Selecione uma opção</option>
							<option value="1">Correios</option>
							<option value="2">Transportadora</option>
							<option value="3">Retira No Local</option>
						</select>
					</div>
					
					<div class="clear"></div>
					
					<div class="divisor1">
						<h1 class="font-text-min font-weight-medium"  style="margin: 10px 2% !important;">Lista do Pedido</h1>
						<table style="width: 96% !important; margin: 10px 2% !important;">
							<tr>
								<td>
									<p class="font-text-sub"><b>Produto:</b></p>
									<p>Açucar Refinado 1Kg</p>
								</td>
								
								<td>
									<p class="font-text-sub"><b>Quantidade:</b></p>
									<p>2</p>
								</td>
								
								<td>
									<p class="font-text-sub"><b>Valor:</b></p>
									<p>R$ 50,00</p>
								</td>
								
								<td>
									<p class="text-center">
										<a href="#" title="Produto do pedido coletado" class="radius btn_new productCheck"><i class="fa fa-check-circle"></i></a>
									</p>
								</td>
							</tr>
							
							<tr>
								<td>
									<p class="font-text-sub"><b>Produto:</b></p>
									<p>Arroz Integral 5Kg</p>
								</td>
								
								<td>
									<p class="font-text-sub"><b>Quantidade:</b></p>
									<p>1</p>
								</td>
								
								<td>
									<p class="font-text-sub"><b>Valor:</b></p>
									<p>R$ 25,00</p>
								</td>
								
								<td>
									<p class="text-center">
										<a href="#" title="Produto do pedido coletado" class="radius btn_new productCheck"><i class="fa fa-check-circle"></i></a>
									</p>
								</td>
							</tr>
						</table>
					</div>
					
					<div class="divisor2">
						<br><button name="btn_editservices" id="btn_editservices" class="btn_new radius"><i class="fa fa-pen"></i> Pedido Coletado</button>
					</div>
				</form>
				
				<div class="clear"></div>
				<div class="espaco-medium"></div>
			</div>
		</div>
		<section class="content_left">
			<!-- Chama o menu da página-->
			<?php require 'includes/left.php';?>
		</section>
		
		<section class="content_right">
			<!-- Chama o cabeçalho da página-->
			<?php require 'includes/header.php';?>
			
			<article class="bgcolor-white">
				
				<div class="searching">
					<form method="post" id="form_search">
						<div class="espaco-min"></div>
						<h2 class="text-margin text-center">Digite o termo abaixo ou selecione uma opção para sua consulta.</h2>
						<div class="divisor3">
							<label for="searching">Busca Por Nº do Pedido:</label>
							<input type="text" name="searching" id="searching" placeholder="Ex. 12345" required>
						</div>
						
						<div class="divisor3">
							<label for="type">Busca Por Tipo:</label>
							<select name="type" id="type" required>
								<option value="n"> Escolha uma opção </option>
								<option value="1"> Liberado </option>
								<option value="2"> Coletado </option>
								<option value="3"> Cancelado </option>
							</select>
						</div>

                        <br>
						<div class="divisor3" style="display: flex; justify-content: center; align-items: center;">
							<button name="btn_search" id="btn_search" class="btn_edit radius" style="float: left"><i class="fa fa-search"></i> Pesquisar</button>
						</div>
						
						<div class="clear"></div>
						<div class="espaco-min"></div>
					</form>
					
					<table>
						<tr>
							<td>
								<p class="font-text-sub"><b>Nº Pedido:</b></p>
								<p>123542</p>
							</td>
							
							<td>
								<p class="font-text-sub"><b>Quantidade:</b></p>
								<p>05 Produtos</p>
							</td>
							
							<td>
								<p class="font-text-sub"><b>Cidade/UF:</b></p>
								<p>São Paulo/SP</p>
							</td>
							
							<td>
								<p class="font-text-sub"><b>Status:</b></p>
								<p class="font-text-sub">
									<span class="active radius"> COLETADO </span>
								</p>
							</td>
							
							<td>
								<p class="text-center">
									<a href=#" title="Visualizar informações do Pedido" class="radius btn_search viewOrder"><i class="fa fa-pen"></i></a>
								</p>
							</td>
						</tr>
					</table>
					
				</div>
				<div class="espaco-min"></div>
			</article>
			<div class="espaco-min"></div>
		</section>
	<div class="clear"></div>
	</main>
