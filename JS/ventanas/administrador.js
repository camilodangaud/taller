function configurarModal(botonAbrirId, modalId) {
  const boton = document.getElementById(botonAbrirId);
  const modal = document.getElementById(modalId);

  if (!boton || !modal) return;

  const cerrar = modal.querySelector(".cerrar");
  const cancelar = modal.querySelector(".cancelar");

  boton.onclick = () => (modal.style.display = "flex");
  if (cerrar) {
    cerrar.onclick = () => (modal.style.display = "none");
  }
  if (cancelar) {
    cancelar.onclick = () => (modal.style.display = "none");
  }
  window.addEventListener("click", (event) => {
    if (event.target === modal) {
      modal.style.display = "none";
    }
  });
}

configurarModal("abrirModalGestionarLibros", "modalGestionarLibros");
configurarModal("abrirModalUsuarios", "modalUsuarios");
configurarModal("abrirModalReservas", "modalReservas");
configurarModal("abrirModalPrestamos", "modalPrestamos");
configurarModal("abrirModalCerrar", "modalCerrar");

document.getElementById("confirmarCerrar").onclick = function () {
  window.location.href =
    "/taller_analisis/Controller/usuarios/cerrar_sesion.php";
};
