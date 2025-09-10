function configurarModal(botonAbrirId, modalId) {
  const boton = document.getElementById(botonAbrirId);
  const modal = document.getElementById(modalId);
  const cerrar = modal.querySelector(".cerrar");
  const cancelar = modal.querySelector(".cancelar");

  boton.onclick = () => (modal.style.display = "flex");

  cerrar.onclick = () => (modal.style.display = "none");

  if (cancelar) {
    cancelar.onclick = () => (modal.style.display = "none");
  }

  window.addEventListener("click", (event) => {
    if (event.target === modal) {
      modal.style.display = "none";
    }
  });
}

configurarModal("abrirModalBuscar", "modalBuscar");
configurarModal("abrirModalReservas", "modalReservas");
configurarModal("abrirModalPrestamos", "modalPrestamos");
configurarModal("abrirModalCerrar", "modalCerrar");

document.getElementById("confirmarCerrar").onclick = function () {
 window.location.href = "../../Controller/usuarios/cerrar_sesion.php";
};
