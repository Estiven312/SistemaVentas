<?php
include_once("config.php");
include_once("entidades/producto.php");
include_once("entidades/cliente.php");
$pg="Pagina Formulario Venta";







include_once("entidades/venta.php");
date_default_timezone_set('America/Bogota');
print_r(date("H:i:s"));

$venta =  new Venta();

if ($_POST) {
    if (isset($_POST["btnGuardar"])) {
        $venta->cargarFormulario($_REQUEST);

        if (isset($_GET["id"]) && $_GET["id"] > 0) {
            $venta->actualizar();
            $msg["texto"] = "Actualizado correctamente";
            $msg["codigo"] = "alert-success";
        } else {
            $venta->insertar();
            $msg["texto"] = "Insertado correctamente";
            $msg["codigo"] = "alert-success";
        }
    } else if (isset($_POST["btnBorrar"])) {
        $venta->cargarFormulario($_REQUEST);
        $venta->eliminar();
        header("Location: venta-listado.php");
    }
}

if (isset($_GET["id"]) && $_GET["id"] > 0) {
    $venta->cargarFormulario($_REQUEST);
    $venta->obtenerPorId();
}

$clientes = new Cliente();
$producto = new Producto();
$aClientes = $clientes->obtenerTodos();
$aProducto = $producto->obtenerTodos();

include_once("header.php")


?>

<div class="container-fluid">
    <h1 class="h3 mb-4 text-gray-800">Venta</h1>
    <div class="row">
        <div class="col-12 mb-3">
            <a href="venta_listado.php" class="btn btn-primary mr-2">Listado</a>
            <a href="usuario-formulario.php" class="btn btn-primary mr-2">Nuevo</a>
            <button type="submit" class="btn btn-success mr-2" id="btnGuardar" name="btnGuardar">Guardar</button>
            <button type="submit" class="btn btn-danger" id="btnBorrar" name="btnBorrar">Borrar</button>
        </div>
    </div>
    <div class="row">
        <form action="" method="POST">
            <div class="col-12">
                <?php
                if (isset($msg) && $msg != "") : ?>
                    <div class="alert alert-danger" role="alert">
                        <?php echo $msg ?>
                    </div>
                <?php endif; ?>

                <label for="">Fecha y hora </label>
            </div>
            <div class="  col-6 ">



                <div class="d-inline">
                    <select class=" form-control d-inline" name="txtDia" id="txtDia" style="width:80px;">

                        <option value="" selected="" disabled>DD</option>
                        <?php for ($i = 0; $i <= 31; $i++) : ?>
                            <?php if (date("d") == $i) : ?>
                                <option selected value="<?php echo$i ?>"> <?php echo $i;?> </option>
                            <?php else : ?>
                                <option value="<?php echo$i?>"> <?php echo $i; ?> </option>
                        <?php endif ?>
                    <?php endfor;

                    ?>
                </select>

                </div>

                <div class=" d-inline">
                                    <select class=" form-control d-inline " name=" txtMes" id="txtMes" style=" width:80px">
                                        <option value="" selected="" selected>MM</option>
                                        <?php for ($i = 1; $i <= 12; $i++) : ?>
                                            <?php if (date("m") == $i) : ?>
                                                <option selected value="<?php echo$i?>"> <?php echo $i; ?> </option>
                                            <?php else : ?>
                                                <option value="<?php echo$i?>"> <?php echo $i; ?> </option>
                        <?php endif ?>

                    <?php endfor;

                    ?>

                </select>

                </div>
                <div class=" d-inline">
                                 <select class=" form-control d-inline " name=" txtAnio" id="txtAnio" style=" width:100px">
                                                        <option value="" selected>YY</option>
                                 <?php for ($i = 2020; $i<=date("Y"); $i++) : ?>
                                  <?php if (date("Y") == $i) : ?>
                                <option selected value="<?php echo$i?>"> <?php echo $i; ?> </option>
                                 <?php else : ?>
                              <option value="<?php echo$i?>"> <?php echo $i; ?> </option>
                        <?php endif ?>

                                            <?php endfor;

                                            ?>
                </select>
                  

                </div>
            </div>
            <div class=" col-6 form-group">


                   <input type="time" required="" class="form-control " style="width: 150px" name="txtHora" id="txtHora" value="<?php date("H:i:s")?>">




                </div>




                <div class=" col-6 form-group">
                    <label for="txtCuit">Cliente:</label>
                    <select class="form-control selectpicker" name="cliente" id="cliente">
                        <?php foreach ($aClientes as $cli) : ?>
                            <option value="<?php echo $cli->idcliente ?>"><?php echo $cli->nombre . $cli->idcliente ?></option>
                        <?php endforeach; ?>
                    </select>
                </div>
                <div class="col-6 form-group">
                    <label for="txtCuit" class=""> Producto:</label>
                    <select class="form-control selectpicker" name="producto" id="producto">
                        <?php foreach ($aProducto as $pro) : ?>
                            <option value="<?php echo $pro->idproducto ?>"><?php echo $pro->nombre . $pro->idproducto ?></option>

                        <?php endforeach; ?>
                        <option value=""></option>
                    </select>
                </div>
                <div class="col-6 form-group">
                    <label for="txtCuit">Cantidad:</label>
                    <input type="number" required class="form-control" name="numCantidad" id="numCantidad" value="">
                </div>
                <div class="col-6 form-group">
                    <label for="txtCuit">PrecioUnitario:</label>
                    <input type="number" required class="form-control" name="numPrecio" id="numPrecio" value="">
                </div>
                <div class="col-6 form-group">
                    <label for="txtCuit">Total:</label>
                    <input type="number" required class="form-control" name="numTotal" id="numTotal" value="">
                </div>
        </form>




    </div>



</div>
<?php
include_once("footer.php")
?>