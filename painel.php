<?php
session_start();
require_once('db.php');

if (!isset($_SESSION['username'])) {
    header('Location: index.php');
    exit;
}

// Função para obter as tarefas do banco de dados
function getTasks($conn) {
    $sql = "SELECT * FROM tarefas";
    $result = $conn->query($sql);

    $tasks = array();

    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            $tasks[] = $row;
        }
    }

    return $tasks;
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sua Empresa - Painel</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.1/css/all.min.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;700&display=swap">
    <link rel="stylesheet" href="styles.css">
</head>

<body>

    <div class="container-fluid mt-5"> <!-- Utilize container-fluid para ocupar toda a largura -->
        <h2 class="text-center">Bem-vindo ao Painel, <?php echo $_SESSION['username']; ?>!</h2>

        <div class="mt-4">
            <table class="table table-bordered table-responsive" id="taskTable"> <!-- Adicione table-responsive e table-bordered -->
                <thead>
                    <tr>
                        <th scope="col" style="width: 8%;">Registro</th>
                        <th scope="col" style="width: 15%;">Projeto</th>
                        <th scope="col" style="width: 20%;">Atividade</th>
                        <th scope="col" style="width: 25%;">Tarefa</th>
                        <th scope="col" style="width: 10%;">Atribuição</th>
                        <th scope="col" style="width: 12%;">Voluntário</th>
                        <th scope="col" style="width: 10%;">Carga</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    // Obter tarefas do banco de dados
                    $tasks = getTasks($conn);

                    // Exibir as tarefas na tabela
                    foreach ($tasks as $task) {
                        echo "<tr>";
                        echo "<td>{$task['registro']}</td>";
                        echo "<td class='openModal' data-toggle='modal' data-target='#projetoModal'>{$task['projeto']}</td>";
                        echo "<td class='openModal' data-toggle='modal' data-target='#atividadeModal'>{$task['atividade']}</td>";
                        echo "<td class='openModal' data-toggle='modal' data-target='#tarefaModal'>{$task['tarefa']}</td>";
                        echo "<td>{$task['atribuicao']}</td>";
                        echo "<td>{$task['voluntario']}</td>";
                        echo "<td>{$task['carga']}</td>";
                        echo "</tr>";
                    }
                    ?>
                </tbody>
            </table>
        </div>

        <div class="mt-4">
            <p id="description" class="text-center">Descrição: Esta é uma descrição de exemplo ao passar o mouse.</p>
        </div>
    </div>

    <!-- Modais para Projeto, Atividade, Tarefa -->
    <div class="modal fade" id="projetoModal" tabindex="-1" role="dialog" aria-labelledby="projetoModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="projetoModalLabel">Detalhes do Projeto</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <!-- Conteúdo do modal do projeto -->
                    <p>Conteúdo do modal do projeto.</p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Fechar</button>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="atividadeModal" tabindex="-1" role="dialog" aria-labelledby="atividadeModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="atividadeModalLabel">Detalhes da Atividade</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <!-- Conteúdo do modal da atividade -->
                    <p>Conteúdo do modal da atividade.</p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Fechar</button>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="tarefaModal" tabindex="-1" role="dialog" aria-labelledby="tarefaModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="tarefaModalLabel">Detalhes da Tarefa</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <!-- Conteúdo do modal da tarefa -->
                    <p>Conteúdo do modal da tarefa.</p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Fechar</button>
                </div>
            </div>
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.1/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

    <script>
        $(document).ready(function () {
            $(document).on('mouseover', '.openModal', function () {
                var targetModal = $(this).data('target');
                var cellContent = $(this).text();
                $('#description').text('Descrição: Ao passar o mouse sobre ' + cellContent);
                $(document).on('click', '.openModal', function () {
                    $(targetModal).modal('show');
                });
            });

            // Adiciona evento ao fechar os modais para restaurar o evento de mouseover
            $('.modal').on('hidden.bs.modal', function () {
                $('#description').text('Descrição: Esta é uma descrição de exemplo ao passar o mouse.');
                $(document).off('click', '.openModal');
            });
        });
    </script>
</body>

</html>

<?php
// Fechar a conexão com o banco de dados
$conn->close();
?>
