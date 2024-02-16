<?php 
	include_once 'includes/config.php';
	$pages = 'orders';
?>
	<main>
		<!-- Modal Edição de Dados -->
		<div class="modal" style="display:none">
			<div class="modal_container radius">
				<p class="text-right">
					<br><a href="#" title="Fechar a modal" class="btn_delete radius modal-close"><i class="fa fa-times-circle"></i></a>
				</p>
				
				<h1 class="text-center font-text-min">Editar Dados do Pedido</h1>
				
				<form method="post" enctype="multipart/form-data" id="form_editOrder">
					
					<div class="divisor3">
						<label for="numberOrderEdit">Nº Pedido*</label>
						<input type="text" name="numberOrderEdit" id="numberOrderEdit" required>
					</div>
					
					<div class="divisor3">
						<label for="numberInvoiceEdit">Nº Nota Fiscal*</label>
						<input type="text" name="numberInvoiceEdit" id="numberInvoiceEdit" required>
					</div>
					
					<div class="divisor3">
						<label for="typeOrderEdit">Tipo de Remessa*</a></label>
						<select name="typeOrderEdit" id="typeOrderEdit" required>
							<option value="n">Selecione uma opção</option>
							<option value="1">Correios</option>
							<option value="2">Transportadora</option>
							<option value="3">Retira No Local</option>
						</select>
					</div>
					
					<div class="clear"></div>
					
					<div class="divisor2">
						<label for="cityEdit">Cidade*</label>
						<input type="text" name="cityEdit" id="cityEdit" required>
					</div>
					
					<div class="divisor2">
						<label for="stateEdit">Estado*</label>
						<input type="text" name="stateEdit" id="stateEdit" required>
					</div>
					
					<div class="divisor2">
						<label for="productEdit">Produto*</label>
						<input type="text" name="productEdit" id="productEdit" required>
					</div>
					
					<div class="divisor2">
						<label for="quantityEdit">Quantidade*</label>
						<input type="text" name="quantityEdit" id="quantityEdit" required>
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
										<a href="#" title="Remover este produto do pedido" class="radius btn_delete deleteProductOrder"><i class="fa fa-trash-alt"></i></a>
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
										<a href="#" title="Remover este produto do pedido" class="radius btn_delete deleteProductOrder"><i class="fa fa-trash-alt"></i></a>
									</p>
								</td>
							</tr>
						</table>
					</div>
					
					<div class="clear"></div>
					
					<div class="divisor3">
						<label for="price">Valor do Pedido R$*</label><br>
						<input type="text" name="price" id="price" class="money" required>
					</div>

                    <div class="divisor3">&nbsp;</div>

                    <div class="divisor3">
                        <br><p class="text-right"><button name="btn_editorder" id="btn_editorder" class="btn_edit radius"><i class="fa fa-pen"></i> Atualizar Dados</button></p>
					</div>
				</form>
				
				<div class="clear"></div>
				<div class="espaco-medium"></div>
			</div>
		</div>
		
		<!-- Modal Novo Pedido -->
		<div class="new" style="display:none;">
			<div class="modal_container radius">
				<p class="text-right">
					<br><a href="#" title="Fechar a modal" class="btn_delete radius modal-close"><i class="fa fa-times-circle"></i></a>
				</p>
				
				<h1 class="text-center font-text-min">Dados do Novo Pedido</h1>
				
				<form method="post" enctype="multipart/form-data" id="form_newOrder">

					<?php
						if(empty($_SESSION['order']) || !$_SESSION['order'] || $_SESSION['order'] == '') {
							$_SESSION['order'] = rand(100, 10000).time();
							$Session = $_SESSION['order'];
						}	
						//unset($_SESSION['order']);
						$Session = $_SESSION['order'];
					?>
					
					<div class="divisor3">
						<label for="numberOrder">Nº Pedido*</label>
						<input type="text" name="numberOrder" id="numberOrder" value="<?= $Session ?>" required>
					</div>
					
					<div class="divisor3">
						<label for="numberInvoice">Nº Nota Fiscal*</label>
						<input type="text" name="numberInvoice" id="numberInvoice" required>
					</div>
					
					<div class="divisor3">
						<label for="typeOrder">Tipo de Remessa*</a></label>
						<select name="typeOrder" id="typeOrder" required>
							<option value="n">Selecione uma opção</option>
							<option value="1">Correios</option>
							<option value="2">Transportadora</option>
							<option value="3">Retira No Local</option>
						</select>
					</div>
					
					<div class="clear"></div>
					
					<div class="divisor3">
						<label for="city">Cidade*</label>
						<input type="text" name="city" id="city" required>
					</div>
					
					<div class="divisor3">
						<label for="state">Estado*</label>
						<input type="text" name="state" id="state" required>
					</div>

					<div class="divisor3">
						<label for="type">Status:</label>
						<select name="type" id="type" required>
							<option value="n"> Escolha uma opção </option>
							<option value="1"> Pendente </option>
							<option value="2"> Aguardando </option>
							<option value="3"> Despachado </option>
							<option value="4"> Devolvido </option>
						</select>
					</div>
					
					<div class="divisor2">
						<label for="product">Produto*</label>
						<input type="text" name="product" id="product" required>
					</div>
					
					<div class="divisor2">
						<label for="quantity">Quantidade*</label>
						<input type="text" name="quantity" id="quantity" required>
					</div>
					
					<div class="clear"></div>
					
					<div class="divisor1">
						<h1 class="font-text-min font-weight-medium"  style="margin: 10px 2% !important;">Lista do Pedido</h1>

						<div class="loader">
						<table style="width: 96% !important; margin: 10px 2% !important;">
							<tbody>
								<?php
								
								$Read = $pdo->prepare("SELECT pedido_id, pedido_sessao, pedido_numero, pedido_nf, pedido_produto_id, pedido_produto_nome, pedido_quantidade, pedido_quantidade_estoque, pedido_valor FROM " .DB_ORDERS. " WHERE pedido_sessao = :pedido_sessao OR pedido_numero = :pedido_numero");
								$Read->bindValue(':pedido_sessao', $Session);
								$Read->bindValue(':pedido_numero', $Session);
								$Read->execute();

								$Lines = $Read->rowCount();

								if($Lines == 0){
									echo '<tr><td>Não há nenhum produto nesse pedido!</td></tr>';
								}

								foreach($Read as $Show):


								?>
								<tr>
									<td>
										<p class="font-text-sub"><b>Produto:</b></p>
										<p><?= strip_tags($Show['pedido_produto_nome']) ?></p>
									</td>
									
									<td>
										<p class="font-text-sub"><b>Quantidade:</b></p>
										<p><?= strip_tags($Show['pedido_quantidade']) ?></p>
									</td>
									
									<td>
										<p class="font-text-sub"><b>Valor:</b></p>
										<p>R$ <?= strip_tags(number_format($Show['pedido_valor'], 2, ',', '.')) ?></p>
									</td>
									
									<td>
										<p class="text-center">
											<a href="#" title="Remover este produto do pedido" class="radius btn_delete deleteProductOrder" data-id="<?= strip_tags($Show['pedido_id']) ?>"><i class="fa fa-trash-alt"></i></a>
										</p>
									</td>
								</tr>
								<?php endforeach;?>
							</tbody>
						</table>
						</div>
					</div>
					
					<div class="clear"></div>
					
					<div class="divisor3">
						<label for="price">Valor do Pedido R$*</label><br>
						<input type="text" name="price" id="price" class="money" required>
					</div>

                    <div class="divisor3">&nbsp;</div>
					
					<div class="divisor3">
                        <br><p class="text-right"><button name="btn_neworder" id="btn_neworder" class="btn_new radius"><i class="fa fa-pen"></i> Cadastrar Dados</button></div>
					</div>
				</form>
				
				<div class="clear"></div>
				<div class="espaco-medium"></div>
			</div>
		</div>
		
		<!-- Modal Deletar Pedido -->
		<div class="delete" style="display:none">
			<div class="modal_container radius">
				<div class="espaco-medium"></div>
				<h1 class="text-center font-text-min">Você Deseja Remover Este Pedido?</h1>
				<p class="text-center"><br>
					<a href="#" title="Remover este Pedido" class="btn_edit radius removeOrder"><i class="fa fa-check"></i> SIM </a>&nbsp;&nbsp;
					<a href="#" title="Fechar a modal" class="btn_delete radius modal-close"><i class="fa fa-times-circle"></i> NÃO</a>
				</p>
				
				<div class="clear"></div>
				<div class="espaco-medium"></div>
			</div>
		</div>

		<!-- Modal Incluir Produtos no Pedido -->
		<div class="modal orderNew" style="display:none;">
			<div class="modal_container radius" style="width: 30% !important;">
				<div class="espaco-medium"></div>
				<h1 class="text-center font-text-min">Você Deseja Incluir Produtos Neste Pedido?</h1>
				<p class="text-center"><br>
					<a href="#" title="Sim, desejo incluir outro produto" class="btn_edit radius plusOrder"><i class="fa fa-check"></i> SIM </a>&nbsp;&nbsp;
					<a href="#" title="Fechar a modal" class="btn_delete orderHide radius modal-close"><i class="fa fa-times-circle"></i> NÃO</a>
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
							<label for="searching">Busca Por Nº do Pedido:</label>
							<input type="text" name="searching" id="searching" placeholder="Ex. 12345" required>
						</div>
						
						<div class="divisor3">
							<label for="type">Busca Por Tipo:</label>
							<select name="type" id="type" required>
								<option value="n"> Escolha uma opção </option>
								<option value="1"> Pendente </option>
								<option value="2"> Aguardando </option>
								<option value="3"> Despachado </option>
								<option value="4"> Devolvido </option>
								<option value="5"> Cancelado </option>
							</select>
						</div>

                        <br>
						<div class="divisor3" style="display: flex; justify-content: center; align-items: center;">
							<button name="btn_search" id="btn_search" class="btn_edit radius" style="float: left"><i class="fa fa-search"></i> Pesquisar</button>
							
							<a href="#" class="btn_new radius font-text-sub newOrder"><i class="fa fa-plus-circle"></i> NOVO</a>
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
								<p class="font-text-sub"><b>Cidade/UF:</b></p>
								<p>São Paulo/SP</p>
							</td>
							
							<td>
								<p class="font-text-sub"><b>Status:</b></p>
								<p class="font-text-sub">
									<span class="active radius"> AGUARDANDO </span>
								</p>
							</td>
							
							<td>
								<p class="text-center">
									<a href="#" title="Visualizar e editar informações" class="radius btn_edit editOrder"><i class="fa fa-pen"></i></a>
									<a href="#" title="Remover este registro" class="radius btn_delete deleteOrder"><i class="fa fa-trash-alt"></i></a>
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
