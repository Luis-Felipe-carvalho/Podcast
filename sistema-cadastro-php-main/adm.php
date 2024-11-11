<?php
session_start();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Defina o email e a senha do administrador
    $adminEmail = "adm@q.com";
    $adminPassword = "123";

    // Dados enviados pelo formulário
    $email = $_POST['email'];
    $password = $_POST['password'];

    // Verificação do email e senha
    if ($email === $adminEmail && $password === $adminPassword) {
        $_SESSION['logged_in'] = true;
        header("Location: sistema.php"); // Redireciona para a página do admin
        exit;
    } else {
        $error = "Email ou senha incorretos!";
    }
}
?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <title>Login Admin</title>
</head>
<body>
    <h2>Login do Administrador</h2>

    <?php if (isset($error)) : ?>
        <p style="color: red;"><?php echo $error; ?></p>
    <?php endif; ?>

    <form method="post" action="sistema.php">
        <label for="email">Email:</label>
        <input type="email" name="email" id="email" required><br><br>

        <label for="password">Senha:</label>
        <input type="password" name="password" id="password" required><br><br>

        <input type="submit">
    </form>
</body>
</html>
