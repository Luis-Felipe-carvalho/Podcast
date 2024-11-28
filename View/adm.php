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
    <style>
        body {
            font-family: Arial, sans-serif;
            background-image: url('../img.png');
            background-size: cover;
            height: 100vh;
            margin: 0;
            display: flex;
            justify-content: center;
            align-items: center;
            color: #fff;
        }

        .login-container {
            background: rgba(255, 255, 255, 0.1);
            padding: 30px;
            border-radius: 15px;
            box-shadow: 0 8px 32px rgba(0, 0, 0, 0.2);
            backdrop-filter: blur(10px);
            text-align: center;
            width: 100%;
            max-width: 400px;
        }

        h2 {
            margin-bottom: 20px;
            font-size: 24px;
        }

        label {
            display: block;
            text-align: left;
            font-size: 14px;
            margin-bottom: 5px;
        }

        input[type="email"],
        input[type="password"] {
            width: 100%;
            padding: 10px;
            margin-bottom: 15px;
            border: none;
            border-radius: 8px;
            background: rgba(255, 255, 255, 0.2);
            color: #fff;
            font-size: 14px;
            outline: none;
            transition: background 0.3s ease;
        }

        input[type="email"]:focus,
        input[type="password"]:focus {
            background: rgba(255, 255, 255, 0.3);
        }

        button {
            width: 100%;
            padding: 10px;
            background: #2575fc;
            border: none;
            border-radius: 8px;
            color: #fff;
            font-size: 16px;
            cursor: pointer;
            transition: background 0.3s ease;
        }

        button:hover {
            background: #1b5ecc;
        }

        p {
            color: red;
            font-size: 14px;
        }
    </style>
</head>

<body>
    <div class="login-container">
        <h2>Login de Administração</h2>
        <form method="POST">
            <label for="email">Email:</label>
            <input type="email" id="email" name="email" required>

            <label for="senha">Senha:</label>
            <input type="password" id="senha" name="senha" required>

            <button type="submit">Entrar</button>
        </form>

        <?php
        // Exibe a mensagem de erro se o login falhar ou o email for restrito
        if (isset($error)) {
            echo "<p>$error</p>";
        }
        ?>
    </div>
</body>

</html>
