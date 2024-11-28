<?php
// Verificar se o formulário foi enviado
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Dados do formulário
    $email = $_POST['email'];
    $senha = $_POST['senha'];

    // Verificar se o e-mail e senha estão corretos
    if ($email === 'adm@q.com' && $senha === '123') {
        // Redirecionar para a página desejada
        header('Location: ../Podcast/teste.php');
        exit();
    } else {
        // Mensagem de erro se os dados estiverem incorretos
        $erro = "Acesso negado";
    }
}
?>

<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
</head>

<body>
    <h2>Login</h2>

    <!-- Formulário de Login -->
    <form method="POST" action="">
        <label for="email">E-mail:</label>
        <input type="email" id="email" name="email" required><br><br>

        <label for="senha">Senha:</label>
        <input type="password" id="senha" name="senha" required><br><br>

        <button type="submit">Entrar</button>
    </form>

    <?php
    // Exibir a mensagem de erro caso exista
    if (isset($erro)) {
        echo "<p style='color: red;'>$erro</p>";
    }
    ?>
</body>

</html>