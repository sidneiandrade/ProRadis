<?php 

include 'conexao.php';

$Acao = $_POST['acao'];

switch($Acao){
    case 'salvar':
        try {
            $IdPaciente       = $_POST['con_pac_id'];
            $ConDescricao     = $_POST['con_descricao'];

            $pdo->beginTransaction();
            $sql = $pdo->prepare("INSERT INTO consultas VALUES (null,?,?,now())");
            $sql->execute([$IdPaciente, $ConDescricao]);
            $idConsulta = $pdo->lastInsertId();

            $update = $pdo->prepare("UPDATE pacientes SET pac_con_id = ? WHERE pac_id = ?");
            $update->execute([$idConsulta, $IdPaciente]);
            $pdo->commit();
        
            $data = ['acao' => 'salvo'];
            header('Content-type: application/json');
            echo json_encode($data);
        }
        catch (Exception $e) {
            $pdo->rollback();
            echo $e->getMessage();
        }
        break;

    case 'consultar':

        $conID = $_POST['conID'];
        $sql = $pdo->prepare("SELECT con_descricao FROM consultas WHERE con_id = ?");
        $sql->execute([$conID]);
        $result = $sql->fetchAll(PDO::FETCH_ASSOC);
        
        $data = ['dados' => $result[0]['con_descricao']];
        header('Content-type: application/json');
        echo json_encode($data);

        break;

    case 'dados':
        $pacID = $_POST['pacID'];
        $sql = $pdo->prepare("SELECT * FROM pacientes WHERE pac_id = ?");
        $sql->execute([$pacID]);
        $result = $sql->fetchAll(PDO::FETCH_ASSOC);
        
        $data = ['dados' => $result[0]];
        header('Content-type: application/json');
        echo json_encode($data);

        break;

    case 'atualizar':
        try {
            $IdPaciente       = $_POST['con_pac_id'];
            $ConDescricao     = $_POST['con_descricao'];

            $pdo->beginTransaction();
            $sql = $pdo->prepare("UPDATE consultas SET con_descricao = ? WHERE con_id = ?");
            $sql->execute([$ConDescricao, $IdPaciente]);
            $pdo->commit();
        
            $data = ['acao' => 'salvo'];
            header('Content-type: application/json');
            echo json_encode($data);
        }
        catch (Exception $e) {
            $pdo->rollback();
            echo $e->getMessage();
        }
        break;
}



