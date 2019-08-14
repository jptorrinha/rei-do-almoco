<?php 
  include 'config/config.php';
  //includes das querys de exibição e votação
  include 'query/votacao.php';
  include 'includes/header.php';

?>
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
    <?php if($time <= $horaShow): ?>
      <?php if($time >= $horaStart && $time <= $horaEnd): ?>
        <div class="container-fluid">
          <?php if($contador > 0): ?>
            <div class="container">
              <h2 class="mt-4">Votar</h2>
              <p>Para votar selecione um dos candidagos abaixo e clique em votar</p>
              <div class="row">
                <div class="col-md-12">
                  <table class="table table-hover">
                    <tbody>
                      <?php while ($candidato = $candidatos->fetch(PDO::FETCH_ASSOC)): ?>
                      <tr>
                        <td class="img">
                          <div class="img-thumbnail avatar-pool" style="background-image: url('<?php echo $candidato['foto']; ?>')"></div>
                        </td>
                        <td><?php echo $candidato['nome']; ?></td>
                        <td class="pool">
                          <button class="btn btn-info votar" value="<?php echo $candidato['id']; ?>">
                            <i class="fas fa-check"></i> Votar
                          </button>
                        </td>
                      </tr>
                      <?php endwhile; ?>
                    </tbody>
                  </table>
                </div>
              </div>
            </div>
          <?php else: ?>
            <div class="container">
              <p>Nenhum candidato encontrado!</p>
            </div>
          <?php endif; ?>
        </div>
      <?php endif; ?>
    <?php endif; ?>
    <?php if($time >= $horaShow): ?>
      <div class="container-fluid vencedor">
        <div class="container">
          <h2 class="mt-4"><i class="fas fa-crown"></i> Rei do Dia</h2>
          <p>Confira quem foi o vencedor da votação de hoje!</p>
          <div class="row">
            <div class="col-md-12">
              <table class="table">
                <tbody>
                  <tr>
                    <td class="img">
                      <img src="images/avatares/1.png" class="avatar-pool" alt="">
                    </td>
                    <td class="name">João da Silva</td>
                    <td class="votos">
                      <button class="btn btn-primary avisar">
                        <i class="far fa-share-square"></i> Avisar
                      </button>
                    </td>
                  </tr>
                </tbody>
              </table>
            </div>
          </div>
        </div>
      </div>
    <?php endif; ?>
    <div class="container-fluid">
      <div class="container">
        <h2 class="mt-4">Mais votados da última semana</h2>
        <div class="row">
          <div class="col-md-12">
            <table class="table table-hover">
              <tbody>
                <tr>
                  <td class="img">
                    <img src="images/avatares/1.png" class="avatar-pool" alt="">
                  </td>
                  <td>João da Silva</td>
                  <td class="votos">
                    <div class="btn btn-success">
                      <i class="fas fa-flag"></i> 1000
                    </div>
                  </td>
                </tr>
                <tr>
                  <td class="img">
                    <img src="images/avatares/2.png" class="avatar-pool" alt="">
                  </td>
                  <td>Maria da Costa</td>
                  <td class="votos">
                    <div class="btn btn-success">
                      <i class="fas fa-flag"></i> 1000
                    </div>
                  </td>
                </tr>
                <tr>
                  <td class="img">
                    <img src="images/avatares/3.png" class="avatar-pool" alt="">
                  </td>
                  <td>João Oliveira</td>
                  <td class="votos">
                    <div class="btn btn-success">
                      <i class="fas fa-flag"></i> 1000
                    </div>
                  </td>
                </tr>
              </tbody>
            </table>
          </div>
        </div>
      </div>
    </div>

    <div class="container-fluid">
      <div class="container">
        <h2 class="mt-4">Reis menos amados da última semana</h2>
        <div class="row">
          <div class="col-md-12">
            <table class="table table-hover">
              <tbody>
                <tr>
                  <td class="img">
                    <img src="images/avatares/1.png" class="avatar-pool" alt="">
                  </td>
                  <td>João da Silva</td>
                  <td class="votos">
                    <div class="btn btn-warning">
                      <i class="fas fa-flag"></i> 1000
                    </div>
                  </td>
                </tr>
                <tr>
                  <td class="img">
                    <img src="images/avatares/2.png" class="avatar-pool" alt="">
                  </td>
                  <td>Maria da Costa</td>
                  <td class="votos">
                    <div class="btn btn-warning">
                      <i class="fas fa-flag"></i> 1000
                    </div>
                  </td>
                </tr>
                <tr>
                  <td class="img">
                    <img src="images/avatares/3.png" class="avatar-pool" alt="">
                  </td>
                  <td>João Oliveira</td>
                  <td class="votos">
                    <div class="btn btn-warning">
                      <i class="fas fa-flag"></i> 1000
                    </div>
                  </td>
                </tr>
              </tbody>
            </table>
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