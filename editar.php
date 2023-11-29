<?php
include "conexao.php";

if ($_SERVER["REQUEST_METHOD"] == "GET" && isset($_GET["id"])) {
    $id = $_GET["id"];
    $sql = "SELECT * FROM usuarios WHERE id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $id);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows == 1) {
        $row = $result->fetch_assoc();
    } else {
        echo "Usuário não encontrado.";
        exit();
    }

    $stmt->close();
} else {
    echo "ID do usuário não fornecido.";
    exit();
}
?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <title>CRUD - Editar Usuário</title>
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

        a {
            text-decoration: none;
            color: #007bff;
            margin-right: 10px;
        }

        a:hover {
            text-decoration: underline;
        }

        .back-button {
            background-color: #007bff;
            color: white;
            padding: 10px 15px;
            border: none;
            cursor: pointer;
        }

        .back-button:hover {
            background-color: #0056b3;
        }
    </style>
</head>
<body>
    <h2>Editar Usuário</h2>

    <form action="editar_processa.php" method="POST">
        <input type="hidden" name="id" value="<?php echo $row['id']; ?>">

        <label for="nome">Nome:</label>
        <input type="text" name="nome" value="<?php echo $row['nome']; ?>" required>

        <label for="cpf">CPF:</label>
        <input type="text" name="cpf" value="<?php echo $row['cpf']; ?>">

        <label for="data_nascimento">Data de Nascimento:</label>
        <input type="date" name="data_nascimento" value="<?php echo $row['data_nascimento']; ?>" required>

        <label for="email">Email:</label>
        <input type="email" name="email" value="<?php echo $row['email']; ?>" required>

        <label for="telefone">Telefone:</label>
        <input type="tel" name="telefone" value="<?php echo $row['telefone']; ?>">

        <label for="endereco">Endereço:</label>
        <input type="text" name="endereco" value="<?php echo $row['endereco']; ?>">

        <label for="cidade">Cidade:</label>
        <input type="text" name="cidade" value="<?php echo $row['cidade']; ?>">

        <label for="estado">Estado:</label>
        <input type="text" name="estado" maxlength="2" value="<?php echo $row['estado']; ?>">

        <br><br>

        <input type="submit" name="submit_update" value="Salvar Alterações">
    </form>

    <a class="back-button" href="index.php">Voltar para a Lista de Usuários</a>

    <script>
        // JavaScript para validar a data de nascimento
        document.querySelector('input[name="data_nascimento"]').addEventListener('input', function() {
            let currentDate = new Date();
            let inputDate = new Date(this.value);
            
            if (inputDate > currentDate) {
                alert('A data de nascimento não pode ser no futuro.');
                this.value = '';
            }
        });
    </script>
</body>
</html>
