<?php
require_once('database/conect.php');  // Certifique-se de que o caminho está correto
$where = '';
if (isset($_GET['situation']) && $_GET['situation'] !== '') {
    $situation = $_GET['situation'];
    if ($situation === 'concluida') {
        $where = "WHERE status = 1";
    } elseif ($situation === 'pendente') {
        $where = "WHERE status = 0";
    }
}
$sql = "SELECT * FROM todo $where ORDER BY id ASC";
$result = $conn->query($sql);
$tasks = [];
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $tasks[] = $row;
    }
}
?><!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>To Do List</title>
    <link rel="stylesheet" href="src/styles/index.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css">
</head>
<body>
    <div class="todo">
        <h1>To-Do List</h1>
        <form action="actions/create.php" method="POST" class="todoform">
            <input type="text" id="taskname" class=taskname name="taskname" placeholder="Escreva sua tarefa" class="todoinput" required>
            <input type="text" id="taskdesc" class="taskdesc" name="taskdesc" placeholder="Escreva a descrição" class="todoinput" required>
            <button type="submit" class="todobutton" id="todobutton"><i class="fa-solid fa-plus"></i></button>
        </form>
        <form action="actions/update.php" method="POST" class="todoform1">
            <input type="hidden" id="taskid" name="taskid" readonly>
            <input type="text" id="taskname1" class="taskname1" name="taskname1" placeholder="Atualize a tarefa" class="todoinput" required>
            <input type="text" id="taskdesc1" class="taskdesc1" name="taskdesc1" placeholder="Atualize a descrição" class="todoinput" required>
            <button type="submit" class="todobutton1" id="todobutton1"><i class="fa-solid fa-plus"></i></button>
        </form>
        <form method="get" action="index.php" class="filtr">
        <label for="filter">Filtrar tarefas: </label>
        <select name="situation" id="filter" >
            <option value="" >Todas</option>
            <option value="concluida" <?= isset($_GET['situation']) && $_GET['situation'] == 'concluida' ? 'selected' : '' ?>>Concluídas</option>
            <option value="pendente"  <?= isset($_GET['situation']) && $_GET['situation'] == 'pendente' ? 'selected' : '' ?>>Pendente</option>
        </select>
        <button type="submit" >Filtrar</button>
        </form>
        <div id="tasks">
        <?php foreach ($tasks as $task): ?>
            <div class="task">
                <div class="content"> 
                <input type="checkbox" class="check" data-id="<?php echo $task['id']; ?>" 
                <?php if ($task['status'] == 1) echo 'checked'; ?> >
                 <p class="tasktit"><?php echo htmlspecialchars($task['title']); ?></p>
                    <p class="taskdes"><?php echo htmlspecialchars($task['description']); ?></p>
                </div>
                <div class="action">
                    <button class="edit" data-id="<?php echo $task['id']; ?>">
                        <i class="fa-solid fa-edit"></i>
                    </button>
                    <button class="delete" data-id="<?php echo $task['id']; ?>">
                    <i class="fa-solid fa-trash"></i>
                    </button>
                </div>
            </div>
        <?php endforeach; ?>
        </div>
    </div>
    <footer>
    <div class="footer-content">
      <p>Telefone: <a href="tel:+5547999769979">47 99976-9979</a></p>
      <p>Email: <a href="mailto:yudihonda4661@gmail.com">yudihonda4661@gmail.com</a></p>
      <p>LinkedIn: <a href="https://www.linkedin.com/in/yudi-honda-22716725a/" target="_blank">Yudi Honda</a></p>
      <p>GitHub: <a href="https://github.com/yudihonda" target="_blank">yudihonda</a></p>
    </div>
  </footer>
    <script src="src/javascript/script.js"></script>
</body>
</html>
