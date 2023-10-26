<div style=" background-image: url('fondo.jpeg');
        background-size: cover;
        background-repeat: no-repeat;">
<?php include 'template/header.php' ?>

<?php
    include_once "model/conexion.php";
    $sentencia = $bd -> query("select * from persona");
    $persona = $sentencia->fetchAll(PDO::FETCH_OBJ);
    //print_r($persona);
?>

<div class="container mt-5"  >
    <div class="row justify-content-center  "
    >
        <div class="col-md-9">
            <!-- inicio alerta -->
            <?php 
                if(isset($_GET['mensaje']) and $_GET['mensaje'] == 'falta'){
            ?>
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
            <strong>Error!</strong> Rellena todos los campos.
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
            <?php 
                }
            ?>


            <?php 
                if(isset($_GET['mensaje']) and $_GET['mensaje'] == 'registrado'){
            ?>
            <div class="alert alert-success alert-dismissible fade show" role="alert">
            <strong>Registrado!</strong> Se agregaron los datos.
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
            <?php 
                }
            ?>   
            
            

            <?php 
                if(isset($_GET['mensaje']) and $_GET['mensaje'] == 'error'){
            ?>
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
            <strong>Error!</strong> Vuelve a intentar.
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
            <?php 
                }
            ?>   



            <?php 
                if(isset($_GET['mensaje']) and $_GET['mensaje'] == 'editado'){
            ?>
            <div class="alert alert-success alert-dismissible fade show" role="alert">
            <strong>Cambiado!</strong> Los datos fueron actualizados.
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
            <?php 
                }
            ?> 


            <?php 
                if(isset($_GET['mensaje']) and $_GET['mensaje'] == 'eliminado'){
            ?>
            <div class="alert alert-warning alert-dismissible fade show" role="alert">
            <strong>Eliminado!</strong> Los datos fueron borrados.
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
            <?php 
                }
            ?> 

            <!-- fin alerta -->
            <div class="card">
                <div class="card-header">
                    Lista de personas
                </div>
                <div class="p-8">
                    <table class="table align-middle">
                        <thead>
                            <tr>
                                <th scope="col">#</th>
                                <th scope="col">Nombres</th>
                                <th scope="col">Apellido Paterno</th>
                                <th scope="col">Apellido Materno</th>
                                <th scope="col">Direccion</th>
                                <th scope="col" colspan="2" >Celular</th>
                                <th scope="col" >Estado</th>
                            </tr>
                        </thead>
                        <tbody>
                            
                            <?php 
                                foreach($persona as $dato){ 
                            ?>

                            <tr>
                                <td scope="row"><?php echo $dato->id; ?></td>
                                <td><?php echo $dato->nombres; ?></td>
                                <td><?php echo $dato->apellido_paterno; ?></td>
                                <td><?php echo $dato->apellido_materno; ?></td>
                                <td><?php echo $dato->Direccion; ?></td>
                                <td><?php echo $dato->celular; ?></td>
                                <td><a class="text-primary" href="agregarPromocion.php?codigo=<?php echo $dato->id; ?>"><i class="bi bi-cursor"></i></a></td>
                                <td>
                                <select id="estado_<?php echo $dato->id; ?>" name="estado" onchange="guardarEstado(<?php echo $dato->id; ?>)">
                                    <option value="Entregado" <?php echo $dato->estado == 'Entregado' ? 'selected' : ''; ?>>Entregado</option>
                                    <option value="No entregado" <?php echo $dato->estado == 'No entregado' ? 'selected' : ''; ?>>No entregado</option>
                                    <option value="Rechazado" <?php echo $dato->estado == 'Rechazado' ? 'selected' : ''; ?>>Rechazado</option>
                                </select>
                                <script>
                                    function guardarEstado(id) {
                                            var selectElement = document.getElementById("estado_" + id);
                                            var nuevoEstado = selectElement.value;
                                            var xhr = new XMLHttpRequest();
                                            xhr.open("POST", "guardar_estado.php", true);
                                            xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
                                            xhr.onreadystatechange = function () {
                                                if (xhr.readyState === 4 && xhr.status === 200) {
                                                    var respuesta = JSON.parse(xhr.responseText);
                                                    if (respuesta.success) {
                                                        alert("Estado actualizado con éxito");
                                                    } else {
                                                        alert("Error al actualizar el estado");
                                                    }
                                                }
                                            };

                                            var datos = "id=" + id + "&estado=" + nuevoEstado;
                                            xhr.send(datos);
    }
                                </script>
                                
                                 </td>
                                
                            
                            </tr>

                            <?php 
                                }
                            ?>

                        </tbody>
                    </table>
                    
                </div>
            </div>
        </div>
        <div class="col-md-4"  style="padding-top: 220px;  padding-bottom: 11.5%">
            <div class="card">

            <a href="iniciarsesion.php" class="btn btn-primary">Ingresar como administrador</a>
            </div>
        </div>
    
     
    
    </div>
</div>
</div>
<?php include 'template/footer.php' ?>