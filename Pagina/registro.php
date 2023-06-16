<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Obtener los valores enviados desde el formulario
    $email = $_POST['email'];
    $name = $_POST['username'];
    $recipe = $_POST['recipe'];

    //Valores para la conexión con la base de datos
    $host = 'localhost';
    $database = 'teamsoft';
    $username = 'root';
    $password = '316170040';

    try {
        $conn = new PDO("mysql:host=$host;dbname=$database", $username, $password);
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
	//Envía los datos recibidos a la base de datos
        $stmt = $conn->prepare("INSERT INTO recetas (email, username, recipe) VALUES (:email, :username, :recipe)");
        $stmt->bindParam(':email', $email);
        $stmt->bindParam(':username', $name);
        $stmt->bindParam(':recipe', $recipe);
        $stmt->execute();
	//Retorna a la pantalla de inicio
	header("Location: index.html");
	exit;
    } catch(PDOException $e) {
        echo "Error al registrar la receta: " . $e->getMessage();
    }
} else {
    echo "Acceso denegado";
}
?>

