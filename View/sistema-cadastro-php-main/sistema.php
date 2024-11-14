<?php
session_start();
include_once('config.php');

// Verifica se a sessão está ativa
if ((!isset($_SESSION['email']) == true) and (!isset($_SESSION['password']) == true)) {
    unset($_SESSION['email']);
    unset($_SESSION['password']);
    header('Location: adm.php'); // Redireciona para o login se não estiver autenticado
    exit();
}

$logado = $_SESSION['email']; // Define a variável de login com o email armazenado na sessão

// Consulta SQL para pegar os dados do usuário (exemplo)
$sql = "SELECT * FROM usuarios WHERE email = :email";
$stmt = $pdo->prepare($sql); // Prepara a consulta
$stmt->bindParam(':email', $logado); // Liga o parâmetro :email à variável $logado
$stmt->execute(); // Executa a consulta

// Opcional: Pega os resultados da consulta (se necessário)
$result = $stmt->fetchAll(); // Armazena o resultado da consulta em $result
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SISTEMA | GN</title>
</head>

<body>
    <nav class="navbar navbar-expand-lg navbar-dark bg-primary">
        <div class="d-flex">
            <a href="sair.php" class="btn btn-danger me-5">Sair</a>
        </div>
    </nav>
    <br>
    <?php
    echo "<h1>Bem vindo <u>$logado</u></h1>";
    ?>
    <br>
    <div class="m-5">
        <table class="table text-white table-bg">
            <thead>
                <tr>
                    <th scope="col">ID</th>
                    <th scope="col">Email</th>
                    <th scope="col">Senha</th>
                </tr>
            </thead>
            <tbody>
                <?php
                // Usa a conexão PDO configurada no arquivo config.php
                // Consulta SQL para buscar os dados da tabela 'users' (substitua conforme necessário)
                $sql = "SELECT * FROM usuarios";
                $stmt = $pdo->prepare($sql);
                $stmt->execute();

                // Verifique se a consulta retornou um resultado
                if ($stmt->rowCount() > 0) {
                    // Se a consulta for bem-sucedida, percorra os resultados
                    while ($user_data = $stmt->fetch(PDO::FETCH_ASSOC)) {
                        echo "<tr>";
                        echo "<td>" . htmlspecialchars($user_data['id']) . "</td>";
                        echo "<td>" . htmlspecialchars($user_data['email']) . "</td>";
                        echo "<td>" . htmlspecialchars($user_data['senha']) . "</td>";
                        echo "<td>
            <a class='btn btn-sm btn-primary' href='edit.php?id=" . $user_data['id'] . "' title='Editar'>
                <svg xmlns='http://www.w3.org/2000/svg' width='16' height='16' fill='currentColor' class='bi bi-pencil' viewBox='0 0 16 16'>
                    <path d='M12.146.146a.5.5 0 0 1 .708 0l3 3a.5.5 0 0 1 0 .708l-10 10a.5.5 0 0 1-.168.11l-5 2a.5.5 0 0 1-.65-.65l2-5a.5.5 0 0 1 .11-.168l10-10zM11.207 2.5 13.5 4.793 14.793 3.5 12.5 1.207 11.207 2.5zm1.586 3L10.5 3.207 4 9.707V10h.5a.5.5 0 0 1 .5.5v.5h.5a.5.5 0 0 1 .5.5v.5h.293l6.5-6.5zm-9.761 5.175-.106.106-1.528 3.821 3.821-1.528.106-.106A.5.5 0 0 1 5 12.5V12h-.5a.5.5 0 0 1-.5-.5V11h-.5a.5.5 0 0 1-.468-.325z'/>
                </svg>
            </a> 
            <a class='btn btn-sm btn-danger' href='delete.php?id=" . $user_data['id'] . "' title='Deletar'>
                <svg xmlns='http://www.w3.org/2000/svg' width='16' height='16' fill='currentColor' class='bi bi-trash-fill' viewBox='0 0 16 16'>
                    <path d='M2.5 1a1 1 0 0 0-1 1v1a1 1 0 0 0 1 1H3v9a2 2 0 0 0 2 2h6a2 2 0 0 0 2-2V4h.5a1 1 0 0 0 1-1V2a1 1 0 0 0-1-1H10a1 1 0 0 0-1-1H7a1 1 0 0 0-1 1H2.5zm3 4a.5.5 0 0 1 .5.5v7a.5.5 0 0 1-1 0v-7a.5.5 0 0 1 .5-.5zM8 5a.5.5 0 0 1 .5.5v7a.5.5 0 0 1-1 0v-7A.5.5 0 0 1 8 5zm3 .5v7a.5.5 0 0 1-1 0v-7a.5.5 0 0 1 1 0z'/>
                </svg>
            </a>
        </td>";
                        echo "</tr>";
                    }
                } else {
                    // Se a consulta falhar ou não retornar resultados
                    echo "Nenhum dado encontrado.";
                }
                ?>
            </tbody>
        </table>
    </div>
</body>

<script>
    var search = document.getElementById('pesquisar');

    search.addEventListener("keydown", function (event) {
        if (event.key === "Enter") {
            searchData();
        }
    });

    function searchData() {
        window.location = 'sistema.php?search=' + search.value;
    }
</script>

</html>