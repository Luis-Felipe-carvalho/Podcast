<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>HOME</title>
    <style>
        body {
            margin: 0;
            padding: 0;
            font-family: 'Arial', sans-serif;
            background-image: url('../img.png');
            background-size: cover;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            color: #fff;
        }

        .box {
            background-color: rgba(255, 255, 255, 0.1);
            padding: 30px 50px;
            border-radius: 12px;
            text-align: center;
            box-shadow: 0 8px 15px rgba(0, 0, 0, 0.2);
        }


        .box a {
            display: inline-block;
            text-decoration: none;
            font-size: 18px;
            font-weight: bold;
            color: #ffffff;
            background-color: rgba(255, 255, 255, 0.2);
            padding: 12px 30px;
            border-radius: 30px;
            margin: 10px 0;
            transition: all 0.3s ease;
        }

        .box a:hover {
            background-color: #ffffff;
            color: #4CAF50;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.2);
        }
    </style>
</head>

<body>
    <div class="box">
        <h1>Bem-vindo!</h1>
        <p>Escolha uma das opções abaixo:</p>
        <a href="login.php">Login</a>
        <a href="formulario.php">Cadastre-se</a>
        <a href="adm.php">ADM</a>
    </div>
</body>

</html>
