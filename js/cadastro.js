$("#adicionar").validate({
	rules: {
		nome:{
			required: true
		},
		email:{
			required: true
		},
		foto: {
			required: true,
			accept: "image/jpeg, image/jpg"
		}
	},
	messages: {
   	nome: { required: "O nome é obrigatório!" },
   	email: { required: "O E-mail é obrigatório!" },
   	foto: { 
   		required: "Sua foto é obrigatória!",
   		accept: "Formato inválido. Arquivo aceito apenas JPG!"
   	}
  },
  submitHandler: function(form,e) {
  	e.preventDefault();

  	var $form = $('.form-cadastro');
		var $inputs = $form.find("input, select, button, textarea");
		var FormDados = new FormData(document.querySelector(".form-cadastro"));
		$inputs.prop("disabled", true);

		$.ajax({
      url: "query/cadastro.php",
      type: "POST",
      data: FormDados,
      async: false,
      dataType: 'json',
      processData: false,
      contentType: false,
      success: function(xhr) {
      	console.log(xhr);

      	$inputs.prop("disabled", false);

	      if(xhr.status === "sucesso"){
	      	$(".alert.alert-success").show();
	      	$(".alert.alert-success").html(xhr.mensagem);
	      	setTimeout(function() {
		        $(".alert.alert-success").fadeOut();
		        window.location.reload();
		      }, 2000);
	      }else if(xhr.status === "erroCat" || xhr.status === "erro"){
	      	$(".alert.alert-danger").show();
	      	$(".alert.alert-danger").html(xhr.mensagem)
	      	setTimeout(function() {
		        $(".alert.alert-danger").fadeOut();
		      }, 2000);
	      }else if(xhr.status === "email_cadastrado"){
	      	$(".alert.alert-danger").show();
	      	$(".alert.alert-danger").html(xhr.mensagem);
	      	setTimeout(function() {
		        $(".alert.alert-danger").fadeOut();
		      }, 2000);
	      }
      }
    });
    return false;
	}
});