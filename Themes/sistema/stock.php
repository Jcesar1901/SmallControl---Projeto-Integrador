<?php 
	include_once 'includes/config.php';
	$pages = 'stock';
?>

	<main>
		<!-- Modal Edição de Dados -->
		<div class="modal" style="display:none">
			<div class="modal_container radius">
				<p class="text-right">
					<br><a href="#" title="Fechar a modal" class="btn_delete radius modal-close"><i class="fa fa-times-circle"></i></a>
				</p>
				
				<h1 class="text-center font-text-min">Editar Dados do Estoque</h1>
				
				<form method="post" enctype="multipart/form-data" id="form_editStock">
					
					<div class="divisor2">
						<label for="product">Produto*</label>
						<input type="text" name="product" id="product" required>
					</div>
					
					<div class="divisor2">
						<label for="quantity">Quantidade*</label>
						<input type="text" name="quantity" id="quantity" required>
					</div>
					
					<div class="divisor2">
						<label for="type">Tipo de Operação*</label>
						<select name="type" id="type" required>
							<option value="n">Selecione uma opção</option>
							<option value="1">Entrada</option>
							<option value="2">Saída</option>
							<option value="3">Devolução</option>
						</select>
					</div>
					
					<div class="divisor2">
						<label for="status">Status*</label>
						<select name="status" id="status" required>
							<option value="n">Selecione uma opção</option>
							<option value="1">Aguardando</option>
							<option value="2">Liberado</option>
						</select>
					</div>
					
					<div class="divisor2">
						<br><button name="btn_editstock" id="btn_editstock" class="btn_edit radius"><i class="fa fa-pen"></i> Atualizar Dados</button>
					</div>
				</form>
				
				<div class="clear"></div>
				<div class="espaco-medium"></div>
			</div>
		</div>
		
		<!-- Modal Novo Estoque -->
		<div class="new" style="display:none;">
			<div class="modal_container radius">
				<p class="text-right">
					<br><a href="#" title="Fechar a modal" class="btn_delete radius modal-close"><i class="fa fa-times-circle"></i></a>
				</p>
				
				<h1 class="text-center font-text-min">Dados do Novo Pedido</h1>
				
				<form method="post" enctype="multipart/form-data" id="form_editStock">
					
					<div class="divisor2">
						<label for="product">Produto*</label>
						<input type="text" name="product" id="product" required>
					</div>
					
					<div class="divisor2">
						<label for="quantity">Quantidade*</label>
						<input type="text" name="quantity" id="quantity" required>
					</div>
					
					<div class="divisor2">
						<label for="type">Tipo de Operação*</label>
						<select name="type" id="type" required>
							<option value="n">Selecione uma opção</option>
							<option value="1">Entrada</option>
							<option value="2">Saída</option>
							<option value="3">Devolução</option>
						</select>
					</div>
					
					<div class="divisor2">
						<label for="status">Status*</label>
						<select name="status" id="status" required>
							<option value="n">Selecione uma opção</option>
							<option value="1">Aguardando</option>
							<option value="2">Liberado</option>
						</select>
					</div>
					
					<div class="divisor2">
						<br><button name="btn_newstock" id="btn_newstock" class="btn_new radius"><i class="fa fa-pen"></i> Cadastrar Dados</button>
					</div>
				</form>
				
				<div class="clear"></div>
				<div class="espaco-medium"></div>
			</div>
		</div>
		
		<!-- Modal Deletar Estoque -->
		<div class="delete" style="display:none">
			<div class="modal_container radius">
				<div class="espaco-medium"></div>
				<h1 class="text-center font-text-min">Você Deseja Remover Esta Operação?</h1>
				<p class="text-center"><br>
					<a href="#" title="Remover esta operação" class="btn_edit radius removeStock"><i class="fa fa-check"></i> SIM </a>&nbsp;&nbsp;
					<a href="#" title="Fechar a modal" class="btn_delete radius modal-close"><i class="fa fa-times-circle"></i> NÃO</a>
				</p>
				
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
							<label for="searching">Digite o nº do pedido:</label>
							<input type="text" name="searching" id="searching" placeholder="Ex. 12345" required>
						</div>
						
						<div class="divisor3">
							<label for="type">Busca Por Tipo:</label>
							<select name="type" id="type" required>
								<option value="n"> Escolha uma opção </option>
								<option value="1"> Entrada </option>
								<option value="2"> Saída </option>
								<option value="3"> Cancelado </option>
							</select>
						</div>

						<br>
						<div class="divisor3" style="display: flex; justify-content: center; align-items: center;">
							<button name="btn_search" id="btn_search" class="btn_edit radius" style="float: left"><i class="fa fa-search"></i> Pesquisar</button>
							
							<a href="#" class="btn_new radius font-text-sub newStock"><i class="fa fa-plus-circle"></i> NOVO</a>
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
								<p class="font-text-sub"><b>Nota Fiscal:</b></p>
								<p>2.939-302</p>
							</td>
							
							<td>
								<p class="font-text-sub"><b>Operação:</b></p>
								<p>Estoque de Entrada</p>
							</td>
							
							<td>
								<p class="font-text-sub"><b>Status:</b></p>
								<p class="font-text-sub">
									<span class="active radius"> LIBERADO </span>
								</p>
							</td>
							
							<td>
								<p class="text-center">
									<a href="#" title="Visualizar e editar informações" class="radius btn_edit editStock"><i class="fa fa-pen"></i></a>
									<a href="#" title="Remover este registro" class="radius btn_delete deleteStock"><i class="fa fa-trash-alt"></i></a>
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
