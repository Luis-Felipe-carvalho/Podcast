<?php
// Incluindo o arquivo de configuração com a conexão PDO
include_once('config.php');

if (isset($_POST['update'])) {
    $id = $_POST['id'];
    $email = $_POST['email'];
    $senha = $_POST['senha'];

    // Usando a variável $pdo para executar a query
    $sqlUpdate = "UPDATE usuarios SET email = :email, senha = :senha WHERE id = :id";
    $stmt = $pdo->prepare($sqlUpdate);

    // Vinculando os parâmetros
    $stmt->bindParam(':email', $email);
    $stmt->bindParam(':senha', $senha);
    $stmt->bindParam(':id', $id, PDO::PARAM_INT);

    // Executando a consulta
    $stmt->execute();

    // Pode adicionar uma mensagem ou redirecionamento
    echo "Registro atualizado com sucesso!";
}

header('Location: sistema.php');
?>