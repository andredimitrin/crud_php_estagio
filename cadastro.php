<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <title>CRUD - Cadastro de Usuário</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 20px;
            background-color: #f4f4f4;
        }

        h2 {
            color: #333;
        }

        form {
            width: 400px;
            margin: 20px 0;
        }

        label {
            display: block;
            margin-bottom: 5px;
        }

        input[type="text"],
        input[type="email"],
        input[type="date"],
        input[type="tel"] {
            width: 100%;
            padding: 8px;
            margin-bottom: 10px;
            box-sizing: border-box;
        }

        input[type="submit"] {
            background-color: #4CAF50;
            color: white;
            padding: 10px 15px;
            border: none;
            cursor: pointer;
        }

        input[type="submit"]:hover {
            background-color: #45a049;
        }

        .error-message {
            color: red;
            margin-top: -10px;
            margin-bottom: 10px;
        }

        .back-button {
            background-color: #007bff;
            color: white;
            padding: 10px 15px;
            border: none;
            cursor: pointer;
            text-decoration: none;
            display: inline-block;
        }

        .back-button:hover {
            background-color: #0056b3;
        }
    </style>
</head>
<body>
    <?php
    include "conexao.php";

    $error_messages = [];

    if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["submit_create"])) {
        // Usar prepared statements para prevenir SQL injection
        $stmt = $conn->prepare("INSERT INTO usuarios (nome, cpf, data_nascimento, email, telefone, endereco, cidade, estado)
                                VALUES (?, ?, ?, ?, ?, ?, ?, ?)");

        if (!$stmt) {
            die("Erro na preparação da consulta: " . $conn->error);
        }

        // Atribuir valores
        $nome = $_POST["nome"];
        $cpf = $_POST["cpf"];
        $data_nascimento = $_POST["data_nascimento"];
        $email = $_POST["email"];
        $telefone = $_POST["telefone"];
        $endereco = $_POST["endereco"];
        $cidade = $_POST["cidade"];
        $estado = $_POST["estado"];

        // Validar campos obrigatórios
        if (empty($nome) || empty($email)) {
            $error_messages[] = "Os campos Nome e Email são obrigatórios.";
        }

        // Executar a inserção se não houver mensagens de erro
        if (empty($error_messages)) {
            $stmt->bind_param("ssssssss", $nome, $cpf, $data_nascimento, $email, $telefone, $endereco, $cidade, $estado);

            // Executar a inserção
            if ($stmt->execute()) {
                echo "Cadastro realizado com sucesso!";
            } else {
                echo "Erro ao cadastrar: " . $stmt->error;
            }

            $stmt->close();
        }
    }

    $conn->close();
    ?>

    <h2>Cadastro de Usuário</h2>

    <?php
    if (!empty($error_messages)) {
        foreach ($error_messages as $error) {
            echo "<p class='error-message'>$error</p>";
        }
    }
    ?>

    <form action="cadastro.php" method="POST">
        <label for="nome">Nome:</label>
        <input type="text" name="nome" required>

        <label for="cpf">CPF:</label>
        <input type="text" name="cpf">

        <label for="data_nascimento">Data de Nascimento:</label>
        <input type="date" name="data_nascimento">

        <label for="email">Email:</label>
        <input type="email" name="email" required>

        <label for="telefone">Telefone:</label>
        <input type="tel" name="telefone">

        <label for="endereco">Endereço:</label>
        <input type="text" name="endereco">

        <label for="cidade">Cidade:</label>
        <input type="text" name="cidade">

        <label for="estado">Estado:</label>
        <input type="text" name="estado" maxlength="2">

        <br><br>

        <input type="submit" name="submit_create" value="Cadastrar">
    </form>

    <a class="back-button" href="index.php">Voltar para a Lista de Usuários</a>
</body>
</html>
