<?php
// Substitua com suas credenciais do banco de dados
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "echodev";

// Criar a conexão
$conn = new mysqli($servername, $username, $password, $dbname);

// Verificar a conexão
if ($conn->connect_error) {
    die("Conexão falhou: " . $conn->connect_error);
}
?>
