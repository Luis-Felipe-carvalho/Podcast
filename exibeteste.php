<?php
require 'config.php';

try {
    $sql = "SELECT id, imagem, descricao, link FROM podcasts";
    $stmt = $pdo->prepare($sql);
    $stmt->execute();
    $resultados = $stmt->fetchAll(PDO::FETCH_ASSOC);
} catch (PDOException $e) {
    die("Erro ao buscar os dados: " . $e->getMessage());
}
?>

<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Podcasts</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body>
    <div class="container mt-5">
        <h1 class="text-center mb-4">Podcasts</h1>
        <div class="row">
            <?php if (count($resultados) > 0): ?>
                <?php foreach ($resultados as $row): ?>
                    <div class="col-md-4 mb-4">
                        <div class="card h-100">
                            <?php if (!empty($row['imagem'])): ?>
                                <!-- Converte a imagem de blob para base64 e exibe -->
                                <img src="IMG?<?=$row['imagem']?>" class="card-img-top"
                                     alt="Imagem do Podcast" style="width: 100%; height: auto;">
                            <?php else: ?>
                                <img src="placeholder.jpg" class="card-img-top" alt="Imagem indisponível"
                                     style="width: 100%; height: auto;">
                            <?php endif; ?>

                            <div class="card-body">
                                <p class="card-text"><?= htmlspecialchars($row['descricao']) ?></p>
                            </div>
                            <div class="card-footer text-center">
                                <a href="<?= htmlspecialchars($row['link']) ?>" target="_blank" class="btn btn-primary">Ver Episódios</a>
                            </div>
                        </div>
                    </div>
                <?php endforeach; ?>
            <?php else: ?>
                <p class="text-center">Nenhum podcast encontrado.</p>
            <?php endif; ?>
        </div>
    </div>
</body>

</html>