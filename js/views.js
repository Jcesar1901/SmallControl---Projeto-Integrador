$(function(){
    // Captura o url pelo meta base
    var page = $('meta[name=base]').attr('content');

    //ABRIR MODAL
    $(".open_modal").click(function(){
        $(".modal").fadeIn(400);
        $(".modal").css("display", "flex");
    });
	
    //FECHA MODAL
    $(".modal-close").click(function(){
        $(".modal").fadeOut(10);
        $(".new").fadeOut(10);
        $(".delete").fadeOut(10);
    });
	
	//FECHA MODAL CATEGORY
    $(".modal-close-cat").click(function(){
        $(".category").fadeOut(10);
    });

    //FECHA NOTIFICAÇÕES
    $(".open_notification").click(function(){
        $(".notification-container").fadeIn(400);
        $(".notification-container").css("display", "flex");
    });
    //FECHA MODAL
    $(".notification-close").click(function(){
        $(".notification-container").fadeOut(400);
    });

	//LIMPA FORMULÁRIO DO CEP
	function limpa_formulario_cep() {
		// Limpa valores do formulário de cep.
		$(".address").val("");
		$(".neighborhood").val("");
		$(".city").val("");
		$(".state").val("");
	}
   //CEP AUTOMÁTICO - VIA CEP
   $(".zipcode").blur(function() {
       var cep = $(this).val().replace(/\D/g, '');

        //Verifica se campo cep possui valor informado.
        if (cep != "") {

            //Expressão regular para validar o CEP.
            var validacep = /^[0-9]{8}$/;

            //Valida o formato do CEP.
            if(validacep.test(cep)) {

               //Consulta o webservice viacep.com.br/
				$.getJSON("//viacep.com.br/ws/"+ cep +"/json/?callback=?", function(dados) {

					if (!("erro" in dados)) {
						//Atualiza os campos com os valores da consulta.
						$(".address").val(dados.logradouro);
						$(".neighborhood").val(dados.bairro);
						$(".city").val(dados.localidade);
						$(".state").val(dados.uf);
					} //end if.
					else {
						//CEP pesquisado não foi encontrado.
						limpa_formulario_cep();
						
					}
				});

            } //end if.
            else {
                //cep é inválido.
                limpa_formulário_cep();
              
            }
        } //end if.
        else {
            //cep sem valor, limpa formulário.
            limpa_formulário_cep();
        }
	});

	//Relatórios, se período for selecionado mostra os campos com as datas inicial e FinalizationRegistry
	$("#form_search").change(function(){
		
		var selected = $('#type').val();
		var search = $('#searching').val();
		
		if(selected == 5 && search == 3 || selected == 5 && search == 4){
			$(".date").css('display', 'block');
		}else{
			$(".date").css('display', 'none');
		}
		
	});
	
	//CPF ou CNPJ
	$("#doc").click(function(){
		
		var selected = $(this).val();
		
		if(selected == 1 || selected == 'n'){
			$(".cpf").css('display', 'block');
			$(".cnpj").css('display', 'none');
		}else{
			$(".cnpj").css('display', 'block');
			$(".cpf").css('display', 'none');
		}
		
	});
    //Abre a modal do editar cliente
    $(document).on('click', '.editClient', function(e){
        e.preventDefault();
        var value = $(this).attr('data-id');
        $('.modal').css('display', 'flex');
        $('#client_id').val(value);
    
        // Trazer os dados para o formulário de modal de edição de dados
    
        var url = page + "Ajax/Usuarios/Search.php?val=" + value;
    
        $.ajax({
            url: url,
            type: 'POST',
            data: { value: value },
            dataType: 'JSON',
            success: function (data, textStatus, jqXHR) {
                // Alimenta o formulário na modal "editar clientes"
                $('#client').val(data['client']);
                $('#email').val(data['email']); 
                $('#phone').val(data['phone']); 
                $('#zipcode').val(data['zipcode']); 
                $('#address').val(data['address']); 
                $('#number').val(data['number']);
                $('#neighborhood').val(data['neighborhood']); 
                $('#city').val(data['city']); 
                $('#state').val(data['state']);
                // Trabalhar com o doc
                if(data['doc'] == 1){
                    $("#cpf").val(data['document']);
                    $("#doc").html('<option	value="1" selected>CPF</option><option value="2">CNPJ</option>');
                    $('.cpf').css('display', 'block');
                    $('.cnpj').css('display', 'none');
                } else {
                    $("#cnpj").val(data['document']);
                    $("#doc").html('<option	value="2" selected>CNPJ</option><option value="1">CPF</option>');
                    $('.cpf').css('display', 'none');
                    $('.cnpj').css('display', 'block');
                }
            }
        }); 
    });
	//Abre a modal do editar Usuario
	$(document).on('click', '.editUser', function(e){
        e.preventDefault();
        var value = $(this).attr('data-id');
        $('.modal').css('display', 'flex');
        $('#user_id').val(value);
    
        // Trazer os dados para o formulário de modal de edição de dados
    
        var url = page + "Ajax/Usuarios/Search.php?val=" + value;
    
        $.ajax({
            url: url,
            type: 'POST',   
            data: value,
            dataType: 'JSON',

            success: function (data, textStatus, jqXHR) {
                // Alimenta o formulário na modal "editar clientes"
                $('#username').val(data['user']);
                $('#useremail').val(data['email']);
                // Trabalhar com o level
                $usuarios_level = parseInt(data.level, 10);
                switch($usuarios_level){
                    case 10:
                    $("#userlevel").html('<option	value="1">Operador</option><option value="2">Estoquista</option><option	value="9">Administrador</option><option value="10" selected>Super Administrador</option>');
                    break;
                    case 9:
                    $("#userlevel").html('<option   value="1">Operador</option><option value="2">Estoquista</option><option	value="9" selected>Administrador</option><option value="10">Super Administrador</option>');
                    break;
                    case 2:
                    $("#userlevel").html('<option	value="1">Operador</option><option value="2" selected>Estoquista</option><option	value="9">Administrador</option><option value="10">Super Administrador</option>');
                    break;
                    default:
                    $("#userlevel").html('<option	value="1" selected>Operador</option><option value="2">Estoquista</option><option	value="9">Administrador</option><option value="10">Super Administrador</option>');
                    break;
                }
            }
        }); 
    });

	//Abre a modal do remover usuário
	$(".deleteUser").click(function(){
		$('.delete').css('display', 'flex');
	});
	
	//Abre a modal do novo usuário
	$(".newUser").click(function(){
		$('.new').css('display', 'flex');
	});
		
	//Abre a modal do editar cliente
	$(document).on('click', '.editClient', function(e){
        e.preventDefault();
        var value = $(this).attr('data-id');
        $('.modal').css('display', 'flex');
        $('#client_id').val(value);
    
        // Trazer os dados para o formulário de modal de edição de dados
    
        var url = page + "Ajax/Clientes/Search.php?val=" + value;
    
        $.ajax({
            url: url,
            type: 'POST',
            data: { value: value },
            dataType: 'JSON',
            success: function (data, textStatus, jqXHR) {
                // Alimenta o formulário na modal "editar clientes"
                $('#client').val(data['client']);
                $('#email').val(data['email']); 
                $('#phone').val(data['phone']); 
                $('#zipcode').val(data['zipcode']); 
                $('#address').val(data['address']); 
                $('#number').val(data['number']);
                $('#neighborhood').val(data['neighborhood']); 
                $('#city').val(data['city']); 
                $('#state').val(data['state']); 
                // Trabalhar com o doc
                if(data['doc'] == 1){
                    $("#cpf").val(data['document']);
                    $("#doc").html('<option	value="1" selected>CPF</option><option value="2">CNPJ</option>');
                    $('.cpf').css('display', 'block');
                    $('.cnpj').css('display', 'none');
                } else {
                    $("#cnpj").val(data['document']);
                    $("#doc").html('<option	value="2" selected>CNPJ</option><option value="1">CPF</option>');
                    $('.cpf').css('display', 'none');
                    $('.cnpj').css('display', 'block');
                }
            }
        });
    });
    
	//Abre a modal do remover usuario
	$(document).on('click', '.deleteUser', function(e){
        e.preventDefault();
		$('.delete').css('display', 'flex');
        var value = $('.deleteUser').attr('data-id');
        $('.removeUser').attr('data-id', value);
	});
    //Abre a modal do remover cliente
    $(document).on('click', '.deleteClient', function(e){
        e.preventDefault();

        $('.delete').css('display', 'flex');
        var value = $('.deleteClient').attr('data-id');
        $('.removeClient').attr('data-id', value);
    });
	//Abre a modal do novo cliente
	$(".newClient").click(function(){
		$('.new').css('display', 'flex');
	});
	
	
	//Abre a modal do editar fornecedor
    $(document).on('click', '.editProvider', function(e){
        e.preventDefault();
        var value = $(this).attr('data-id');
        $('.modal').css('display', 'flex');
        $('#provider_id').val(value);
    
        // Trazer os dados para o formulário de modal de edição de dados
    
        var url = page + "Ajax/Fornecedores/Search.php?val=" + value;
    
        $.ajax({
            url: url,
            type: 'POST',
            data: { value: value },
            dataType: 'JSON',
            success: function (data, textStatus, jqXHR) {
                // Alimenta o formulário na modal "editar fornecedores"
                $('#provider_id').val(data['provider_id']);
                $('#company').val(data['nome']);
                $('#email').val(data['email']); 
                $('#phone').val(data['phone']); 
                $('#zipcode').val(data['zipcode']); 
                $('#address').val(data['address']); 
                $('#number').val(data['number']);
                $('#neighborhood').val(data['neighborhood']); 
                $('#city').val(data['city']); 
                $('#state').val(data['state']); 
                $("#cnpj").val(data['document']);                    
            }
        });
    });
	
	//Abre a modal do remover fornecedor
	$(document).on('click', '.deleteProvider', function(e){
        e.preventDefault();
		$('.delete').css('display', 'flex');
        var value = $('.deleteProvider').attr('data-id');
        $('.removeProvider').attr('data-id', value);
	});
	
	//Abre a modal do novo fornecedor
	$(".newProvider").click(function(){
		$('.new').css('display', 'flex');
	});
	
	
	//Abre a modal do nova categoria
	$(".newCategory").click(function(){
		$('.category').css('display', 'flex');
	});
	
	//Abre a modal do editar produto
	$(document).on('click', '.editProduct', function(e){
        e.preventDefault();
        var value = $(this).attr('data-id');
        $('.modal').css('display', 'flex');
        $('#product_id').val(value);
    
        // Trazer os dados para o formulário de modal de edição de dados
    
        var url = page + "Ajax/Produtos/Search.php?val=" + value;
    
        $.ajax({
            url: url,
            type: 'POST',
            data: { value: value },
            dataType: 'JSON',
            success: function (data, textStatus, jqXHR) {
                // Alimenta o formulário na modal "editar fornecedores"
                $('#product_id').val(data[0]['product_id']);
                $('#productEdit').val(data[0]['product']);
                $('#quantityEdit').val(data[0]['quantity']); 
                $('#priceEdit').val(data[0]['price']);         
                
                //Para limpar o select
                $('#categoryEdit').html('');
                for(var i in data){
                    if(data[i]['category_id'] == data[0]['product_category']){
                        var options = "<option value='"+ data[i]['category_id'] + "'selected>" + data[i]['category'] + "</option>"; 
                        $('#categoryEdit').prepend(options); 
                    }else{
                        var options = "<option value='"+ data[i]['category_id'] + "'>" + data[i]['category'] + "</option>"; 
                        $('#categoryEdit').prepend(options); 
                    }
                }
            }
        });
    });
	
	//Abre a modal do remover produto
    $(document).on('click', '.deleteProduct', function(e){
        e.preventDefault();

        $('.delete').css('display', 'flex');
        var value = $('.deleteProduct').attr('data-id');
        $('.removeProduct').attr('data-id', value);
    });
	
	//Abre a modal do novo produto
	$(".newProduct").click(function(){
		$('.new').css('display', 'flex');
	});
	
	
	//Abre a modal do editar pedidos
	$(".editOrder").click(function(){
		$('.modal').css('display', 'flex');
	});
	
	//Abre a modal do remover pedidos
	$(".deleteOrder").click(function(){
		$('.delete').css('display', 'flex');
	});
	
	//Abre a modal do novo pedidos
	$(".newOrder").click(function(){
		$('.new').css('display', 'flex');
	});
	
	
	//Abre a modal do visualizar pedido - OS
	$(".viewOrder").click(function(){
		$('.new').css('display', 'flex');
	});
	
	
	//Abre a modal do editar estoque
	$(".editStock").click(function(){
		$('.modal').css('display', 'flex');
	});
	
	//Abre a modal do remover estoque
	$(".deleteStock").click(function(){
		$('.delete').css('display', 'flex');
	});
	
	//Abre a modal do novo estoque
	$(".newStock").click(function(){
		$('.new').css('display', 'flex');
	});
});

