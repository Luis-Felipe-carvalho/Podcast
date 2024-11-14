<?php
// Inicia a sessão
session_start();

// Inclui o arquivo de configuração para conexão com o banco de dados MySQL
include_once('config.php');

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = $_POST['email'];
    $senha = $_POST['senha'];

    // Verifica se o email inserido é o único autorizado
    if ($email === 'adm@q.com') {
        // Prepara a consulta para buscar o usuário pelo email
        $sql = "SELECT * FROM usuarios WHERE email = :email";
        $stmt = $pdo->prepare($sql);
        $stmt->bindParam(':email', $email, PDO::PARAM_STR);
        $stmt->execute();
        $usuario = $stmt->fetch(PDO::FETCH_ASSOC);

        // Verifica se o usuário existe e a senha está correta
        if ($usuario && $usuario['senha'] === $senha) {
            // Armazena o email e senha na sessão para manter o login ativo
            $_SESSION['email'] = $usuario['email'];
            $_SESSION['password'] = $usuario['senha'];

            // Redireciona para a página sistema.php após login bem-sucedido
            header("Location: sistema.php");
            exit();
        } else {
            $error = "Senha incorreta!";
        }
    } else {
        $error = "Acesso restrito! Apenas o administrador pode entrar.";
    }
}
?>

<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - Administração</title>
</head>

<body>
    <h2>Login de Administração</h2>
    <form method="POST">
        <label for="email">Email:</label><br>
        <input type="email" id="email" name="email" required><br><br>

        <label for="senha">Senha:</label><br>
        <input type="password" id="senha" name="senha" required><br><br>

        <button type="submit">Entrar</button>
    </form>

    <?php
    // Exibe a mensagem de erro se o login falhar ou o email for restrito
    if (isset($error)) {
        echo "<p style='color: red;'>$error</p>";
    }
    ?>
</body>

</html>