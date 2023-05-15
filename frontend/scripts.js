// ----------------------abre el modal---------------------------
  // Obtener el modal y el enlace
  var modalcom = document.getElementById("compra-modal");
  var enlace = document.getElementById("compra-enlace");

  // Cuando se hace clic en el enlace, abrir el modal
  enlace.onclick = function() {
    modalcom.style.display = "block";
  }

  // Cuando se hace clic en el botón de cerrar, cerrar el modal
  var botonCerrar = document.getElementsByClassName("cerrarcom");
  for (var i = 0; i < botonCerrar.length; i++) {
    botonCerrar[i].onclick = function() {
      modalcom.style.display = "none";
    }
  }

  // Cuando se hace clic fuera del modal, cerrarlo
  window.onclick = function(event) {
    if (event.target == modalcom) {
      modalcom.style.display = "none";
    }
  }
// -----------------inicio modal publicar -------------------
function mostrarmodal(){
  document.getElementById("modalpublic").style.display="block";
 };
 
 function ocultarmodel(){
  document.getElementById("modalpublic").style.display="none";
 };
// -----------fin--------------------------
// ----------------formulario foto de perfil-----------------------
function cambiarfoto(){
  document.getElementById("formfoto").style.display="block";  
}
function ocultarform(){
document.getElementById("formfoto").style.display="none";
}