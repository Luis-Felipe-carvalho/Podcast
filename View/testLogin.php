<?php
session_start();

if (isset($_POST['submit']) && !empty($_POST['email']) && !empty($_POST['senha'])) {
    // Acessa
    include_once('config.php');
    $email = $_POST['email'];
    $senha = $_POST['senha'];

    // Consulta para buscar o usuário no banco de dados
    $sql = "SELECT * FROM usuarios WHERE email = :email AND senha = :senha";
    $stmt = $pdo->prepare($sql);
    $stmt->bindParam(':email', $email);
    $stmt->bindParam(':senha', $senha);
    $stmt->execute();

    if ($stmt->rowCount() < 1) {
        // Caso a consulta não retorne nenhum resultado, o login falha
        unset($_SESSION['email']);
        unset($_SESSION['senha']);
        header('Location: login.php');
    } else {
        // Login bem-sucedido
        $_SESSION['email'] = $email;
        $_SESSION['senha'] = $senha;
        header('Location: index.html');
    }
} else {
    // Redireciona para a página de login se os campos estiverem vazios
    header('Location: login.php');
}
?>
