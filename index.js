document.querySelectorAll(".remove").forEach((element) => {
  element.addEventListener("click", () => {
    fetch(`deleteTask.php?id=${element.dataset.id}`)
      .then((res) => res)
      .then((data) => {
        window.location.reload();
      });
  });
});

document.querySelectorAll(".checkCompleted").forEach((element) => {
  element.addEventListener("click", () => {
    fetch(
      `setTaskStatus.php?status=${element.dataset.completed}&id=${element.dataset.id}`
    )
      .then((res) => res)
      .then((data) => window.location.reload());
  });
});

document.querySelectorAll(".removeCategory").forEach((element) => {
  element.addEventListener("click", () => {
    fetch(`deleteCategory.php?category=${element.dataset.category}`)
      .then((res) => res)
      .then((data) => {
        window.location.reload();
      });
  });
});
