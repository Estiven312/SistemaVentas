<?php
include_once("config.php");
include_once("entidades/producto.php");
$pg = "Pagina lista Producto";

$Producto = new Producto;
$aProductos = $Producto->obtenerTodos();

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
                        <th>Imagen</th>
                        <th>Nombre</th>
                        <th>Cantidad</th>
                        <th>Precio</th>

                        <th>Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($aProductos as $valor) : ?>
                        <tr>
                            <td> <img src="files/<?php echo $valor->imagen ?>" alt="" height="100" width="100px"></td>
                            <td><?php echo $valor->nombre ?></td>
                            <td><?php echo $valor->cantidad ?></td>

                            <td><?php echo $valor->precio ?></td>

                            <td><a href="producto-formulario.php?id=<?php echo $valor->idproducto;  ?>">Editar</a></td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>

            </table>

        </div>
    </div>




</div>