function showModal(id) {
  const modal = document.getElementById(id);
  if (modal) {
    modal.classList.remove("hidden");
  }
}

function hideModal(id) {
  const modal = document.getElementById(id);
  if (modal) {
    modal.classList.add("hidden");
  }
}

function nuevolibro() {
  document.getElementById("bookForm").reset();
  document.getElementById("id_libro").value = "";

  document.getElementById("modalTitle").textContent = "Registrar Libro";
  document.getElementById("submitBtn").textContent = "Registrar Libro";
  document.getElementById("bookForm").action =
    "../../Controller/administrador/libro_registrar.php";
  document.getElementById("disponibilidad").value = 1;

  showModal("formModal");
}

function editarLibro(data) {
  document.getElementById("id_libro").value = data.id_libro;
  document.getElementById("titulo").value = data.titulo;
  document.getElementById("autor").value = data.autor;
  document.getElementById("editorial").value = data.editorial;

  document.getElementById("modalTitle").textContent = "Editar Libro";
  document.getElementById("submitBtn").textContent = "Actualizar Libro";
  document.getElementById("bookForm").action =
    "../../Controller/administrador/libro_editar.php";

  document.getElementById("disponibilidad").value = 1;

  showModal("formModal");
}

document.addEventListener("DOMContentLoaded", () => {
  const closeBtns = document.querySelectorAll(".close");
  closeBtns.forEach((btn) => {
    btn.addEventListener("click", () => {
      hideModal("formModal");
    });
  });

  window.addEventListener("click", (event) => {
    const modal = document.getElementById("formModal");
    if (event.target === modal) {
      hideModal("formModal");
    }
  });
});
