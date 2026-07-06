<?php

require_once "conexao.php";

$id = filter_input(INPUT_GET, "id", FILTER_VALIDATE_INT);

if (!$id) {
    header("Location: index.php");
    exit;
}

$stmt = $conn->prepare("
    DELETE FROM contatos
    WHERE id = ?
");

$stmt->bind_param("i", $id);

$stmt->execute();

$stmt->close();
$conn->close();

header("Location: index.php");
exit;