//AUTOCARREGAMENTO DE IMAGENS - PREVIEW
var loadFile = function(event){
    var reader = new FileReader();
    reader.onload = function(){
        var output = document.getElementById("loadPhoto");
        output.src = reader.result;
    }
    reader.readAsDataURL(event.target.files[0]);
};

//INTERVALO DE TEMPO - MODAIS
setInterval(function(){
    $(".notification-container").fadeOut(1000);
}, 5000);

//TABELAS ZEBRADAS
$("table tbody tr:odd").css("background-color", "#d2d2d2");
$("table tbody tr:even").css("background-color", "#e4e4e4");
$("table tbody td").css("padding", "10px 20px");

/*RG - Permitir somente números */
$(function(){
	/*$(".rg").on('input', function (e) {
		$(this).val($(this).val().replace(/[^0-9]/g, ''));
	});*/
});

//VALIDAR CPF
function CPF(){"user_strict";function r(r){
    for(var t=null,n=0;9>n;++n)t+=r.toString().charAt(n)*(10-n);var i=t%11;return i=2>i?0:11-i}function t(r){
    for(var t=null,n=0;10>n;++n)t+=r.toString().charAt(n)*(11-n);var i=t%11;return i=2>i?0:11-i}var n="(CPF Inválido)",
    i="";this.gera=function(){for(var n="",i=0;9>i;++i)n+=Math.floor(9*Math.random())+"";var o=r(n),a=n+"-"+o+t(n+""+o);
    return a},this.valida=function(o){for(var a=o.replace(/\D/g,""),u=a.substring(0,9),f=a.substring(9,11),v=0;10>v;v++)
    if(""+u+f==""+v+v+v+v+v+v+v+v+v+v+v)return n;var c=r(u),e=t(u+""+c);return f.toString()===c.toString()+e.toString()?i:n}}

