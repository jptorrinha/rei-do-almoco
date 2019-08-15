$(function(){
	$(".pool .votar").on('click', function(){
		$id = $(this).val();

		$.ajax({
			url: 'query/votacao.php',
			type: 'POST',
			dataType: 'json',
			data: {id: $id},
			success: function(xhr) {
				if(xhr.status === "sucesso"){
					$.alert({
				    title: 'Sucesso!',
				    content: xhr.mensagem,
				    type: 'green',
				    typeAnimated: true,
					});
				}else{
					$.alert({
				    title: 'Ops!',
				    content: xhr.mensagem,
				    type: 'red',
				    typeAnimated: true,
					});
				}
			}
		});
	});
});