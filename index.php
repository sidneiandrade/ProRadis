<?php 

include './system/conexao.php'; 

if(!defined('ABSPATH')){
  define('ABSPATH', dirname(__FILE__) . '/');
}

if(!isset($_SESSION)){
  session_start();
}

$logado = isset($_SESSION['id']) ? 'S' : 'N';

if($logado == 'S'){
  exit(header('Location: dashboard'));
}

$_SESSION['caminho'] = ABSPATH;


?>
<!DOCTYPE html>
<html lang="pt-br">

<head>
  <link rel="icon" type="image/png" sizes="16x16" href="./dist/img/favicon.png">
  <title>Adminstração - PRORADIS</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <link rel="stylesheet" type="text/css" href="dist/notiflix/notiflix-2.4.0.min.css" media="screen" />
  <link rel="stylesheet" type="text/css" href="dist/css/adminx.css" media="screen" />
</head>

<body>
  <div class="adminx-container d-flex justify-content-center align-items-center bg">
    <div class="page-login">
      <div class="card mb-0">
        <div class="card-body">
          <img src="./dist/img/logo-proradis-color.png" class="img-fluid p-4" alt="PRORADIS">
          <form id="loginAdm" method="post">
            <div class="form-group">
              <label for="usuario" class="form-label">Usuario</label>
              <input type="text" class="form-control" id="usuario" name="usuario" placeholder="Usuário" required>
            </div>
            <div class="form-group">
              <label for="senha" class="form-label">Senha</label>
              <input type="password" class="form-control" id="senha" name="senha" placeholder="Password" required>
            </div>
            <button type="submit" class="btn btn-sm btn-block btn-primary">Entrar</button>
          </form>
        </div>
        <div class="card-footer text-center">
          <small>Login: usuario | Senha: usu102030</small>
        </div>
      </div>
    </div>
  </div>
  <!-- If you prefer jQuery these are the required scripts -->
  <script src="https://code.jquery.com/jquery-3.2.1.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.3/umd/popper.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta.2/js/bootstrap.min.js"></script>
  <script src="dist/js/vendor.js"></script>
  <script src="dist/js/adminx.js"></script>
  <script src="dist/notiflix/notiflix-2.4.0.min.js"></script>
</body>

</html>

<script>

$("#loginAdm").submit(function(e) {
  e.preventDefault();
  Notiflix.Loading.Pulse('Carregando...');
  $.ajax({
    type: "POST",
    url: "./system/login.php",
    data: $("#loginAdm").serialize(),
    success: function(data) {
      debugger;
      if (data.resultado == 'erro') {
        Notiflix.Notify.Failure(data.msg);
        Notiflix.Loading.Remove();
      } else {
        window.location.href = "./dashboard";
      }
    }
  });

});
  
  
</script>