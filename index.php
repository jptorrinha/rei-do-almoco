<?php 
  include 'config/config.php';

  /* start includes das querys de exibição, votação e tratamento de datas */
  include 'query/dates.php';
  include 'query/votacao-view.php';
  include 'query/votacao-wins.php';
  include 'query/votacao-last-week.php';
  include 'query/votacao-last-week-down.php';
  /* end includes das querys de exibição e votação */

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

    <?php if($time >= $horaStart && $time <= $horaEnd): ?>
      <div class="container-fluid">
        <?php if($contador > 0): ?>
          <div class="container">
            <h2 class="mt-4">Candidatos do Dia <?php echo date('d/m/y');?>! </h2>
            <h3>Para votar selecione um dos candidagos abaixo e clique em votar</h3>
            <p>Vote todo dia das 10:00 às 12:00 da manhã para escolher um pretendente ao trono.</p>
            <div class="row">
              <div class="col-md-12">
                <table class="table table-hover">
                  <tbody>
                    <?php while ($candidato = $candidatos->fetch(PDO::FETCH_ASSOC)): ?>
                    <tr>
                      <td class="img">
                        <div class="img-thumbnail avatar-pool" style="background-image: url('<?php echo IMAGEM; ?><?php echo $candidato['foto']; ?>')"></div>
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
            <p>Nenhum candidato cadastrado para a votação de hoje!</p>
          </div>
        <?php endif; ?>
      </div>
    <?php endif; ?>

    <?php if($time >= $horaShow): ?>
      <div class="container-fluid vencedor">
        <div class="container">
          <h2 class="mt-4"><i class="fas fa-crown"></i> Rei do Dia <?php echo date('d/m/y');?></h2>
          <p>Confira quem foi o vencedor da votação de hoje!</p>
          <div class="row">
            <div class="col-md-12">
              <table class="table">
                <tbody>
                  <tr>
                    <td class="img">
                      <div class="img-thumbnail avatar-pool" style="background-image: url('<?php echo IMAGEM; ?><?php echo $vFoto; ?>')"></div>
                    </td>
                    <td class="name"><?php echo $vNome; ?></td>
                    <td class="qtde-votos">
                      <div class="alert alert-success box-votos">Votos: <?php echo $vVotos; ?></div>
                    </td>
                    <td class="votos">
                      <button class="btn btn-primary avisar" value="<?php echo $vID; ?>">
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
        <h2 class="mt-4">Rei mais amados da última semana</h2>
        <div class="row">
          <div class="col-md-12">
            <table class="table table-hover">
              <tbody>
                <?php while ($WinsWeek = $lastWeekMais->fetch(PDO::FETCH_ASSOC)): ?>
                  <tr>
                    <td class="img">
                      <div class="img-thumbnail avatar-pool" style="background-image: url('<?php echo IMAGEM; ?><?php echo $WinsWeek['foto']; ?>')"></div>
                    </td>
                    <td class="nome-week"><?php echo $WinsWeek['nome']; ?></td>
                    <td class="votos">
                      <div class="alert alert-success bag">
                        <i class="fas fa-flag"></i> VITÓRIAS: <?php echo $WinsWeek['vitorias']; ?>
                      </div>
                      <div class="alert alert-secondary bag sum">
                        <i class="fas fa-flag"></i> TOTAL DE VOTOS NA SEMANA: <?php echo $votosWinWeek; ?>
                      </div>
                    </td>
                  </tr>
                <?php endwhile; ?>
              </tbody>
            </table>
          </div>
        </div>
      </div>
    </div>

    <div class="container-fluid">
      <div class="container">
        <h2 class="mt-4">Rei menos amado da última semana</h2>
        <div class="row">
          <div class="col-md-12">
            <table class="table table-hover">
              <tbody>
                <?php while ($DownWeek = $lastWeekDown->fetch(PDO::FETCH_ASSOC)): ?>
                  <tr>
                    <td class="img">
                      <div class="img-thumbnail avatar-pool" style="background-image: url('<?php echo IMAGEM; ?><?php echo $DownWeek['foto']; ?>')"></div>
                    </td>
                    <td class="nome-week" colspan="2"><?php echo $DownWeek['nome']; ?></td>
                  </tr>
                <?php endwhile; ?>
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