
<?php include 'template/header.php' ?>

<?php
    include_once "model/conexion.php";
    $sentencia = $bd -> query("select * from usuarios");
    $persona = $sentencia->fetchAll(PDO::FETCH_OBJ);
    //print_r($persona);
?>
<div class="container mt-5"  >
    <div class="row justify-content-center  ">
<div class="col-md-3">
         <?php 
                if(isset($_GET['mensaje']) and $_GET['mensaje'] == 'error'){
            echo '<script>alert("Ha ocurrido un error al iniciar sesión. Por favor, verifica tus credenciales.")</script>';
                }
            ?>

            <div class="card">
                <div class="card-header">
                    Inicio de sesion
                </div>
                <form class="p-4" method="POST" action="identificacion.php">
                    <div class="mb-3">
                        <label class="form-label">Usuario: </label>
                        <input type="text" class="form-control" name="txtusuario" autofocus required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Contraseña: </label>
                        <input type="text" class="form-control" name="txtcontrasena" autofocus required>
                    </div>
                    <div class="d-grid">
                        <input type="hidden" name="oculto" value="1">
                        <input type="submit" class="btn btn-primary" value="ingresar">
                    </div>
                </form>
            </div>
        </div>
        </div>
        </div>
<?php include 'template/footer.php' ?>
