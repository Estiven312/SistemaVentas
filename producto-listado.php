<?php
include_once("config.php");
include_once("entidades/tipoproducto.php");

$tipoProducto = new TipoProducto;
$atipoProductos = $tipoProducto->obtenerTodos();

include_once("header.php");
?>

<div class="container-fluid">
    <h1 class="h3 mb-4 text-gray-800">Tipo Producto</h1>
    <div class="row">
        <div class="col-12">
            <a href="tipoproducto-formulario.php" class="btn btn-primary mr-2">Nuevo</a>
        </div>


    </div>
    <div class="row">

        <div class="col-12">
            <table class="table table-hover border ">

                <thead>
                    <tr>
                        <th>Nombre</th>
                        <th>Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($atipoProductos as $valor) : ?>
                        <tr>
                            <td><?php echo $valor->nombre ?></td>
                            <td><a href="tipoproducto-formulario.php?id=<?php echo $valor->idtipoproducto;  ?>">Editar</a></td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>

            </table>

        </div>
    </div>




</div>