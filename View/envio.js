$(function(){
	$('#conectar').click(function(e){
		e.preventDefault():
		var user = $('#user').val();
		var password = $('#password').val();
		var database = $('#database').val();
		var table = $('#table').val();

		$.post('view.php', {
			user:user,
			password:password,
			database:database,
			table:table
		}, function(resposta){
			if(resposta==1){
				$('input').val('');
				alert('Conectado!');
			} else {
				alert(resposta);
			}
		});
	});
});