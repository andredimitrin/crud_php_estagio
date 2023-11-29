<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <title>CRUD - Lista de Usuários</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 20px;
            background-color: #f4f4f4;
        }

        h2 {
            color: #333;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }

        th, td {
            border: 1px solid #ddd;
            padding: 8px;
            text-align: left;
        }

        th {
            background-color: #4CAF50;
            color: white;
        }

        tr:hover {
            background-color: #f5f5f5;
        }

        a {
            text-decoration: none;
            color: #007bff;
            margin-right: 10px;
        }

        a:hover {
            text-decoration: underline;
        }
    </style>
</head>
<body>
    <?php
    include "conexao.php";

    // Processar a exclusão do usuário se um ID for fornecido
    if ($_SERVER["REQUEST_METHOD"] == "GET" && isset($_GET["delete_id"])) {
        $delete_id = $_GET["delete_id"];

        // Excluir no banco de dados
        $sql = "DELETE FROM usuarios WHERE id = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("i", $delete_id);

        if ($stmt->execute()) {
            echo "Usuário excluído com sucesso!";
        } else {
            echo "Erro ao excluir usuário: " . $stmt->error;
        }

        $stmt->close();
    }

    // Consultar e exibir a lista de usuários
    $sql = "SELECT id, nome, email FROM usuarios";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        echo "<table>
                <tr>
                    <th>ID</th>
                    <th>Nome</th>
                    <th>Email</th>
                    <th>Ações</th>
                </tr>";

        while ($row = $result->fetch_assoc()) {
            echo "<tr>
                    <td>{$row['id']}</td>
                    <td>{$row['nome']}</td>
                    <td>{$row['email']}</td>
                    <td>
                        <a href='editar.php?id={$row['id']}'>Editar</a>
                        <a href='index.php?delete_id={$row['id']}'>Excluir</a>
                    </td>
                </tr>";
        }

        echo "</table>";
    } else {
        echo "Nenhum usuário encontrado.";
    }

    $conn->close();
    ?>

    <p><a href="cadastro.php">Adicionar Novo Usuário</a></p>
</body>
</html>