var CPF = new CPF();
$(".cpf").keypress(function(){
    $("#validateCPF").html(CPF.valida($(this).val()));
});

$(".cpf").blur(function(){
    $("#validateCPF").html(CPF.valida($(this).val()));
});

//VALIDAR CNPJ
function cnpj(cnpj) {

    cnpj = cnpj.replace(/[^\d]+/g, '');

    if (cnpj == '') return false;

    if (cnpj.length != 14)
        return false;


    if (cnpj == "00000000000000" ||
        cnpj == "11111111111111" ||
        cnpj == "22222222222222" ||
        cnpj == "33333333333333" ||
        cnpj == "44444444444444" ||
        cnpj == "55555555555555" ||
        cnpj == "66666666666666" ||
        cnpj == "77777777777777" ||
        cnpj == "88888888888888" ||
        cnpj == "99999999999999")
        return false;


    tamanho = cnpj.length - 2
    numeros = cnpj.substring(0, tamanho);
    digitos = cnpj.substring(tamanho);
    soma = 0;
    pos = tamanho - 7;
    for (i = tamanho; i >= 1; i--) {
        soma += numeros.charAt(tamanho - i) * pos--;
        if (pos < 2)
            pos = 9;
    }
    resultado = soma % 11 < 2 ? 0 : 11 - soma % 11;
    if (resultado != digitos.charAt(0)) return false;
    tamanho = tamanho + 1;
    numeros = cnpj.substring(0, tamanho);
    soma = 0;
    pos = tamanho - 7;
    for (i = tamanho; i >= 1; i--) {
        soma += numeros.charAt(tamanho - i) * pos--;
        if (pos < 2)
            pos = 9;
    }
    resultado = soma % 11 < 2 ? 0 : 11 - soma % 11;
    if (resultado != digitos.charAt(1))
        return false;

    return true;

}

