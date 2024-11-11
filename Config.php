<?php
$servername = "localhost";
$username = "root"; // Insira seu usuário do banco de dados
$password = ""; // Insira sua senha do banco de dados
$dbname = "podcast";

// Conexão com o banco de dados
$conn = new mysqli($servername, $username, $password, $dbname);

// Verifica a conexão
if ($conn->connect_error) {
    die("Falha na conexão: " . $conn->connect_error);
}
?>