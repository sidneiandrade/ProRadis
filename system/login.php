<?php

include 'conexao.php';

$usuario = $_POST['usuario'];
$senhausuario = $_POST['senha'];

$sql = $pdo->prepare("SELECT * FROM usuarios WHERE usu_login = ?");
$sql->execute([$usuario]);
$total = $sql->rowCount();

if ($total > 0) {

    $info = $sql->fetchAll(PDO::FETCH_ASSOC);
    foreach ($info as $value) {
        $usuID = $value['usu_id'];
        $usuLogin = $value['usu_login'];
        $usuSenha = $value['usu_senha'];
        $usuNome = $value['usu_nome'];
        $usuNivel = $value['usu_nivel'];
        $usuStatus = $value['usu_status'];
    }

        $senhacriptografada = md5($senhausuario);

        if ($senhacriptografada == $usuSenha) {

            session_start();
            $_SESSION['usuario'] = $usuNome;
            $_SESSION['id'] = $usuID;
            $_SESSION['login'] = $usuLogin;
            $_SESSION['nivel'] = $usuNivel;

            $data = ['resultado' => 'sucesso', 'msg' => 'OK!'];
            header('Content-type: application/json');
            echo json_encode($data);

        } else {

            $data = ['resultado' => 'erro', 'msg' => 'Usuário ou Senha invalido!'];
            header('Content-type: application/json');
            echo json_encode($data);

        }
    } else {

    $data = ['resultado' => 'erro', 'msg' => 'Usuário ou Senha invalido!'];
    header('Content-type: application/json');
    echo json_encode($data);
    
}
