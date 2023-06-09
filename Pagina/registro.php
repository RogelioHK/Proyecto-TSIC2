<?php
// Verificar si se envió el formulario de registro
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Obtener los datos enviados del formulario
    $email = $_POST["email"];
    $username = $_POST["username"];
    $password = $_POST["password"];
    
    // Validar los datos
    if (empty($email) || empty($username) || empty($password)) {
        echo "Todos los campos son obligatorios";
        exit;
    }

    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        echo "El correo electrónico no es válido";
        exit;
    }

		// Validar el nombre de usuario: solo letras y números
		if (!preg_match("/^[a-zA-Z0-9]+$/", $username)) {
				echo "El nombre de usuario solo puede contener letras y números";
				exit;
		}

		// Validar la contraseña: al menos una letra y un número, longitud mínima de 8 caracteres
		if (!preg_match("/^(?=.*[a-zA-Z])(?=.*[0-9]).{8,}$/", $password)) {
				echo "La contraseña debe contener al menos una letra y un número, y tener una longitud mínima de 8 caracteres";
				exit;
		}
    // Sanitizar los datos
    $email = filter_var($email, FILTER_SANITIZE_EMAIL);
    $username = filter_var($username, FILTER_SANITIZE_STRING);
    // No se necesita sanitizar la contraseña, ya que se utilizará en una consulta preparada (prepared statement) más adelante.


    // Procesar los datos
		// Conexión a la base de datos MySQL
		$servername = "mysql-service";
		$username = "root";
		$password = "password";
		$port = 3306;
		$dbname = "clientes";

		// Crear conexión
		$conn = new mysqli($servername, $username, $password, $dbname,$port);

		// Verificar la conexión
		if ($conn->connect_error) {
				die("Se produjo un problema al establecer conexión con la base de datos. " . $conn->connect_error);
		}

		// Insertar los datos en la tabla
		$sql = "INSERT INTO cliente (correo, nombre, contraseña) VALUES ('$email', '$username', '$password')";

		if ($conn->query($sql) === TRUE) {
				echo "Datos ingresados correctamente.";
		} else {
				echo "No se pudieron ingresar los datos correctamente. Por favor, revisa los valores ingresados. " . $conn->error;
		}

		// Cerrar la conexión
		$conn->close();
}
?>
