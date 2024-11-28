<?php
if (isset($_POST['submit'])) {
    include_once('config.php');
    $email = $_POST['email'];
    $senha = $_POST['senha'];

    // Insere o usuário no banco de dados com segurança usando PDO
    $sql = "INSERT INTO usuarios (email, senha) VALUES (:email, :senha)";
    $stmt = $pdo->prepare($sql);
    $stmt->bindParam(':email', $email);
    $stmt->bindParam(':senha', $senha);

    if ($stmt->execute()) {
        // Redireciona para a página de login se a inserção for bem-sucedida
        header('Location: login.php');
        exit();
    } else {
        echo "Erro ao inserir os dados!";
    }
}
?>
<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cadastrar</title>
    <style>
        /* Estilos Gerais */
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: Arial, sans-serif;
            background-image: url('../img.png');
            background-size: cover;
            height: 100vh;
            display: flex;
            justify-content: center;
            align-items: center;
            color: #fff;
        }

        a {
            text-decoration: none;
            color: #ddd;
            font-size: 14px;
            margin-bottom: 20px;
            display: inline-block;
            transition: color 0.3s ease;
        }

        a:hover {
            color: #fff;
        }

        .box {
            background: rgba(255, 255, 255, 0.1);
            padding: 30px;
            border-radius: 15px;
            box-shadow: 0 8px 32px rgba(0, 0, 0, 0.2);
            backdrop-filter: blur(10px);
            width: 100%;
            max-width: 400px;
            text-align: center;
        }

        fieldset {
            border: none;
        }

        legend {
            font-size: 20px;
            font-weight: bold;
            margin-bottom: 20px;
            color: #fff;
        }

        .inputBox {
            position: relative;
            margin-bottom: 20px;
        }

        .inputUser {
            width: 100%;
            padding: 15px;
            background: rgba(255, 255, 255, 0.2);
            border: none;
            border-radius: 8px;
            color: #fff;
            font-size: 16px;
            outline: none;
            transition: background 0.3s ease;
        }

        .inputUser:focus {
            background: rgba(255, 255, 255, 0.3);
        }

        .labelInput {
            position: absolute;
            top: 50%;
            left: 15px;
            transform: translateY(-50%);
            color: #ddd;
            font-size: 14px;
            pointer-events: none;
            transition: 0.3s ease;
        }

        .inputUser:focus ~ .labelInput,
        .inputUser:not(:placeholder-shown) ~ .labelInput {
            top: 5px;
            font-size: 12px;
            color: #fff;
        }

        #submit {
            width: 100%;
            padding: 15px;
            background: #2575fc;
            border: none;
            border-radius: 8px;
            color: #fff;
            font-size: 16px;
            font-weight: bold;
            cursor: pointer;
            transition: background 0.3s ease;
        }

        #submit:hover {
            background: #1b5ecc;
        }
    </style>
</head>

<body>
    <div class="box">
        <a href="home.php">Voltar</a>
        <form action="formulario.php" method="POST">
            <fieldset>
                <legend><b>Formulário de Cadastro</b></legend>
                <div class="inputBox">
                    <input type="text" name="email" id="email" class="inputUser" placeholder=" " required>
                    <label for="email" class="labelInput">Email</label>
                </div>
                <div class="inputBox">
                    <input type="password" name="senha" id="senha" class="inputUser" placeholder=" " required>
                    <label for="senha" class="labelInput">Senha</label>
                </div>
                <input type="submit" name="submit" id="submit" value="Cadastrar">
            </fieldset>
        </form>
    </div>
</body>

</html>

