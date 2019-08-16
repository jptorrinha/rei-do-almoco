<?php
include 'includes/header.php'; ?>
<div class="d-flex" id="wrapper">
  <!-- Sidebar -->
  <?php include 'includes/sidebar.php'; ?>
  <!-- /#sidebar-wrapper -->
  <!-- Page Content -->
  <div id="page-content-wrapper">
    <nav class="navbar navbar-expand-lg navbar-light bg-light border-bottom">
      <button class="btn btn-light" id="menu-toggle">
        <i class="fas fa-bars"></i>
      </button>
    </nav>
    <div class="container-fluid">
      <div class="container">
        <h2 class="mt-4">Cadastre-se</h2>
        <p>Preencha o cadastro para se candidatar ao Rei do Almoço</p>

        <div class="row">
          <div class="col-md-12">
            <form id="adicionar" class="form-cadastro" method="POST" enctype="multipart/form-data">
              <div class="form-group">
                <div class="row">
                  <div class="col-md-3">
                    <label for="foto">Selecione uma foto</label>
                  </div>
                  <div class="col-md-9">
                    <input type="file" class="form-control-file" id="foto" name="foto" required>
                  </div>
                </div>
              </div>
              <div class="form-group">
                <div class="row">
                  <div class="col-md-3">
                    <label for="nome">Preencha seu nome</label>
                  </div>
                  <div class="col-md-9">
                    <input type="text" class="form-control" id="nome" name="nome" placeholder="Nome do participante" required>
                  </div>
                </div>
              </div>
              <div class="form-group">
                <div class="row">
                  <div class="col-md-3">
                    <label for="nome">Preencha seu e-mail</label>
                  </div>
                  <div class="col-md-9">
                    <input type="email" class="form-control" id="email" name="email" placeholder="E-mail do participante" required>
                  </div>
                </div>
              </div>
              <div class="form-group">
                <button type="submit" class="btn btn-success btn-lg">Cadastrar</button>
              </div>
              <div class="form-group">
                <div class="retorno alert alert-success"></div>
                <div class="retorno alert alert-danger"></div>
              </div>
            </form>
          </div>
        </div>
      </div>
    </div>
  </div>
  <!-- /#page-content-wrapper -->
</div>
<!-- /#wrapper -->
<?php 
  include 'includes/plugins.php'; 
  include 'includes/footer.php';
?>
