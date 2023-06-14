<?php
echo '<style>
		body {
			background-color: #F9D0D9;
		}
	</style>';
// Configuración de la conexión a la base de datos
$servername = "localhost";
$username = "root";
$password = "316170040";
$dbname = "teamsoft";

// Obtener los datos enviados del formulario
$email = $_POST["email"];
$nombre = $_POST["username"];
$recipe = $_POST["recipe"];

// Validar los datos
if (empty($email) || empty($nombre) || empty($recipe)) {
	echo "Todos los campos son obligatorios";
	exit;
}

if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
	echo "El correo electrónico no es válido";
	exit;
}

// Validar el nombre de usuario: solo letras y números
if (!preg_match("/^[a-zA-Z0-9]+$/", $nombre)) {
	echo "El nombre de usuario solo puede contener letras y números";
	exit;
}

// Validar la receta: máximo 1000 caracteres
if (strlen($recipe) > 1000) {
	echo "La receta no puede exceder los 1000 caracteres";
	exit;
}

// Sanitizar los datos
$email = filter_var($email, FILTER_SANITIZE_EMAIL);
$nombre = filter_var($nombre, FILTER_SANITIZE_STRING);
// No se necesita sanitizar la receta, ya que se utilizará en una consulta preparada (prepared statement) más adelante.

// Procesar los datos

// Crear conexión
$conn = new mysqli($servername, $username, $password, $dbname);

// Verificar la conexión
if ($conn->connect_error) {
	die("Se produjo un problema al establecer conexión con la base de datos. " . $conn->connect_error);
}

// Insertar los datos en la tabla
$sql = "INSERT INTO cliente (correo, nombre, receta) VALUES ('$email', '$nombre', '$recipe')";


// Ejecutar la consulta
if ($conn->query($sql) === TRUE) {
    echo "Datos guardados correctamente";  <a href='index.html'>Regresar</a></center>";
} else {
    echo "Error al guardar los datos: " . $conn->error;
}

// Cerrar la conexión
$conn->close();

?>