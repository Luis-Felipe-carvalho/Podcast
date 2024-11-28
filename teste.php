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
                echo "Cadastro realizado com sucesso!";
            } catch (PDOException $e) {
                echo "Erro ao cadastrar: " . $e->getMessage();
            }
        } else {
            echo "Erro ao fazer upload da imagem!";
        }
    } else {
        echo "Preencha todos os campos!";
    }
}
?>

<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cadastro de Podcast</title>
</head>

<body>
    <h1>Cadastro de Podcast</h1>
    <form action="" method="POST" enctype="multipart/form-data">
        <label for="imagem">Imagem:</label><br>
        <input type="file" name="imagem" id="imagem" required><br><br>

        <label for="titulo">Título:</label><br>
        <input type="text" name="titulo" id="titulo" required><br><br>

        <label for="descricao">Descrição:</label><br>
        <input type="text" name="descricao" id="descricao" required><br><br>

        <label for="link">Link:</label><br>
        <input type="url" name="link" id="link" required><br><br>

        <button type="submit">Cadastrar</button>

    </form>
    <form action='../Podcast/View/index2.php'>
        <button type='submit'>Ir para Página</button>
    </form>
</body>

</html>