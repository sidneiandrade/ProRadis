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
          <li class="breadcrumb-item active" aria-current="page">Consultas</li>
        </ol>
      </nav>

      <div class="pt-4 pb-3">
        <h2>Consultas</h2>
      </div>

        <div class="row">

            <div class="col-lg-3">
                <div class="card mb-grid">
                    <div class="card-header d-flex justify-content-between align-items-center">
                        <div class="card-header-title">Novos Pacientes</div>
                    </div>
                    <div class="card-body collapse show">
                        <div class="col-lg-12 text-center">
                            <ul class="list-group">
                            <?php 
                                $sql = $pdo->prepare("SELECT * FROM pacientes WHERE pac_con_id <= 0 ORDER BY pac_id DESC");
                                $sql->execute();
                                $count = $sql->rowCount();

                                if($count > 0){
                                    $list = $sql->fetchAll(PDO::FETCH_ASSOC);
                                    foreach($list as $values){
                            ?>

                                <li class="list-group-item">
                                    <div class="row text-center">
                                        <div class="col-md-4">
                                            <img src="<?php echo $values['pac_foto'] ?>" alt="<?php echo $values['pac_nome'] ?>" class="img-fluid rounded-circle" width="90">
                                        </div>
                                        <div class="col-md-8">
                                            <h5 class="mb-0"><?php echo $values['pac_nome'] ?></h5>
                                            <small>CPF: <?php echo $values['pac_cpf'] ?></small><br>
                                            <button type="button" class="btn btn-outline-info btn-sm mt-2 btnConsulta" data-id="<?php echo $values['pac_id'] ?>">Nova Consulta</button>
                                        </div>
                                    </div>    
                                </li>

                                <?php } 
                                    } else { 
                                        echo 'Não existem novos pacientes';
                                    }
                                ?>
                            </ul>
                            
                        </div>
                    </div>
                    <div class="card-footer text-center">
                        <a href="paciente" class="btn btn-outline-primary btn-sm">Cadastrar Paciente</a>
                    </div>
                </div>
                <div class="card mb-grid">
                    <div class="card-header d-flex justify-content-between align-items-center">
                        <div class="card-header-title">Pacientes Atendidos</div>
                    </div>
                    <div class="card-body collapse show">
                        <div class="col-lg-12 text-center">
                            <ul class="list-group">
                            <?php 
                                $sql = $pdo->prepare("SELECT * FROM consultas INNER JOIN pacientes on (pac_id = con_pac_id) ORDER BY con_id DESC");
                                $sql->execute();
                                $count = $sql->rowCount();
                                
                                if($count > 0){
                                $list = $sql->fetchAll(PDO::FETCH_ASSOC);
                                foreach($list as $values){
                            ?>
                                <li class="list-group-item">
                                    <div class="row text-center">
                                        <div class="col-md-4">
                                            <img src="<?php echo $values['pac_foto'] ?>" alt="usuario 01" class="img-fluid rounded-circle" width="90">
                                        </div>
                                        <div class="col-md-8">
                                            <h5 class="mb-0"><?php echo $values['pac_nome'] ?></h5>
                                            <small><i class="far fa-calendar-alt"></i> <?php echo $dataPost = date("d/m/Y", strtotime($values['con_dt_cadastro'])) ?></small><br>
                                            <button visConsulta type="button" class="btn btn-outline-warning btn-sm mt-2 visConsulta" data-id="<?php echo $values['pac_id'] ?>" data-consulta="<?php echo $values['con_id'] ?>">Visualizar Consulta</button>
                                        </div>
                                    </div>    
                                </li>
                            <?php } 
                            } else {

                                echo 'Sem Consultas Cadastradas';

                            } ?>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
           
            <div class="col-lg-9">
                <form id="form" method="post" enctype="multipart/form-data">
                    <div id="painelConsulta" class="card mb-grid hide">
                        <div class="card-header d-flex justify-content-between align-items-center">
                            <div class="card-header-title">Informações da Consulta</div>
                        </div>
                        <div class="card-body collapse show">
                            <div class="row">
                                <div class="col-lg-12">
                                <div class="alert alert-light" role="alert">
                                    <h4 id="nomePaciente" class="alert-heading"></h4>
                                    <p id="dadosPaciente"></p>
                                    <hr>
                                    <p class="mb-0">Prontuário Médico</p>
                                </div>
                                </div>
                                <div class="col-lg-12">
                                    <div class="form-group">
                                        <input type="hidden" name="con_id" value="">
                                        <input type="hidden" id="con_pac_id" name="con_pac_id" value="">
                                        <div id="editor"></div>
                                        <input type="hidden" id="con_descricao" name="con_descricao">
                                    </div>
                                    <div class="text-center">
                                        <input type="hidden" id="acao" name="acao" value="salvar">
                                        <button id="btnSalvar" type="button" class="btn btn-primary">Salvar Consulta</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </form>
            </div>

        </div>

    </div>
  </div>
