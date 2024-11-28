<?php
// Inclui o arquivo de configuração do banco de dados
require 'config.php';

// Verifica se o formulário foi enviado
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Valida os campos do formulário
    if (isset($_FILES['imagem']['tmp_name'], $_POST['descricao'], $_POST['link'])) {
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
                $sql = "INSERT INTO podcasts (imagem, descricao, link) VALUES (:imagem, :descricao, :link)";
                $stmt = $pdo->prepare($sql);
                $stmt->bindParam(':imagem', $nomeImagem); // Salva apenas o nome da imagem no banco
                $stmt->bindParam(':descricao', $descricao);
                $stmt->bindParam(':link', $link);
                $stmt->execute();
                header('Location: index.php'); // Redireciona após o cadastro
                exit();
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

// Busca os podcasts cadastrados
$sql = "SELECT * FROM podcasts";
$stmt = $pdo->prepare($sql);
$stmt->execute();
$podcasts = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="estilo.css">
    <title>PodRecomenda</title>
    <style>
        /* Adicionando o estilo para as imagens quadradas */
        .card img {
            width: 346.66px;
            height: 346.66px;
            object-fit: cover;
            /* Garante que a imagem seja cortada para se ajustar ao tamanho */
        }

        /* Estilização do container com 3 podcasts por linha */
        .container {
            display: grid;
            grid-template-columns: repeat(3, 1fr);
            gap: 20px;
            justify-items: center;
        }

        /* Estilo das divs de card */
        .card {
            text-align: center;
        }

        /* Estilo do botão */
        .card button {
            margin-top: 10px;
        }
    </style>
</head>

<body>
    <div class="hero">
        <div class="navbar">
            <div class="cadu">
                <a href="index.html" class="logo">
                    <img src="../IMG/Podcast_Logo_-_Feito_com_PosterMyWall-removebg-preview.png" alt="">
                </a>
            </div>
            <a href="index2.php">Destaques</a>
            <a href="../admpod.php">Adicionar Podcast</a>
            <a href="sair.php">Sair</a>
        </div>
        <div class="fraseimagem">
            <ul>
                <h1>"Cada episódio é uma nova oportunidade de aprender, crescer e se inspirar. O que você ouvir hoje
                    pode transformar o seu amanhã."</h1>
                <p>-PodRecomenda-</p>
            </ul>
        </div>
    </div>

    <div class="container">
        <?php foreach ($podcasts as $podcast): ?>
            <div class="card">
                <img src="../IMG/<?= htmlspecialchars($podcast['imagem']) ?>"
                    alt="<?= htmlspecialchars($podcast['descricao']) ?>">
                <h2><?= htmlspecialchars($podcast['titulo']) ?></h2> <!-- Exibe o título aqui -->
                <p><?= htmlspecialchars($podcast['descricao']) ?></p>
                <button><a href="<?= htmlspecialchars($podcast['link']) ?>">Ver Episódios</a></button>
            </div>
        <?php endforeach; ?>
    </div>


    <footer>
        <p>&copy; 2024 PodRecomenda. Todos os direitos reservados.</p>
    </footer>

</body>

</html>