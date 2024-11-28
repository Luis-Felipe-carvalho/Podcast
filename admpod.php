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
        $erro = "Acesso negado. Verifique suas credenciais.";
    }
}
?>

<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-image: url('../img.png');
            background-size: cover;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            margin: 0;
            color: white;
        }

        form {
            background: rgba(255, 255, 255, 0.1);
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.5);
            width: 300px;
            text-align: center;
        }

        h2 {
            margin-bottom: 20px;
        }

        label {
            display: block;
            margin: 10px 0 5px;
        }

        input {
            width: 100%;
            padding: 10px;
            margin-bottom: 15px;
            border: none;
            border-radius: 5px;
        }

        button {
            background: #2980b9;
            color: white;
            padding: 10px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            width: 100%;
        }

        button:hover {
            background: #1abc9c;
        }

        .error {
            color: #e74c3c;
            margin-top: 10px;
        }
    </style>
</head>

<body>
    <form method="POST" action="">
        <h2>Login</h2>

        <label for="email">E-mail:</label>
        <input type="email" id="email" name="email" required placeholder="Digite seu e-mail">

        <label for="senha">Senha:</label>
        <input type="password" id="senha" name="senha" required placeholder="Digite sua senha">

        <button type="submit">Entrar</button>

        <?php
        // Exibir a mensagem de erro caso exista
        if (isset($erro)) {
            echo "<p class='error'>$erro</p>";
        }
        ?>
    </form>
</body>

</html>
