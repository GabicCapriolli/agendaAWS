<?php

include "conexao.php";

$nome=$_POST['nome'];
$telefone=$_POST['telefone'];
$email=$_POST['email'];

$sql="INSERT INTO contatos(nome,telefone,email)
VALUES('$nome','$telefone','$email')";

$conn->query($sql);

header("Location:index.php");