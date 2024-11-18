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
?>
<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editar Usuários</title>
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
            min-height: 100vh;
            display: flex;
            justify-content: center;
            align-items: center;
            color: white;
        }

        .container {
            background: rgba(255, 255, 255, 0.1);
            padding: 20px;
            border-radius: 15px;
            backdrop-filter: blur(10px);
            text-align: center;
            width: 100%;
            max-width: 600px;
            box-shadow: 0 8px 32px rgba(0, 0, 0, 0.3);
        }

        h1 {
            font-size: 24px;
            margin-bottom: 20px;
        }

        a.btn {
            display: inline-block;
            text-decoration: none;
            padding: 10px 20px;
            margin: 10px 5px;
            border-radius: 5px;
            background: #ff4b5c;
            color: white;
            transition: all 0.3s ease;
        }

        a.btn:hover {
            background: #e9454a;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }

        table th,
        table td {
            padding: 10px;
            text-align: center;
            border: 1px solid rgba(255, 255, 255, 0.3);
        }

        table th {
            background: rgba(0, 0, 0, 0.6);
        }

        table td {
            background: rgba(255, 255, 255, 0.1);
        }

        table td a {
            text-decoration: none;
            padding: 5px 10px;
            border-radius: 5px;
            color: white;
        }

        table td a.btn-primary {
            background: #007bff;
        }

        table td a.btn-primary:hover {
            background: #0056b3;
        }

        table td a.btn-danger {
            background: #dc3545;
        }

        table td a.btn-danger:hover {
            background: #b02a37;
        }
    </style>
</head>

<body>
    <div class="container">
        <h1>Bem-vindo, <u><?= htmlspecialchars($logado) ?></u></h1>
        
        <table>
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Email</th>
                    <th>Senha</th>
                    <th>Ações</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $sql = "SELECT * FROM usuarios";
                $stmt = $pdo->prepare($sql);
                $stmt->execute();

                if ($stmt->rowCount() > 0) {
                    while ($user_data = $stmt->fetch(PDO::FETCH_ASSOC)) {
                        echo "<tr>";
                        echo "<td>" . htmlspecialchars($user_data['id']) . "</td>";
                        echo "<td>" . htmlspecialchars($user_data['email']) . "</td>";
                        echo "<td>" . htmlspecialchars($user_data['senha']) . "</td>";
                        echo "<td>
                            <a class='btn-primary' href='edit.php?id=" . $user_data['id'] . "'>Editar</a>
                            <a class='btn-danger' href='delete.php?id=" . $user_data['id'] . "'>Deletar</a>
                          </td>";
                        echo "</tr>";
                    }
                } else {
                    echo "<tr><td colspan='4'>Nenhum dado encontrado.</td></tr>";
                }
                ?>
                <a href="sair.php" class="btn">Sair</a>
            </tbody>
        </table>
    </div>
</body>

</html>
