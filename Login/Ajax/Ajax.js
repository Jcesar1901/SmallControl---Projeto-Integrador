$(document).ready(function() {
    //Login
	$('body').on('click', "#btn_login", function(e){
		e.preventDefault();
		
		var form = $("#form_login");
		var form_data = form.serialize();
		var url = "Ajax/Login/Login.php";
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
		var url = "../Ajax/Login/Logout.php";

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
		var url = "Ajax/Login/Recovery.php";

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
		var url = "Ajax/Login/New-Password.php";

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
