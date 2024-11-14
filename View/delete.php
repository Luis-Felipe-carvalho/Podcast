<?php
if (!empty($_GET['id'])) {
    include_once('config.php');

    $id = $_GET['id'];

    // Preparar a consulta SQL para selecionar o usuário
    $sqlSelect = "SELECT * FROM usuarios WHERE id = :id";
    $stmt = $pdo->prepare($sqlSelect);
    $stmt->bindParam(':id', $id, PDO::PARAM_INT);
    $stmt->execute();

    // Verificar se há dados para excluir
    if ($stmt->rowCount() > 0) {
        // Preparar a consulta SQL para exclusão
        $sqlDelete = "DELETE FROM usuarios WHERE id = :id";
        $stmtDelete = $pdo->prepare($sqlDelete);
        $stmtDelete->bindParam(':id', $id, PDO::PARAM_INT);
        $stmtDelete->execute();
    }
}
header('Location: sistema.php');
exit;

?>