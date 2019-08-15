<!-- Bootstrap core JavaScript -->
<script src="vendor/jquery/jquery.min.js"></script>
<script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

<?php if($pagina_atual == 'cadastro.php'): ?>

	<script src="js/plugins/jquery.validate.min.js"></script>
	<script src="js/plugins/additional-methods.min.js"></script>
	<script src="js/cadastro.js"></script>

<?php elseif($pagina_atual == 'index.php'): ?>

	<script src="js/votacao.js"></script>
	<script src="js/avisar.js"></script>
	<script src="js/plugins/jquery-confirm.min.js"></script>
<?php endif; ?>

<!-- Menu Toggle Script -->
<script>
  $("#menu-toggle").click(function(e) {
    e.preventDefault();
    $("#wrapper").toggleClass("toggled");
  });
</script>