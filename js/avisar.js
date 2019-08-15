$(function(){
	$(".avisar").on('click', function(){
		$id = $(this).val();

		$.ajax({
			url: 'query/avisar.php',
			type: 'POST',
			dataType: 'json',
			data: {id: $id},
			success: function(xhr) {
				console.log(xhr);
				if(xhr.status === "enviado"){
					$.alert({
				    title: 'Tudo certo!',
				    content: xhr.mensagem,
				    type: 'green',
				    typeAnimated: true,
					});
				}
			}
		});
	});
});