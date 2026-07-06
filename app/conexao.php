<?php

$host = "agenda-stack-db.cbaecoggxxwl.us-east-1.rds.amazonaws.com";
$db = "agenda";
$user = "admin";
$pass = "Agenda123!";

$conn = new mysqli($host, $user, $pass, $db);

if ($conn->connect_error) {
    die("Erro na conexão: " . $conn->connect_error);
}

$conn->set_charset("utf8");