<?php
require_once '../database/conect.php';
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['id'])) {
    $id = intval($_POST['id']);
    $sql = "DELETE FROM todo WHERE id = ?";
    $stmt = $conn->prepare($sql);
    if ($stmt === false) {
        echo "Erro na preparação da query: {$conn->error}";
        exit;
    }
    $stmt->bind_param("i", $id);
    if ($stmt->execute()) {
        echo "success";
    } else {
        echo "Erro: {$stmt->error}";
    }
}
?>