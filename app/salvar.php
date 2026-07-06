<?php

require_once "conexao.php";

if ($_SERVER["REQUEST_METHOD"] !== "POST") {
    header("Location: index.php");
    exit;
}

$nome = trim($_POST["nome"] ?? "");
$telefone = trim($_POST["telefone"] ?? "");
$email = trim($_POST["email"] ?? "");

if (empty($nome)) {
    die("O nome é obrigatório.");
}

$stmt = $conn->prepare("
    INSERT INTO contatos (nome, telefone, email)
    VALUES (?, ?, ?)
");

$stmt->bind_param(
    "sss",
    $nome,
    $telefone,
    $email
);

$stmt->execute();

$stmt->close();
$conn->close();

header("Location: index.php");
exit;