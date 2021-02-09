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
          <li class="breadcrumb-item active" aria-current="page">Cadastrar Paciente</li>
        </ol>
      </nav>

      <div class="pt-4 pb-3">
        <h2>Cadastrar Paciente</h2>
      </div>


        <form id="form" method="post" enctype="multipart/form-data">
            <div class="row">
                <input type="hidden" id="portId" name="portId" value="" />

                <div class="col-lg-4">
                    <div class="card mb-grid">
                        <div class="card-header d-flex justify-content-between align-items-center">
                            <div class="card-header-title">Foto Paciente</div>
                        </div>
                        <div class="card-body collapse show">
                            <div class="col-lg-12 text-center">
                                <input type="file" class="form-control" id="arquivoImagem" name="arquivoImagem">
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-lg-8">
                    <div class="card mb-grid">
                        <div class="card-header d-flex justify-content-between align-items-center">
                            <div class="card-header-title">Informações do Paciente</div>
                        </div>
                        <div class="card-body collapse show">
                            <div class="row">
                                <div class="col-md-9">
                                    <div class="form-group">
                                        <label class="form-label" for="pgPergunta">Nome Completo</label>
                                        <input type="text" class="form-control" id="pac_nome" name="pac_nome" placeholder="Nome Completo" value="" required>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label class="form-label" for="pgPergunta">Data de Nascimento</label>
                                        <input type="date" class="form-control" id="pac_dt_nascimento" name="pac_dt_nascimento" placeholder="Data Nascimento" value="" required>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label class="form-label" for="pgPergunta">RG</label>
                                        <input type="text" class="form-control" id="pac_rg" name="pac_rg" placeholder="RG" data-mask="00000000000" value="">
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label class="form-label" for="pgPergunta">CPF</label>
                                        <input type="text" class="form-control" id="pac_cpf" name="pac_cpf" data-mask="000.000.000-00"placeholder="CPF" value="" required>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label class="form-label" for="pgPergunta">Telefone</label>
                                        <input type="text" class="form-control" id="pac_telefone" name="pac_telefone" data-mask="(00) 0000-0000" placeholder="Telefone" value="">
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label class="form-label" for="pgPergunta">Celular</label>
                                        <input type="text" class="form-control" id="pac_celular" name="pac_celular" data-mask="(00) 00000-0000"placeholder="Celular" value="">
                                    </div>
                                </div>
                                <div class="col-lg-12">
                                    <div class="text-center">
                                        <button id="btnSalvar" class="btn btn-primary"><i class="fas fa-save"></i> Salvar Paciente</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </form>

    </div>
  </div>
</div>


<?php include 'footer.php'; ?>


<script>
    $('#btnSalvar').on('click', function (event) {
        event.preventDefault();
        $.ajax({
            type: "POST",
            url: "system/_paciente.php",
            data: new FormData($('#form')[0]),
            processData: false,
            contentType: false,
            success: function(data) {
                Notiflix.Loading.Pulse('Carregando...');
                debugger;
                if (data.acao == 'salvo') {
                    Notiflix.Loading.Remove();
                    Notiflix.Notify.Success('Paciente Salvo com Sucesso!');
                } else {
                    Notiflix.Loading.Remove();
                    Notiflix.Notify.Failure('Erro!');
                }
            }
        });
    });
</script>