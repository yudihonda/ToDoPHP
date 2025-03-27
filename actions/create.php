<?php
require_once '../database/conect.php';
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $taskname = $_POST['taskname'] ?? '';
    $taskdesc = $_POST['taskdesc'] ?? '';
    $taskid = $_POST['taskid'] ?? '';
    if (!empty($taskname) && !empty($taskdesc)) {
        $stmt = $conn->prepare("INSERT INTO todo (title, description) VALUES (?, ?)");
        $stmt->bind_param("ss", $taskname, $taskdesc);
        if ($stmt->execute()) {
            echo "Nova tarefa salva com sucesso!";
        } else {
            echo "Erro ao salvar tarefa: {$stmt->error}";
        }
        $stmt->close();
    } else {
        echo "Por favor, preencha tanto o título quanto a descrição da tarefa.";
    }
}
header('Location: ../index.php');