function validarCNPJ(el){
    if(cnpj(el.value) == false){
        $("#validateCNPJ").html('(CNPJ Inválido)');
    }else{
        $("#validateCNPJ").html('');
    }
}

/* MÁSCARA DE CEP 1*/
jQuery("input.zipcode")
    .mask("99999-999")
    .focusout(function(event){
        var target, zipcode, element;
        target = (event.currentTarget) ? event.currentTarget : event.srcElement;
        zipcode = target.value.replace(/\D/g, '');
        element = $(target);
        element.unmask();

        if(zipcode.length > 9){
            element.mask("99999-999");
        }else{
            element.mask("99999-999");
        }
    });


/* MÁSCARA DE TELEFONE */
jQuery("input.phone")
    .mask("(99) 9999-9999?9")
    .focusout(function(event){
        var target, phone, element;
        target = (event.currentTarget) ? event.currentTarget : event.srcElement;
        phone = target.value.replace(/\D/g, '');
        element = $(target);
        element.unmask();

        if(phone.length > 10){
            element.mask("(99) 99999-999?9");
        }else{
            element.mask("(99) 9999-9999?9");
        }
    });

/* MÁSCARA DE DATA */
jQuery("input.datebirth")
    .mask("99/99/9999")
    .focusout(function(event){
        var target, datebirth, element;
        target = (event.currentTarget) ? event.currentTarget : event.srcElement;
        datebirth = target.value.replace(/\D/g, '');
        element = $(target);
        element.unmask();

        if(datebirth.length > 10){
            element.mask("99/99/9999");
        }else{
            element.mask("99/99/9999");
        }
    });

/* MÁSCARA DE CPF */
jQuery("input.cpf")
    .mask("999.999.999-99")
    .focusout(function(event){
        var target, cpf, element;
        target = (event.currentTarget) ? event.currentTarget : event.srcElement;
        cpf = target.value.replace(/\D/g, '');
        element = $(target);
        element.unmask();

        if(cpf.length > 14){
            element.mask("999.999.999-99");
        }else{
            element.mask("999.999.999-99");
        }
    });

/* MÁSCARA DE CNPJ */
jQuery("input.cnpj")
    .mask("99.999.999/9999-99")
    .focusout(function(event){
        var target, cnpj, element;
        target = (event.currentTarget) ? event.currentTarget : event.srcElement;
        cnpj = target.value.replace(/\D/g, '');
        element = $(target);
        element.unmask();

        if(cnpj.length > 18){
            element.mask("99.999.999/9999-99");
        }else{
            element.mask("99.999.999/9999-99");
        }
    });

/* MÁSCARA DE MOEDA */
$(".money").maskMoney();