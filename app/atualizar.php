<?php

require_once "conexao.php";

$id = filter_input(INPUT_POST, "id", FILTER_VALIDATE_INT);

$nome = trim($_POST["nome"] ?? "");
$telefone = trim($_POST["telefone"] ?? "");
$email = trim($_POST["email"] ?? "");

if (!$id || empty($nome)) {
    header("Location: index.php?sucesso=editado");
    exit;
}

$stmt = $conn->prepare("
UPDATE contatos
SET
nome=?,
telefone=?,
email=?
WHERE id=?
");

$stmt->bind_param(
"sssi",
$nome,
$telefone,
$email,
$id
);

$stmt->execute();

$stmt->close();

$conn->close();

header("Location: index.php");

exit;