</div>


<?php include 'footer.php'; ?>


<script>

    $(".btnConsulta").click(function(e){
        e.preventDefault();
        Notiflix.Loading.Pulse('Carregando...');
        $("#con_pac_id").val($(this).data('id'))
        let pacID = $("#con_pac_id").val();
        $(".dadosConsulta").html("");
        debugger;
        $.ajax({
            type: "POST",
            url: "system/_consulta.php",
            data: { 
                'acao': 'dados', 
                'pacID': pacID
            },
            success: function(data) {
                Notiflix.Loading.Remove();
                $("#painelConsulta").removeClass('hide');
                $("#nomePaciente").html("<strong>Paciente: </strong>" + data.dados.pac_nome);
                $("#dadosPaciente").html("<strong>CPF: </strong>" + data.dados.pac_cpf);
                debugger;
            }
        });
    });

    $("#btnSalvar").click(function(e){

        e.preventDefault();
        Notiflix.Loading.Pulse('Carregando...');

        var texto = $('#editor').summernote('code');

        if(texto == ""){
            Notiflix.Loading.Remove();
            Notiflix.Notify.Failure('Preencher Prontuário!');
        } else {
            $('#con_descricao').val(texto);
            $.ajax({
                type: "POST",
                url: "system/_consulta.php",
                data: new FormData($('#form')[0]),
                processData: false,
                contentType: false,
                success: function(data) {
                    
                    if (data.acao == 'salvo') {
                        Notiflix.Loading.Remove();
                        Notiflix.Notify.Success('Consulta Salva com Sucesso!');
                        setTimeout(function(){ location.reload(); }, 2000);

                    } else {
                        Notiflix.Loading.Remove();
                        Notiflix.Notify.Failure('Erro!');
                    }
                }
            });
        }

        
    });

    $(".visConsulta").click(function(e){
        e.preventDefault();
        let conID = $(this).data('consulta');
        $("#con_pac_id").val($(this).data('id'));
        Notiflix.Loading.Pulse('Carregando...');

        $.ajax({
            type: "POST",
            url: "system/_consulta.php",
            data: { 
                'acao': 'consultar', 
                'conID': conID
            },
            success: function(data) {
                Notiflix.Loading.Remove();

                $("#painelConsulta").removeClass('hide');
                $("#editor").summernote('code', data.dados);
                $("#acao").val('atualizar');
                $("#btnSalvar").html("Atualizar Consulta");

                let pacID = $("#con_pac_id").val();
                debugger;
                $.ajax({
                    type: "POST",
                    url: "system/_consulta.php",
                    data: { 
                        'acao': 'dados', 
                        'pacID': pacID
                    },
                    success: function(data) {
                        Notiflix.Loading.Remove();
                        $("#painelConsulta").removeClass('hide');
                        $("#nomePaciente").html("<strong>Paciente: </strong>" + data.dados.pac_nome);
                        $("#dadosPaciente").html("<strong>CPF: </strong>" + data.dados.pac_cpf);
                        debugger;
                    }
                });
            }
        });
    });
    

</script>