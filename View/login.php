<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tela de Login</title>
    <style>
        /* Estilos Gerais */
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Arial', sans-serif;
            background-image: url('../img.png');
            background-size: cover;
            height: 100vh;
            display: flex;
            justify-content: center;
            align-items: center;
            color: #fff;
        }

        .container {
            background: rgba(255, 255, 255, 0.1);
            padding: 30px;
            border-radius: 15px;
            box-shadow: 0 8px 32px rgba(0, 0, 0, 0.2);
            backdrop-filter: blur(10px);
            text-align: center;
            width: 100%;
            max-width: 400px;
        }

        a {
            color: #ddd;
            text-decoration: none;
            font-size: 14px;
            margin-bottom: 20px;
            display: inline-block;
            transition: color 0.3s ease;
        }

        a:hover {
            color: #fff;
        }

        h1 {
            font-size: 24px;
            margin-bottom: 20px;
            color: #fff;
        }

        input[type="text"],
        input[type="password"] {
            width: 100%;
            padding: 15px;
            margin: 10px 0;
            border: none;
            border-radius: 8px;
            font-size: 16px;
            background: rgba(255, 255, 255, 0.2);
            color: #fff;
            outline: none;
            transition: background 0.3s ease;
        }

        input[type="text"]::placeholder,
        input[type="password"]::placeholder {
            color: #ddd;
        }

        input[type="text"]:focus,
        input[type="password"]:focus {
            background: rgba(255, 255, 255, 0.3);
        }

        .inputSubmit {
            width: 100%;
            padding: 15px;
            background: #2575fc;
            border: none;
            border-radius: 8px;
            font-size: 16px;
            font-weight: bold;
            color: #fff;
            cursor: pointer;
            transition: background 0.3s ease;
        }

        .inputSubmit:hover {
            background: #1b5ecc;
        }
    </style>
</head>

<body>
    <section class="container">
        <div>
            <h1>Login</h1>
            <form action="testLogin.php" method="POST">
                <input type="text" name="email" placeholder="Email">
                <input type="password" name="senha" placeholder="Senha">
                <br>
                <br>
                <input class="inputSubmit" type="submit" name="submit" value="Entrar">
                <br>
                <br>
                <a href="home.php">Voltar</a>
            </form>
        </div>
    </section>
</body>

</html>
