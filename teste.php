<?php
// Inclui o arquivo de configuração do banco de dados
require 'config.php';

// Verifica se o formulário foi enviado
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Valida os campos do formulário
    if (isset($_FILES['imagem']['tmp_name'], $_POST['titulo'], $_POST['descricao'], $_POST['link'])) {
        $titulo = $_POST['titulo']; // Novo campo para o título
        $descricao = $_POST['descricao'];
        $link = $_POST['link'];

        // Processa a imagem
        $extensao = str_replace('image/', '', $_FILES['imagem']['type']);
        $nomeImagem = 'foto_' . uniqid() . '.' . $extensao;  // Gera um nome único para a imagem
        $caminhoImagem = __DIR__ . '/IMG/' . $nomeImagem;

        // Move a imagem para a pasta 'IMG'
        if (move_uploaded_file($_FILES['imagem']['tmp_name'], $caminhoImagem)) {
            try {
                // Substitua 'podcasts' pelo nome real da sua tabela
                $sql = "INSERT INTO podcasts (titulo, imagem, descricao, link) VALUES (:titulo, :imagem, :descricao, :link)";
                $stmt = $pdo->prepare($sql);
                $stmt->bindParam(':titulo', $titulo);  // Salva o título
                $stmt->bindParam(':imagem', $nomeImagem); // Salva apenas o nome da imagem no banco
                $stmt->bindParam(':descricao', $descricao);
                $stmt->bindParam(':link', $link);
                $stmt->execute();
                echo "<p class='success'>Cadastro realizado com sucesso!</p>";
            } catch (PDOException $e) {
                echo "<p class='error'>Erro ao cadastrar: " . $e->getMessage() . "</p>";
            }
        } else {
            echo "<p class='error'>Erro ao fazer upload da imagem!</p>";
        }
    } else {
        echo "<p class='error'>Preencha todos os campos!</p>";
    }
}
?>

<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cadastro de Podcast</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-image: url('../img.png');
            background-size: cover;
            background-position: center;
            margin: 0;
            padding: 0;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            color: #fff;
        }

        .container {
            background: rgba(0, 0, 0, 0.8);
            padding: 30px;
            border-radius: 15px;
            width: 400px;
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.5);
        }

        h1 {
            text-align: center;
            margin-bottom: 20px;
            color: #fff;
        }

        label {
            display: block;
            margin: 10px 0 5px;
        }

        input[type="text"],
        input[type="url"],
        input[type="file"] {
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
            margin-top: 10px;
        }

        button:hover {
            background: #1abc9c;
        }

        .success {
            color: #2ecc71;
            text-align: center;
        }

        .error {
            color: #e74c3c;
            text-align: center;
        }

        form {
            margin-bottom: 10px;
        }
    </style>
</head>

<body>
    <div class="container">
        <h1>Cadastro de Podcast</h1>
        <form action="" method="POST" enctype="multipart/form-data">
            <label for="imagem">Imagem:</label>
            <input type="file" name="imagem" id="imagem" required>

            <label for="titulo">Título:</label>
            <input type="text" name="titulo" id="titulo" required>

            <label for="descricao">Descrição:</label>
            <input type="text" name="descricao" id="descricao" required>

            <label for="link">Link:</label>
            <input type="url" name="link" id="link" required>

            <button type="submit">Cadastrar</button>
        </form>

        <form action="../Podcast/View/index2.php">
            <button type="submit">Ir para Página</button>
        </form>
    </div>
</body>

</html>
