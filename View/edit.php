<?php
include_once('config.php');

if (!empty($_GET['id'])) {
    $id = $_GET['id'];

    // Preparar a consulta SQL com um marcador de posição
    $sqlSelect = "SELECT * FROM usuarios WHERE id = :id";

    // Preparar a instrução
    $stmt = $pdo->prepare($sqlSelect);

    // Executar a consulta com o parâmetro id
    $stmt->bindParam(':id', $id, PDO::PARAM_INT);
    $stmt->execute();

    // Verificar se há dados
    if ($stmt->rowCount() > 0) {
        while ($user_data = $stmt->fetch(PDO::FETCH_ASSOC)) {
            $email = $user_data['email'];
            $senha = $user_data['senha'];
        }
    } else {
        // Se não houver resultados, redireciona
        header('Location: sistema.php');
        exit;
    }
} else {
    header('Location: sistema.php');
    exit;
}
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editar Usuário</title>
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

        .box {
            background: rgba(255, 255, 255, 0.1);
            padding: 30px;
            border-radius: 15px;
            box-shadow: 0 8px 32px rgba(0, 0, 0, 0.2);
            backdrop-filter: blur(10px);
            width: 100%;
            max-width: 400px;
        }

        a {
            color: #ddd;
            text-decoration: none;
            font-size: 14px;
            margin-bottom: 20px;
            display: inline-block;
            transition: color 0.3s ease;
        }

        a:hover {
            color: #fff;
        }

        fieldset {
            border: none;
            text-align: center;
        }

        legend {
            font-size: 20px;
            font-weight: bold;
            color: #fff;
        }

        .inputBox {
            position: relative;
            margin-bottom: 20px;
        }

        .inputUser {
            width: 100%;
            padding: 10px 10px 10px 5px;
            background: rgba(255, 255, 255, 0.2);
            border: none;
            border-radius: 5px;
            color: #fff;
            font-size: 16px;
            outline: none;
        }

        .inputUser:focus {
            background: rgba(255, 255, 255, 0.3);
        }

        .labelInput {
            position: absolute;
            top: 10px;
            left: 10px;
            pointer-events: none;
            color: #ddd;
            transition: all 0.3s ease;
        }

        .inputUser:focus + .labelInput,
        .inputUser:not(:placeholder-shown) + .labelInput {
            top: -10px;
            left: 10px;
            font-size: 12px;
            color: #fff;
        }

        #submit {
            background: #2575fc;
            color: white;
            border: none;
            padding: 10px 20px;
            border-radius: 5px;
            font-size: 16px;
            cursor: pointer;
            width: 100%;
        }

        #submit:hover {
            background: #1b5ecc;
        }
    </style>
</head>
<body>
    <div class="box">
        <a href="sistema.php">Voltar</a>
        <form action="saveEdit.php" method="POST">
            <fieldset>
                <legend>Editar Usuário</legend>
                <div class="inputBox">
                    <input type="text" name="email" id="email" class="inputUser" value="<?php echo htmlspecialchars($email); ?>" required>
                    <label for="email" class="labelInput">Email</label>
                </div>
                <div class="inputBox">
                    <input type="text" name="senha" id="senha" class="inputUser" value="<?php echo htmlspecialchars($senha); ?>" required>
                    <label for="senha" class="labelInput">Senha</label>
                </div>
                <input type="hidden" name="id" value="<?php echo $id; ?>">
                <input type="submit" name="update" id="submit" value="Salvar">
            </fieldset>
        </form>
    </div>
</body>
</html>
