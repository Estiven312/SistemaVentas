<?php

include_once "config.php";
include_once "entidades/venta.php";
include_once "entidades/producto.php";
include_once "entidades/cliente.php";
$pg = "Pagina Lista Venta";



$venta = new Venta();
$aVentas = $venta->cargarGrilla();

include_once("header.php");
?>

<!-- Begin Page Content -->
<div class="container-fluid">
    <!-- Page Heading -->
    <h1 class="h3 mb-4 text-gray-800">Listado ventas</h1>
    <div class="row">
        <div class="col-12 mb-3">
            <a href="venta-formulario.php" class="btn btn-primary mr-2">Nuevo</a>
        </div>
    </div>
    <table class="table table-hover border">
        <tr>
            <th>Fecha</th>
            <th>Cliente</th>
            <th>Producto</th>
            <th>Cantidad</th>

            <th>PrecioUnitario</th>
            <th>Total</th>
            <th>Acciones</th>
        </tr>
        <?php foreach ($aVentas as $venta1) : ?>
            <tr>
                <td><?php echo $venta1->fecha ?></td>
                <td><?php echo $venta1->nombre_cliente; ?></td>
                <td><?php echo $venta1->nombre_producto; ?></td>

                <td><?php echo $venta1->cantidad; ?></td>
                <td><?php echo $venta1->preciounitario; ?></td>
                <td><?php echo $venta1->total; ?></td>

                <td style="width: 110px;">
                    <a href="venta-formulario.php?id=<?php echo $venta1->idventa; ?>"><i class="fas fa-search"></i></a>
                </td>
            </tr>
        <?php endforeach; ?>
    </table>
</div>
<!-- /.container-fluid -->

</div>
<!-- End of Main Content -->
<?php include_once("footer.php"); ?>