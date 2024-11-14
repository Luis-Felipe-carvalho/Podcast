<?php
// Configurações do banco de dados
$dbHost = 'localhost';
$dbUsername = 'root';
$dbPassword = '';
$dbName = 'podcast';

try {
    // Conexão usando PDO com MySQL
    $pdo = new PDO("mysql:host=$dbHost;dbname=$dbName;charset=utf8", $dbUsername, $dbPassword);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    // Exibe uma mensagem de erro em caso de falha na conexão
    die("Erro ao conectar ao banco de dados: " . $e->getMessage());
}
?>
