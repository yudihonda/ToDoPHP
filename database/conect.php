<?php
$host = "localhost";
$usuario = "root";
$senha = "";
$banco = "tododatabase";
$conn = new mysqli($host, $usuario, $senha, $banco);
if ($conn->connect_error) {
    die("Erro de conexão: " . $conn->connect_error);
}
echo "";
?>
