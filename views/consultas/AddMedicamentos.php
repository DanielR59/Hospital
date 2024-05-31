<?php
// Incluimos los archivos necesarios
require_once "../db/db.php";
require_once "../../helpers/helpers.php";

// Verificamos si el usuario está logueado y es administrador
if (!isLogin()) {
    header("Location: /hospital/views/login/login.php");
    exit(); // Detenemos la ejecución del script
}

// Verificamos si se ha enviado el formulario
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    // Recibimos los datos del formulario
    $nombre = $_POST["nombre"];
    $fechaCaducidad = $_POST["fecha_caducidad"];
    $precio = $_POST["precio"];
    $ingredientes = $_POST["ingredientes"];
    $descripcion = $_POST["descripcion"];

    // Creamos la consulta SQL para insertar un nuevo medicamento
    $sql = "INSERT INTO medicamento (nombre, fechaCaducidad, precio, ingredientes, descripcion) 
            VALUES ('$nombre', '$fechaCaducidad', $precio, '$ingredientes', '$descripcion')";

    // Ejecutamos la consulta
    if (mysqli_query($mysqli, $sql)) {
        // Si la inserción fue exitosa, redirigimos con un mensaje de éxito
        $_SESSION['message_type'] = "success";
        $_SESSION['message'] = "Medicamento agregado correctamente.";
        header("Location: /hospital/views/consultas/medicamento.php");
        exit(); // Detenemos la ejecución del script
    } else {
        // Si hubo un error en la inserción, redirigimos con un mensaje de error
        $_SESSION['message_type'] = "error";
        $_SESSION['message'] = "Error al agregar el medicamento: " . mysqli_error($mysqli);
        header("Location: /hospital/views/consultas/medicamento.php");
        exit(); // Detenemos la ejecución del script
    }
}
?>

<?php require_once "../layout/header.php"; ?>

<?php if (isset($_SESSION['message_type'])) {
  if ($_SESSION['message_type'] == "success") { ?>
 <div class="alert alert-success alert-dismissible fade show snackbar-dao" role="alert">
    <?= $_SESSION['message'] ?>
    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
 </div>
<?php clearSession('message_type');
  } elseif ($_SESSION['message_type'] == "error") { ?>
<div class="alert alert-danger alert-dismissible fade show snackbar-dao" role="alert">
    <?= $_SESSION['message'] ?>
    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
</div>

<?php clearSession('message_type');
  }
}  ?>

<div class="container mt-5">
    <h1 class="text-center">Agregar Nuevo Medicamento</h1>
    <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="POST">
        <div class="row">
            <div class="col-md-6">
                <div class="form-group">
                    <label for="nombre">Nombre:</label>
                    <input type="text" class="form-control" id="nombre" name="nombre" required>
                </div>
                <div class="form-group">
                    <label for="fecha_caducidad">Fecha de Caducidad:</label>
                    <input type="date" class="form-control" id="fecha_caducidad" name="fecha_caducidad" required>
                </div>
                <div class="form-group">
                    <label for="precio">Precio:</label>
                    <input type="number" step="0.01" class="form-control" id="precio" name="precio" required>
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group">
                    <label for="ingredientes">Ingredientes:</label>
                    <textarea class="form-control" id="ingredientes" name="ingredientes" rows="5" required></textarea>
                </div>
                <div class="form-group">
                    <label for="descripcion">Descripción:</label>
                    <textarea class="form-control" id="descripcion" name="descripcion" rows="5" required></textarea>
                </div>
            </div>
        </div>
        <button type="submit" class="btn btn-primary">Agregar Medicamento</button>
    </form>
</div>

<?php require_once "../layout/footer.php"; ?>
