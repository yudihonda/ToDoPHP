document.addEventListener("DOMContentLoaded", () => {
  document.querySelectorAll(".delete").forEach((button) => {
    button.addEventListener("click", () => {
      const taskElement = button.closest(".task");
      const taskId = button.getAttribute("data-id");
      if (!taskId || !confirm("Deseja excluir esta tarefa?")) return;
      fetch("actions/delete.php", {
        method: "POST",
        headers: { "Content-Type": "application/x-www-form-urlencoded" },
        body: `id=${taskId}`,
      })
        .then((response) => response.text())
        .then((data) => {
          if (data.trim() === "success") {
            console.log("Tarefa excluída.");
            taskElement.remove();
          }
        })
        .catch(console.error);
    });
  });
  document.querySelectorAll(".edit").forEach((button) => {
    button.addEventListener("click", () => {
      const taskElement = button.closest(".task");
      const taskId = button.getAttribute("data-id");
      const taskTitleElement = taskElement.querySelector(".tasktit"); // Título da tarefa
      const taskDescriptionElement = taskElement.querySelector(".taskdes"); // Descrição da tarefa
      const taskTitle = taskTitleElement.textContent;
      const taskDescription = taskDescriptionElement.textContent;
      console.log(`Editing task ${taskId}: ${taskTitle} - ${taskDescription}`);
      document.getElementById("taskid").value = taskId;
      document.getElementById("taskname1").value = taskTitle;
      document.getElementById("taskdesc1").value = taskDescription;
    });
  });
});
document.querySelectorAll(".check").forEach((checkbox) => {
  checkbox.addEventListener("change", () => {
    console.log("Checkbox mudou!");
    const taskId = checkbox.getAttribute("data-id");
    const status = checkbox.checked ? 1 : 0;
    fetch("actions/progress.php", {
      method: "POST",
      headers: { "Content-Type": "application/x-www-form-urlencoded" },
      body: `id=${taskId}&status=${status}`, // Envia ID e novo status
    })
      .then((response) => response.text())
      .then((data) => {
        console.log("Status atualizado no banco:", data);
      })
      .catch((error) => {
        console.error("Erro ao atualizar o status:", error);
      });
  });
});
const form = document.querySelector(".todoform1");
const submitButton = document.querySelector("#todobutton1");

document.querySelectorAll(".edit").forEach((editButton) => {
  editButton.addEventListener("click", () => (form.style.display = "flex"));
});

submitButton.addEventListener("click", () => (form.style.display = "none"));
