function mostrarCarrusel() {
  document.getElementById('recetas').style.display = 'none';
  document.getElementById('Descripcion').style.display = 'block';
  document.getElementById('contacto').style.display = 'none';
  document.getElementById('carrusel').style.display = 'block';
}
function mostrarRecetas() {
  document.getElementById('carrusel').style.display = 'none';
  document.getElementById('Descripcion').style.display = 'none';
  document.getElementById('contacto').style.display = 'none';
  document.getElementById('recetas').style.display = 'block';
}
function mostrarContacto() {
  document.getElementById('carrusel').style.display = 'none';
  document.getElementById('Descripcion').style.display = 'none';
  document.getElementById('recetas').style.display = 'none';
  document.getElementById('contacto').style.display = 'block';
}
function mostrarRegistro() {
  $('#registroModal').modal('show');
}
function mostrarReceta(imagen, texto) {
  document.getElementById('ventanaRecetasImagen').src = imagen;
  document.getElementById('ventanaRecetasTexto').textContent = texto;
  $('#ventanaRecetas').modal('show');
}

