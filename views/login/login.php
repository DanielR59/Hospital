<?php require_once '../../helpers/helpers.php'; ?>
<?php require_once '../db/db.php'; ?>
<?php if(isset($_SESSION['usuario']) && !empty($_SESSION['usuario'])){
    header("Location: /hospital/index.php");    
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <title>Hospital</title>
</head>
<body style="height: 100vh;">
    <div class="container d-flex justify-content-center align-items-center w-100 h-100 flex-column">
        <h1 class="mb-5">Ingresa a la APP para doctores</h1>
        <div>
            <?php if(isset($_SESSION) && !empty($_SESSION['error'])): ?>        
                <div class="alert alert-danger"><?=$_SESSION['error']?></div>                
            <?php endif;?>
        </div>
        <form method="post" action="ingresar.php">
            <div class="mb-3">
                <label for="correo" class="form-label">Correo</label>
                <input type="email" class="form-control" id="correo" name="correo">
            </div>
            <div class="mb-3">
                <label for="contrasena" class="form-label">Contraseña</label>
                <input type="password" class="form-control" id="contrasena" name="contrasena">
            </div>

            <button type="submit" class="btn btn-primary w-100">Enviar</button>
        </form>
        <?php clearSession("error");?>
    </div>
</body>
</html>