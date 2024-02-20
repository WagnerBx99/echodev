<?php
session_start();
require_once('db.php');

if (!isset($_SESSION['admin'])) {
    header('Location: index.php');
    exit;
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Receber os dados do formulário
    $projeto = $_POST['projeto'];
    $atividade = $_POST['atividade'];
    $tarefa = $_POST['tarefa'];
    $atribuicao = $_POST['atribuicao'];
    $voluntario = $_POST['voluntario'];
    $carga = $_POST['carga'];

    // Formatar a carga para o formato '%Y-%m-%d %H:%i:%s'
    $cargaFormatted = date('Y-m-d H:i:s', strtotime($carga));

    // Inserir os dados no banco de dados (sem o campo registro)
    $sql = "INSERT INTO tarefas (projeto, atividade, tarefa, atribuicao, voluntario, carga) VALUES ('$projeto', '$atividade', '$tarefa', '$atribuicao', '$voluntario', '$cargaFormatted')";
    if ($conn->query($sql) === TRUE) {
        echo "Dados inseridos com sucesso!";
    } else {
        echo "Erro ao inserir dados: " . $conn->error;
    }
}



?>

<<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Painel de Administração</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="styles.css">
</head>
<body>

    <div class="container-fluid mt-5"> <!-- Substituído container por container-fluid -->
        <h2 class="text-center">Painel de Administração</h2>

        <form id="adminForm" action="admin.php" method="post" onsubmit="return validateForm()">
            <div class="form-row">
                <div class="form-group col-md-4">
                    <label for="projeto">Projeto:</label>
                    <input type="text" class="form-control" id="projeto" name="projeto" required>
                </div>
                <div class="form-group col-md-4">
                    <label for="atividade">Atividade:</label>
                    <input type="text" class="form-control" id="atividade" name="atividade" required>
                </div>
                <div class="form-group col-md-4">
                    <label for="tarefa">Tarefa:</label>
                    <input type="text" class="form-control" id="tarefa" name="tarefa" required>
                </div>
            </div>
            <div class="form-row">
                <div class="form-group col-md-4">
                    <label for="atribuicao">Atribuição:</label>
                    <input type="text" class="form-control" id="atribuicao" name="atribuicao" required>
                </div>
                <div class="form-group col-md-4">
                    <label for="voluntario">Voluntário:</label>
                    <input type="text" class="form-control" id="voluntario" name="voluntario" required>
                </div>
                <div class="form-group col-md-4">
                    <label for="carga">Carga:</label>
                    <input type="text" class="form-control" id="carga" name="carga" required>
                    <small id="cargaHelp" class="form-text text-muted">Formato: DD-MM-AAAA HH:MM:SS</small>
                </div>
            </div>
            <div class="form-row">
                <div class="form-group col-md-12 text-center"> <!-- Adicionado text-center aqui -->
                    <button type="submit" class="btn btn-primary">Inserir Dados</button>
                </div>
            </div>
        </form>
    </div>

    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.1/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>


  

</body>
</html>
