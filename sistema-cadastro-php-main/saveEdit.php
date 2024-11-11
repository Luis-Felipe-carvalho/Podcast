<?php
    // isset -> serve para saber se uma variável está definida
    include_once('config.php');
    if(isset($_POST['update']))
    {
        $id = $_POST['id'];
        $email = $_POST['email'];
        $senha = $_POST['senha'];

        
        $sqlInsert = "UPDATE usuarios 
        SET email='$email',senha='$senha'
        WHERE id=$id";
        $result = $conexao->query($sqlInsert);
        print_r($result);
    }
    header('Location: sistema.php');

?>