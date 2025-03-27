<?php
require_once '../database/conect.php';
if (!isset($conn) || !$conn) {
    die("Erro ao conectar ao banco de dados.");
}
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $taskname = $_POST['taskname1'] ?? '';
    $taskdesc = $_POST['taskdesc1'] ?? '';
    $taskid = $_POST['taskid'] ?? ''; // Verifique se o taskid foi enviado
    if (empty($taskname) || empty($taskdesc)) {
        echo "Por favor, preencha tanto o título quanto a descrição da tarefa.";
    } else {




        $stmt = $conn->prepare("UPDATE todo SET title = ?, description = ? WHERE id = ?");
        $stmt->bind_param("ssi", $taskname, $taskdesc, $taskid);
        if ($stmt->execute()) {
            echo "Nova tarefa salva com sucesso!";
        } else {
            echo "Erro ao salvar tarefa: {$stmt->error}";
        }
        $stmt->close();

    }
}
header('Location: ../index.php');
