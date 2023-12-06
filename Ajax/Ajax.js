$(document).ready(function(){
    // Captura o url pelo meta base
    var page = $('meta[name=base]').attr('content');

    /* 
    * Cliente
    */

    // Consultar cliente
    $('body').on('click', "#btn_search", function(e){
        e.preventDefault();

        var form = $("#form_search");
        var form_data = form.serialize();

        var url = page+"Ajax/Clientes/Read.php";

        $.ajax({
            url: url,
            type: 'POST',
            data: form_data,
            dataType: 'JSON',

            success: function (data, textStatus, jqXHR) {

                if (data['status'] == 'success') {
                    $(".result").text('');
                    $(".result").prepend('<div id="status-container" class="status-top-right text-center"><div class="status status-' + data['status'] + '"><div class="status-message"><i class="fa fa-user"></i> '+data['message']+'</div></div></div>');

                } else if (data['status'] == 'info') {
                    $(".result").text('');
                    $(".result").prepend('<div id="status-container" class="status-top-right text-center"><div class="status status-' + data['status'] + '"><div class="status-message"><i class="fa fa-info-circle"></i>  '+data['message']+'</div></div></div>');

                } else if (data['status'] == 'warning') {
                    $(".result").text('');
                    $(".result").prepend('<div id="status-container" class="status-top-right text-center"><div class="status status-' + data['status'] + '"><div class="status-message"><i class="fa fa-triangle-exclamation"></i>  '+data['message']+'</div></div></div>');

                } else {
                    $(".result").text('');
                    $(".result").prepend('<div id="status-container" class="status-top-right text-center"><div class="status status-' + data['status'] + '"><div class="status-message"><i class="fa fa-times-circle"></i>  '+data['message']+'</div></div></div>');
                }

                setTimeout(function () {
                    $('#status-container').hide();
                    $('.loading').css('display', 'none');
                }, 3000);

                // nao montar a tabela se o banco ou campo de pesquisa estiver vazio
                if(data['lines'] == 0){
                    $('.row').html('');
                    return false;
                }
                // Trabalhar com os dados do php
                var register = data['cliente_cadastro'];
                var stat = data['cliente_status'];

                var mount = '<tr></tr><td><p class="font-text-sub"><b>Cliente:</b></p><p>' + data['cliente_nome'] + '</p></td>\n' +
                    '<td><p class="font-text-sub"><b>Cadastrado:</b></p><p>' + register + '</p></td>\n' +
                    '<td><p class="font-text-sub"><b>E-mail:</b></p><p>' + data['cliente_email'] + '</p></td>\n' +
                    '<td><p class="font-text-sub"><b>Status:</b></p><p class="font-text-sub">' + stat + '</p></td>\n';


                    mount+='<td><p class="text-center"><a href="#" title="Visualizar e editar informações" class="radius btn_edit editClient" data-id="' + data['cliente_id'] + '"><i class="fa fa-pen"></i></a>&nbsp;&nbsp;<a href="#" title="Remover este registro" class="radius btn_delete deleteClient" data-id="' + data['cliente_id'] + '"><i class="fa fa-trash-alt"></i></a></p></td></tr>'


                $('.row').html(mount);
                
            }

        });
    }); 
    //Novo cliente

    // Atualizar dados do cliente

    // Remover cliente
    $(document).on('click', ".removeClient", function(e){
        e.preventDefault();

        var value = $(this).attr('data-id');
        var url = page+"Ajax/Clientes/Delete.php?val="+value;
		
        $.ajax({
            url: url,
            type: 'POST',
            data: value,
            dataType: 'JSON',

            success: function (data, textStatus, jqXHR) {

                if (data['status'] == 'success') {
                    $(".result").text('');
                    $(".result").prepend('<div id="status-container" class="status-top-right text-center"><div class="status status-' + data['status'] + '"><div class="status-message"><i class="fa fa-user"></i> '+data['message']+'</div></div></div>');

                } else if (data['status'] == 'info') {
                    $(".result").text('');
                    $(".result").prepend('<div id="status-container" class="status-top-right text-center"><div class="status status-' + data['status'] + '"><div class="status-message"><i class="fa fa-info-circle"></i>  '+data['message']+'</div></div></div>');

                } else if (data['status'] == 'warning') {
                    $(".result").text('');
                    $(".result").prepend('<div id="status-container" class="status-top-right text-center"><div class="status status-' + data['status'] + '"><div class="status-message"><i class="fa fa-triangle-exclamation"></i>  '+data['message']+'</div></div></div>');

                } else {
                    $(".result").text('');
                    $(".result").prepend('<div id="status-container" class="status-top-right text-center"><div class="status status-' + data['status'] + '"><div class="status-message"><i class="fa fa-times-circle"></i>  '+data['message']+'</div></div></div>');
                }

                setTimeout(function () {
                    $('#status-container').hide();
                    $('.loading').css('display', 'none');
                    
                    if(data['redirect'] != ''){
                        window.location.href = data['redirect'];
                    }
                }, 3000);              
                 
            }
        });
    });
    // Editar cliente
    $("#form_editclient").on('submit', function (e) {
        e.preventDefault();
	
		var form = $("#form_editclient");
		var url = page+"Ajax/Clientes/Update.php";
		
        form.ajaxSubmit({
            url: url,
            data: form,
            dataType: 'json',
			contentType: false,
            processData: false,
         
            success: function (data) {
               if(data['status'] == 'success'){
                    $(".result").text('');
                    $(".result").prepend('<div id="status-container" class="status-top-right text-center"><div class="status status-'+data['status']+'"><div class="status-message"> <span class="fa fa-check-circle"></span>  '+data['message']+'</div></div></div>');

                }else if(data['status'] == 'info'){
                    $(".result").text('');
                    $(".result").prepend('<div id="status-container" class="status-top-right text-center"><div class="status status-'+data['status']+'"><div class="status-message"> <span class="fa fa-info-circle"></span>  '+data['message']+'</div></div></div>');

                }else if(data['status'] == 'warning'){
                    $(".result").text('');
                    $(".result").prepend('<div id="status-container" class="status-top-right text-center"><div class="status status-'+data['status']+'"><div class="status-message"> <span class="fa fa-triangle-exclamation"></span>  '+data['message']+'</div></div></div>');

                } else {
                    $(".result").text('');
                    $(".result").prepend('<div id="status-container" class="status-top-right text-center"><div class="status status-'+data['status']+'"><div class="status-message"> <span class="fa fa-times-circle"></span>  '+data['message']+'</div></div></div>');
                }

                setTimeout(function () {
                    $('#status-container').hide();
                    $('.loading').hide();
					
                    if(data['redirect'] != ''){
                        window.location.href= data['redirect'];
                    }
                }, 3000); 
            }
        });
        return false;
    });
    // Criar novo registro com anexos
    $("#form_clientNew").on('submit', function (e) {
        e.preventDefault();
	
		var form = $("#form_clientNew");
		var url = page+"Ajax/Clientes/Create.php";
		
        form.ajaxSubmit({
            url: url,
            data: form,
            dataType: 'json',
			contentType: false,
            processData: false,
         
            success: function (data) {
               if(data['status'] == 'success'){
                    $(".result").text('');
                    $(".result").prepend('<div id="status-container" class="status-top-right text-center"><div class="status status-'+data['status']+'"><div class="status-message"> <span class="fa fa-check-circle"></span>  '+data['message']+'</div></div></div>');

                }else if(data['status'] == 'info'){
                    $(".result").text('');
                    $(".result").prepend('<div id="status-container" class="status-top-right text-center"><div class="status status-'+data['status']+'"><div class="status-message"> <span class="fa fa-info-circle"></span>  '+data['message']+'</div></div></div>');

                }else if(data['status'] == 'warning'){
                    $(".result").text('');
                    $(".result").prepend('<div id="status-container" class="status-top-right text-center"><div class="status status-'+data['status']+'"><div class="status-message"> <span class="fa fa-triangle-exclamation"></span>  '+data['message']+'</div></div></div>');

                } else {
                    $(".result").text('');
                    $(".result").prepend('<div id="status-container" class="status-top-right text-center"><div class="status status-'+data['status']+'"><div class="status-message"> <span class="fa fa-times-circle"></span>  '+data['message']+'</div></div></div>');
                }

                setTimeout(function () {
                    $('#status-container').hide();
                    $('.loading').hide();
					
                    if(data['redirect'] != ''){
                        window.location.href= data['redirect'];
                    }
                }, 3000); 
            }
        });
        return false;
    });
    /* 
    * Usuários
    */

    // Consultar Usuário
    $('body').on('click', "#btn_user", function(e){
        e.preventDefault();

        var form = $("#form_search");
        var form_data = form.serialize();

        var url = page+"Ajax/Usuarios/Read.php";

        $.ajax({
            url: url,
            type: 'POST',
            data: form_data,
            dataType: 'JSON',

            success: function (data, textStatus, jqXHR) {

                if (data['status'] == 'success') {
                    $(".result").text('');
                    $(".result").prepend('<div id="status-container" class="status-top-right text-center"><div class="status status-' + data['status'] + '"><div class="status-message"><i class="fa fa-user"></i> '+data['message']+'</div></div></div>');

                } else if (data['status'] == 'info') {
                    $(".result").text('');
                    $(".result").prepend('<div id="status-container" class="status-top-right text-center"><div class="status status-' + data['status'] + '"><div class="status-message"><i class="fa fa-info-circle"></i>  '+data['message']+'</div></div></div>');

                } else if (data['status'] == 'warning') {
                    $(".result").text('');
                    $(".result").prepend('<div id="status-container" class="status-top-right text-center"><div class="status status-' + data['status'] + '"><div class="status-message"><i class="fa fa-triangle-exclamation"></i>  '+data['message']+'</div></div></div>');

                } else {
                    $(".result").text('');
                    $(".result").prepend('<div id="status-container" class="status-top-right text-center"><div class="status status-' + data['status'] + '"><div class="status-message"><i class="fa fa-times-circle"></i>  '+data['message']+'</div></div></div>');
                }

                setTimeout(function () {
                    $('#status-container').hide();
                    $('.loading').css('display', 'none');
                }, 3000);

                // nao montar a tabela se o banco ou campo de pesquisa estiver vazio
                if(data['lines'] == 0){
                    $('.row').html('');
                    return false;
                }
                // Trabalhar com os dados do php    
                var mount = '<tr></tr><td><p class="font-text-sub"><b>Usuário:</b></p><p>' + data['usuario_nome'] + '</p></td>\n' +
                    '<td><p class="font-text-sub"><b>Perfil:</b></p><p>' + data['usuario_nivel'] + '</p></td>\n' +
                    '<td><p class="font-text-sub"><b>E-mail:</b></p><p>' + data['usuario_email'] + '</p></td>\n' +
                    '<td><p class="font-text-sub"><b>Status:</b></p><p class="font-text-sub"><span class="btn_edit radius" style=padding:3px 4px !important;">' + data['usuario_status'] + '</span></p></td>\n';


                    mount+='<td><p class="text-center"><a href="#" title="Visualizar e editar informações" class="radius btn_edit editUser" data-id="' + data['usuario_id'] + '"><i class="fa fa-pen"></i></a>&nbsp;&nbsp;<a href="#" title="Remover este registro" class="radius btn_delete deleteUser" data-id="' + data['usuario_id'] + '"><i class="fa fa-trash-alt"></i></a></p></td></tr>'


                $('.row').html(mount);
                
            }

        });
    }); 
    // Criar novo registro com Anexos
    $("#form_newUser").on('submit', function (e) {
        e.preventDefault();
	
		var form = $("#form_newUser");
		var url = page+"Ajax/Usuarios/Create.php";
		
        form.ajaxSubmit({
            url: url,
            data: form,
            dataType: 'json',
			contentType: false,
            processData: false,
         
            success: function (data) {
               if(data['status'] == 'success'){
                    $(".result").text('');
                    $(".result").prepend('<div id="status-container" class="status-top-right text-center"><div class="status status-'+data['status']+'"><div class="status-message"> <span class="fa fa-check-circle"></span>  '+data['message']+'</div></div></div>');

                }else if(data['status'] == 'info'){
                    $(".result").text('');
                    $(".result").prepend('<div id="status-container" class="status-top-right text-center"><div class="status status-'+data['status']+'"><div class="status-message"> <span class="fa fa-info-circle"></span>  '+data['message']+'</div></div></div>');

                }else if(data['status'] == 'warning'){
                    $(".result").text('');
                    $(".result").prepend('<div id="status-container" class="status-top-right text-center"><div class="status status-'+data['status']+'"><div class="status-message"> <span class="fa fa-triangle-exclamation"></span>  '+data['message']+'</div></div></div>');

                } else {
                    $(".result").text('');
                    $(".result").prepend('<div id="status-container" class="status-top-right text-center"><div class="status status-'+data['status']+'"><div class="status-message"> <span class="fa fa-times-circle"></span>  '+data['message']+'</div></div></div>');
                }

                setTimeout(function () {
                    $('#status-container').hide();
                    $('.loading').hide();
					
                    if(data['redirect'] != ''){
                        window.location.href= data['redirect'];
                    }
                }, 3000); 
            }
        });
        return false;
    });
    // Remover Usuario
    $(document).on('click', ".removeUser", function(e){
        e.preventDefault();

        var value = $(this).attr('data-id');
        var url = page+"Ajax/Usuarios/Delete.php?val="+value;
        
        $.ajax({
            url: url,
            type: 'POST',
            data: value,
            dataType: 'JSON',

            success: function (data, textStatus, jqXHR) {

                if (data['status'] == 'success') {
                    $(".result").text('');
                    $(".result").prepend('<div id="status-container" class="status-top-right text-center"><div class="status status-' + data['status'] + '"><div class="status-message"><i class="fa fa-user"></i> '+data['message']+'</div></div></div>');

                } else if (data['status'] == 'info') {
                    $(".result").text('');
                    $(".result").prepend('<div id="status-container" class="status-top-right text-center"><div class="status status-' + data['status'] + '"><div class="status-message"><i class="fa fa-info-circle"></i>  '+data['message']+'</div></div></div>');

                } else if (data['status'] == 'warning') {
                    $(".result").text('');
                    $(".result").prepend('<div id="status-container" class="status-top-right text-center"><div class="status status-' + data['status'] + '"><div class="status-message"><i class="fa fa-triangle-exclamation"></i>  '+data['message']+'</div></div></div>');

                } else {
                    $(".result").text('');
                    $(".result").prepend('<div id="status-container" class="status-top-right text-center"><div class="status status-' + data['status'] + '"><div class="status-message"><i class="fa fa-times-circle"></i>  '+data['message']+'</div></div></div>');
                }

                setTimeout(function () {
                    $('#status-container').hide();
                    $('.loading').css('display', 'none');
                    
                    if(data['redirect'] != ''){
                        window.location.href = data['redirect'];
                    }
                }, 3000);              
                    
            }
        });
    });
    // Editar Usuario
    $("#form_editUser").on('submit', function (e) {
        e.preventDefault();
    
        var form = $("#form_editUser");
        var url = page+"Ajax/Usuarios/Update.php";
        
        form.ajaxSubmit({
            url: url,
            data: form,
            dataType: 'json',
            contentType: false,
            processData: false,
            
            success: function (data) {
                if(data['status'] == 'success'){
                    $(".result").text('');
                    $(".result").prepend('<div id="status-container" class="status-top-right text-center"><div class="status status-'+data['status']+'"><div class="status-message"> <span class="fa fa-check-circle"></span>  '+data['message']+'</div></div></div>');

                }else if(data['status'] == 'info'){
                    $(".result").text('');
                    $(".result").prepend('<div id="status-container" class="status-top-right text-center"><div class="status status-'+data['status']+'"><div class="status-message"> <span class="fa fa-info-circle"></span>  '+data['message']+'</div></div></div>');

                }else if(data['status'] == 'warning'){
                    $(".result").text('');
                    $(".result").prepend('<div id="status-container" class="status-top-right text-center"><div class="status status-'+data['status']+'"><div class="status-message"> <span class="fa fa-triangle-exclamation"></span>  '+data['message']+'</div></div></div>');

                } else {
                    $(".result").text('');
                    $(".result").prepend('<div id="status-container" class="status-top-right text-center"><div class="status status-'+data['status']+'"><div class="status-message"> <span class="fa fa-times-circle"></span>  '+data['message']+'</div></div></div>');
                }

                setTimeout(function () {
                    $('#status-container').hide();
                    $('.loading').hide();
                    
                    if(data['redirect'] != ''){
                        window.location.href= data['redirect'];
                    }
                }, 3000); 
            }
        });
        return false;
    });

    /* 
    * Fornecedores
    */

    // Consultar Fornecedor
    $('body').on('click', "#btn_search_providers", function(e){
        e.preventDefault();

        var form = $("#form_search_providers");
        var form_data = form.serialize();

        var url = page+"Ajax/Fornecedores/Read.php";

        $.ajax({
            url: url,
            type: 'POST',
            data: form_data,
            dataType: 'JSON',

            success: function (data, textStatus, jqXHR) {

                if (data['status'] == 'success') {
                    $(".result").text('');
                    $(".result").prepend('<div id="status-container" class="status-top-right text-center"><div class="status status-' + data['status'] + '"><div class="status-message"><i class="fa fa-user"></i> '+data['message']+'</div></div></div>');

                } else if (data['status'] == 'info') {
                    $(".result").text('');
                    $(".result").prepend('<div id="status-container" class="status-top-right text-center"><div class="status status-' + data['status'] + '"><div class="status-message"><i class="fa fa-info-circle"></i>  '+data['message']+'</div></div></div>');

                } else if (data['status'] == 'warning') {
                    $(".result").text('');
                    $(".result").prepend('<div id="status-container" class="status-top-right text-center"><div class="status status-' + data['status'] + '"><div class="status-message"><i class="fa fa-triangle-exclamation"></i>  '+data['message']+'</div></div></div>');

                } else {
                    $(".result").text('');
                    $(".result").prepend('<div id="status-container" class="status-top-right text-center"><div class="status status-' + data['status'] + '"><div class="status-message"><i class="fa fa-times-circle"></i>  '+data['message']+'</div></div></div>');
                }

                setTimeout(function () {
                    $('#status-container').hide();
                    $('.loading').css('display', 'none');
                }, 3000);

                // nao montar a tabela se o banco ou campo de pesquisa estiver vazio
                if(data['lines'] == 0){
                    $('.row').html('');
                    return false;
                }
                // Trabalhar com os dados do php    
                var mount = '<tr></tr><td><p class="font-text-sub"><b>Fornecedor:</b></p><p>' + data['fornecedor_nome'] + '</p></td>\n' +
                    '<td><p class="font-text-sub"><b>Cadastro:</b></p><p>' + data['created'] + '</p></td>\n' +
                    '<td><p class="font-text-sub"><b>E-mail:</b></p><p>' + data['fornecedor_email'] + '</p></td>\n' +
                    '<td><p class="font-text-sub"><b>Status:</b></p><p class="font-text-sub"><span class="btn_edit radius" style=padding:3px 4px !important;">' + data['fornecedor_status'] + '</span></p></td>\n';


                    mount+='<td><p class="text-center"><a href="#" title="Visualizar e editar informações" class="radius btn_edit editUser" data-id="' + data['fornecedor_id'] + '"><i class="fa fa-pen"></i></a>&nbsp;&nbsp;<a href="#" title="Remover este registro" class="radius btn_delete deleteUser" data-id="' + data['fornecedor_id'] + '"><i class="fa fa-trash-alt"></i></a></p></td></tr>'


                $('.row').html(mount);
                
            }

        });
    }); 
    // Criar novo registro com Anexos
    $("#form_newUser").on('submit', function (e) {
        e.preventDefault();
	
		var form = $("#form_newUser");
		var url = page+"Ajax/Usuarios/Create.php";
		
        form.ajaxSubmit({
            url: url,
            data: form,
            dataType: 'json',
			contentType: false,
            processData: false,
         
            success: function (data) {
               if(data['status'] == 'success'){
                    $(".result").text('');
                    $(".result").prepend('<div id="status-container" class="status-top-right text-center"><div class="status status-'+data['status']+'"><div class="status-message"> <span class="fa fa-check-circle"></span>  '+data['message']+'</div></div></div>');

                }else if(data['status'] == 'info'){
                    $(".result").text('');
                    $(".result").prepend('<div id="status-container" class="status-top-right text-center"><div class="status status-'+data['status']+'"><div class="status-message"> <span class="fa fa-info-circle"></span>  '+data['message']+'</div></div></div>');

                }else if(data['status'] == 'warning'){
                    $(".result").text('');
                    $(".result").prepend('<div id="status-container" class="status-top-right text-center"><div class="status status-'+data['status']+'"><div class="status-message"> <span class="fa fa-triangle-exclamation"></span>  '+data['message']+'</div></div></div>');

                } else {
                    $(".result").text('');
                    $(".result").prepend('<div id="status-container" class="status-top-right text-center"><div class="status status-'+data['status']+'"><div class="status-message"> <span class="fa fa-times-circle"></span>  '+data['message']+'</div></div></div>');
                }

                setTimeout(function () {
                    $('#status-container').hide();
                    $('.loading').hide();
					
                    if(data['redirect'] != ''){
                        window.location.href= data['redirect'];
                    }
                }, 3000); 
            }
        });
        return false;
    });
    // Remover Usuario
    $(document).on('click', ".removeUser", function(e){
        e.preventDefault();

        var value = $(this).attr('data-id');
        var url = page+"Ajax/Usuarios/Delete.php?val="+value;
        
        $.ajax({
            url: url,
            type: 'POST',
            data: value,
            dataType: 'JSON',

            success: function (data, textStatus, jqXHR) {

                if (data['status'] == 'success') {
                    $(".result").text('');
                    $(".result").prepend('<div id="status-container" class="status-top-right text-center"><div class="status status-' + data['status'] + '"><div class="status-message"><i class="fa fa-user"></i> '+data['message']+'</div></div></div>');

                } else if (data['status'] == 'info') {
                    $(".result").text('');
                    $(".result").prepend('<div id="status-container" class="status-top-right text-center"><div class="status status-' + data['status'] + '"><div class="status-message"><i class="fa fa-info-circle"></i>  '+data['message']+'</div></div></div>');

                } else if (data['status'] == 'warning') {
                    $(".result").text('');
                    $(".result").prepend('<div id="status-container" class="status-top-right text-center"><div class="status status-' + data['status'] + '"><div class="status-message"><i class="fa fa-triangle-exclamation"></i>  '+data['message']+'</div></div></div>');

                } else {
                    $(".result").text('');
                    $(".result").prepend('<div id="status-container" class="status-top-right text-center"><div class="status status-' + data['status'] + '"><div class="status-message"><i class="fa fa-times-circle"></i>  '+data['message']+'</div></div></div>');
                }

                setTimeout(function () {
                    $('#status-container').hide();
                    $('.loading').css('display', 'none');
                    
                    if(data['redirect'] != ''){
                        window.location.href = data['redirect'];
                    }
                }, 3000);              
                    
            }
        });
    });
    // Editar Usuario
    $("#form_editUser").on('submit', function (e) {
        e.preventDefault();
    
        var form = $("#form_editUser");
        var url = page+"Ajax/Usuarios/Update.php";
        
        form.ajaxSubmit({
            url: url,
            data: form,
            dataType: 'json',
            contentType: false,
            processData: false,
            
            success: function (data) {
                if(data['status'] == 'success'){
                    $(".result").text('');
                    $(".result").prepend('<div id="status-container" class="status-top-right text-center"><div class="status status-'+data['status']+'"><div class="status-message"> <span class="fa fa-check-circle"></span>  '+data['message']+'</div></div></div>');

                }else if(data['status'] == 'info'){
                    $(".result").text('');
                    $(".result").prepend('<div id="status-container" class="status-top-right text-center"><div class="status status-'+data['status']+'"><div class="status-message"> <span class="fa fa-info-circle"></span>  '+data['message']+'</div></div></div>');

                }else if(data['status'] == 'warning'){
                    $(".result").text('');
                    $(".result").prepend('<div id="status-container" class="status-top-right text-center"><div class="status status-'+data['status']+'"><div class="status-message"> <span class="fa fa-triangle-exclamation"></span>  '+data['message']+'</div></div></div>');

                } else {
                    $(".result").text('');
                    $(".result").prepend('<div id="status-container" class="status-top-right text-center"><div class="status status-'+data['status']+'"><div class="status-message"> <span class="fa fa-times-circle"></span>  '+data['message']+'</div></div></div>');
                }

                setTimeout(function () {
                    $('#status-container').hide();
                    $('.loading').hide();
                    
                    if(data['redirect'] != ''){
                        window.location.href= data['redirect'];
                    }
                }, 3000); 
            }
        });
        return false;
    });
    
    //Login
    $('body').on('click', "#btn_login", function(e){
        e.preventDefault();
        
        var form = $("#form_login");
        var form_data = form.serialize();
        var url = page+"Ajax/Login/Login.php";
        $.ajax({
            url: url,
            type:'POST',
            data: form_data,
            dataType: 'JSON',
            
            success: function(data, textStatus, jqXHR){
                switch (data['status']) {
                    case 'success':
                        $(".result").text('');
                        $(".result").prepend('<div class="status-top-right text-center" id="status-container"><div class="status status-' + data['status'] + '"><div class="status-message"><span class="fa fa-check-circle"></span>' + data['message'] + '</span></div></div></div>');
                        $("#form_login")[0].reset(); 
                        break;
                
                    case 'info':
                        $(".result").text('');
                        $(".result").prepend('<div class="status-top-right text-center" id="status-container"><div class="status status-' + data['status'] + '"><div class="status-message"><span class="fa fa-info-circle"></span>' + data['message'] + '</span></div></div></div>');
                        $("#form_login")[0].reset(); 
                        break;
                
                    case 'warning':
                        $(".result").text('');
                        $(".result").prepend('<div class="status-top-right text-center" id="status-container"><div class="status status-' + data['status'] + '"><div class="status-message"><span class="fa fa-info-circle"></span>' + data['message'] + '</span></div></div></div>');
                        $("#form_login")[0].reset(); 
                        break;
                
                    default:
                        $(".result").text('');
                        $(".result").prepend('<div class="status-top-right text-center" id="status-container"><div class="status status-' + data['status'] + '"><div class="status-message"><span class="fa fa-times-circle"></span>' + data['message'] + '</span></div></div></div>');
                        $("#form_login")[0].reset(); 
                }
                setTimeout(function(){
                    $("#status-container").hide();
                    if(data['redirect'] != ''){
                        window.location.href= data['redirect'];
                    }					
                }, 1500);
            }
        });
    });
    //Logout
    $('body').on('click', "#logout", function(e){
        e.preventDefault();
        
        var form_data = $('a').attr('id');
        var data = 'action=logout';
        var url = page+"Ajax/Login/Logout.php";

        $.ajax({
            url: url,
            type:'GET',
            data: data,
            dataType: 'JSON',
            
            success: function(data, textStatus, jqXHR){
                switch (data['status']) {
                    case 'success':
                        $(".result").text('');
                        $(".result").prepend('<div class="status-top-right text-center" id="status-container"><div class="status status-' + data['status'] + '"><div class="status-message"><span class="fa fa-check-circle"></span>' + data['message'] + '</span></div></div></div>');	
                        break;
                
                    case 'info':
                        $(".result").text('');
                        $(".result").prepend('<div class="status-top-right text-center" id="status-container"><div class="status status-' + data['status'] + '"><div class="status-message"><span class="fa fa-info-circle"></span>' + data['message'] + '</span></div></div></div>');	
                        break;
                
                    case 'warning':
                        $(".result").text('');
                        $(".result").prepend('<div class="status-top-right text-center" id="status-container"><div class="status status-' + data['status'] + '"><div class="status-message"><span class="fa fa-info-circle"></span>' + data['message'] + '</span></div></div></div>');	
                        break;
                
                    default:
                        $(".result").text('');
                        $(".result").prepend('<div class="status-top-right text-center" id="status-container"><div class="status status-' + data['status'] + '"><div class="status-message"><span class="fa fa-times-circle"></span>' + data['message'] + '</span></div></div></div>');	
                }
                setTimeout(function(){
                    $("#status-container").hide();
                    if(data['redirect'] != ''){
                        window.location.href= data['redirect'];
                    }					
                }, 1500);
            }
        });
    });

    //Recuperação de Senha
    $('body').on('click', "#btn_password", function(e){
        e.preventDefault();
        
        var form = $("#form_password");
        var form_data = form.serialize();
        var url = page+"Ajax/Login/Recovery.php";

        $.ajax({
            url: url,
            type:'POST',
            data: form_data,
            dataType: 'JSON',
            
            success: function(data, textStatus, jqXHR){
                switch (data['status']) {
                    case 'success':
                        $(".result").text('');
                        $(".result").prepend('<div class="status-top-right text-center" id="status-container"><div class="status status-' + data['status'] + '"><div class="status-message"><span class="fa fa-check-circle"></span>' + data['message'] + '</span></div></div></div>');
                        break;
                
                    case 'info':
                        $(".result").text('');
                        $(".result").prepend('<div class="status-top-right text-center" id="status-container"><div class="status status-' + data['status'] + '"><div class="status-message"><span class="fa fa-info-circle"></span>' + data['message'] + '</span></div></div></div>');
                        break;
                
                    case 'warning':
                        $(".result").text('');
                        $(".result").prepend('<div class="status-top-right text-center" id="status-container"><div class="status status-' + data['status'] + '"><div class="status-message"><span class="fa fa-info-circle"></span>' + data['message'] + '</span></div></div></div>');
                        break;
                
                    default:
                        $(".result").text('');
                        $(".result").prepend('<div class="status-top-right text-center" id="status-container"><div class="status status-' + data['status'] + '"><div class="status-message"><span class="fa fa-times-circle"></span>' + data['message'] + '</span></div></div></div>');
                }
                setTimeout(function(){
                    $("#status-container").hide();
                    if(data['redirect'] != ''){
                        window.location.href= data['redirect'];
                    }					
                }, 1500);
            }
        });
    });		
    //Nova Senha
    $('body').on('click', "#btn_new_password", function(e){
        e.preventDefault();
        
        var form = $("#form_new_password");
        var form_data = form.serialize();
        var url = page+"Ajax/Login/New-Password.php";

        $.ajax({
            url: url,
            type:'POST',
            data: form_data,
            dataType: 'JSON',
            
            success: function(data, textStatus, jqXHR){
                switch (data['status']) {
                    case 'success':
                        $(".result").text('');
                        $(".result").prepend('<div class="status-top-right text-center" id="status-container"><div class="status status-' + data['status'] + '"><div class="status-message"><span class="fa fa-check-circle"></span>' + data['message'] + '</span></div></div></div>');
                        break;
                
                    case 'info':
                        $(".result").text('');
                        $(".result").prepend('<div class="status-top-right text-center" id="status-container"><div class="status status-' + data['status'] + '"><div class="status-message"><span class="fa fa-info-circle"></span>' + data['message'] + '</span></div></div></div>');
                        break;
                
                    case 'warning':
                        $(".result").text('');
                        $(".result").prepend('<div class="status-top-right text-center" id="status-container"><div class="status status-' + data['status'] + '"><div class="status-message"><span class="fa fa-info-circle"></span>' + data['message'] + '</span></div></div></div>');
                        break;
                
                    default:
                        $(".result").text('');
                        $(".result").prepend('<div class="status-top-right text-center" id="status-container"><div class="status status-' + data['status'] + '"><div class="status-message"><span class="fa fa-times-circle"></span>' + data['message'] + '</span></div></div></div>');
                }
                setTimeout(function(){
                    $("#status-container").hide();
                    if(data['redirect'] != ''){
                        window.location.href= data['redirect'];
                    }					
                }, 1500);
            }
        });
    });
});
