<?php
include_once("config.php");
include_once("entidades/usuario.php");
$pg = "Pagina lista usuarios";

$usuario = new Usuario();
$aUsuarios = $usuario->obtenerTodos();

include_once("header.php");
?>

<div class="container-fluid">
    <h1 class="h3 mb-4 text-gray-800">Listado de Productos</h1>
    <div class="row">
        <div class="col-12 p-5">
            <a href="producto-formulario.php" class="btn btn-primary mr-2">Nuevo</a>
        </div>


    </div>
    <div class="row">

        <div class="col-12">
            <table class="table table-hover border ">

                <thead>
                    <tr>
                        <th>Usuario</th>
                        <th>Nombre</th>
                        <th>Apellido </th>
                        <th>Correo</th>
                        <th>Acciones</th>


                        <th></th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($aUsuarios as $usu) : ?>
                        <tr>

                            <td><?php echo $usu->usuario ?></td>
                            <td><?php echo $usu->nombre ?></td>

                            <td><?php echo $usu->apellido ?></td>
                            <td><?php echo $usu->correo ?></td>


                            <td><a href="usuario-formulario.php?id=<?php echo $usu->idusuario;  ?>">Editar</a></td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>

            </table>

        </div>
    </div>




</div>