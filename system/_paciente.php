<?php 

include 'conexao.php';
require '../dist/wideimage/WideImage.php';

$Nome             = $_POST['pac_nome'];
$dtNascimento     = $_POST['pac_dt_nascimento'];
$Cpf              = $_POST['pac_cpf'];
$Rg               = $_POST['pac_rg'];
$Telefone         = $_POST['pac_telefone'];
$Celular          = $_POST['pac_celular'];

$dirImagens = '../dist/img/'; 
$baseDiretorio =    $baseUrl . 'dist/img/'; 

try {
    $Imagem = 'paciente-' . rand() . '.jpg'; 
    move_uploaded_file($_FILES['arquivoImagem']['tmp_name'], $dirImagens . $Imagem); 
    $image = WideImage::load($dirImagens . $Imagem);
    $image = $image->resize('300', null, 'inside', 'any');
    $image = $image->crop('center', 'center', 300, 300);
    $image = $image->resizeCanvas('300', '300', 'center', 'center', '000000', 'any', false);
    $image->saveToFile($dirImagens . $Imagem, 60);
    $pathImage = $baseDiretorio . $Imagem;

    $pdo->beginTransaction();
    $sql = $pdo->prepare("INSERT INTO pacientes VALUES (null,?,?,?,?,?,?,?,0)");
    $sql->execute([$Nome, $dtNascimento, $Cpf, $Rg, $Telefone, $Celular, $pathImage]);
    $pdo->commit();

    $data = ['acao' => 'salvo'];
    header('Content-type: application/json');
    echo json_encode($data);
}
catch (Exception $e) {
    $pdo->rollback();
    echo $e->getMessage();
}