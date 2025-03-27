<?php
require_once '../database/conect.php';
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['id']) && isset($_POST['status'])) {
    $id = (int) $_POST['id'];
    $status = (int) $_POST['status'];
    $sql = "UPDATE todo SET status = ? WHERE id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ii", $status, $id);
    if ($stmt->execute()) {
        echo "Status atualizado!";
    } else {
        echo "Erro ao atualizar o status.";
    }
}
?>