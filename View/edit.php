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
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editar Usuário</title>
</head>
<body>
    <a href="sistema.php">Voltar</a>
    <div class="box">
        <form action="saveEdit.php" method="POST">
            <fieldset>
                <legend><b>Editar Usuário</b></legend>
                <br>
                <div class="inputBox">
                    <input type="text" name="email" id="email" class="inputUser" value="<?php echo htmlspecialchars($email); ?>" required>
                    <label for="email" class="labelInput">Email</label>
                </div>
                <br><br>
                <div class="inputBox">
                    <input type="text" name="senha" id="senha" class="inputUser" value="<?php echo htmlspecialchars($senha); ?>" required>
                    <label for="senha" class="labelInput">Senha</label>
                </div>
                <br><br>
                <input type="hidden" name="id" value="<?php echo $id; ?>">
                <input type="submit" name="update" id="submit">
            </fieldset>
        </form>
    </div>
</body>
</html>
