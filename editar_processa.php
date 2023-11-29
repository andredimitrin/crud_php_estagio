<?php
include "conexao.php";

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["submit_update"])) {
    // Usar prepared statements para prevenir SQL injection
    $stmt = $conn->prepare("UPDATE usuarios SET nome = ?, cpf = ?, data_nascimento = ?, email = ?, telefone = ?, endereco = ?, cidade = ?, estado = ? WHERE id = ?");

    if (!$stmt) {
        die("Erro na preparação da consulta: " . $conn->error);
    }

    // Atribuir valores
    $id = $_POST["id"];
    $nome = $_POST["nome"];
    $cpf = $_POST["cpf"];
    $data_nascimento = $_POST["data_nascimento"];
    $email = $_POST["email"];
    $telefone = $_POST["telefone"];
    $endereco = $_POST["endereco"];
    $cidade = $_POST["cidade"];
    $estado = $_POST["estado"];

    $stmt->bind_param("ssssssssi", $nome, $cpf, $data_nascimento, $email, $telefone, $endereco, $cidade, $estado, $id);

    // Executar a atualização
    if ($stmt->execute()) {
        // Redirecionar para index.php após a atualização
        header("Location: index.php");
        exit();
    } else {
        echo "Erro ao atualizar: " . $stmt->error;
    }

    $stmt->close();
}

$conn->close();
?>
