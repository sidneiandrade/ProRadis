<?php

include 'system/conexao.php';
include 'header.php';

?>

<!-- adminx-content-aside -->
<div class="adminx-content">
  <div class="adminx-main-content">
    <div class="container-fluid">
      <!-- BreadCrumb -->
      <nav aria-label="breadcrumb" role="navigation">
        <ol class="breadcrumb adminx-page-breadcrumb">
          <li class="breadcrumb-item"><a href="#">Home</a></li>
          <li class="breadcrumb-item active" aria-current="page">Painel de Controle</li>
        </ol>
      </nav>

      <div class="pt-4 pb-3">
        <h2>Bem-Vindo <?php echo $_SESSION['usuario'] ?></h2>
      </div>

      <div class="row">

        <div class="col-lg-2 col-sm-4 text-center mb-3">
          <div class="card">
            <a href="consultas" style="cursor: pointer; text-decoration: none; color: #212529;">
              <div class="card-body collapse show" id="card1">
                <i class="fas fa-briefcase-medical" style="font-size: 30px"></i>
                <br>
                <small>Consultas</small>
              </div>
            </a>
          </div>
        </div>

        <div class="col-lg-2 col-sm-4 text-center mb-3">
          <div class="card">
            <a href="paciente" style="cursor: pointer; text-decoration: none; color: #212529;">
              <div class="card-body collapse show" id="card1">
                <i class="fas fa-user-plus" style="font-size: 30px"></i>
                <br>
                <small>Cadastrar Paciente</small>
              </div>
            </a>
          </div>
        </div>

      </div>
    </div>
  </div>
</div>


<?php include 'footer.php'; ?>