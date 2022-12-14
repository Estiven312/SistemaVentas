<?php
class Venta
{
    private $idventa;
    private $fecha;

    private $preciounitario;
    private $total;
    private $fk_idcliente;
    private $fk_idproducto;
    private $nombre_cliente;
    private $nombre_producto;


    public function __construct()
    {
    }

    public function __get($atributo)
    {
        return $this->$atributo;
    }

    public function __set($atributo, $valor)
    {
      return  $this->$atributo = $valor;
     
    }

    public function cargarFormulario($request)
    
    {
        date_default_timezone_set('America/Bogota');
        $this->idventa = isset($request["id"]) ? $request["id"] : "";
        $this->cantidad = isset($request["numCantidad"]) ? $request["numCantidad"] : "";
        $this->preciounitario = isset($request["numPrecio"]) ? $request["numPrecio"] : "";
        $this->total = isset($request["numTotal"]) ? $request["numTotal"] : "";
        if (isset($request["txtDia"]) && isset($request["txtMes"]) && isset($request["txtAnio"]) && isset($request["txtHora"])) {
            $this->fecha = $request['txtAnio']."-".$request['txtMes']."-".$request['txtDia']."-".$request['txtHora'];
        }
       // .":".date("s")


        $this->fk_idcliente = isset($request["cliente"]) ? $request["cliente"] : "";
        $this->fk_idproducto = isset($request["producto"]) ? $request["producto"] : "";
    }


    public function insertar()
    {
        //Instancia la clase mysqli con el constructor parametrizado
        $mysqli = new mysqli(Config::BBDD_HOST, Config::BBDD_USUARIO, Config::BBDD_CLAVE, Config::BBDD_NOMBRE, Config::BBDD_PORT);
        //Arma la query
        $sql = "INSERT INTO ventas (
   
    fecha,
    cantidad,
    preciounitario,
    total,
    fk_idcliente,
    fk_idproducto
    ) VALUES (
    
    '$this->fecha',
    $this->cantidad,
    $this->preciounitario,
    $this->total,
    $this->fk_idcliente,
    $this->fk_idproducto

);";

         
        //Ejecuta la query
        if (!$mysqli->query($sql)) {
            printf("Error en query: %s\n", $mysqli->error . " " . $sql);
        }
        //Obtiene el id generado por la inserci??n
        $this->idventa = $mysqli->insert_id;
        //Cierra la conexi??n
        $mysqli->close();
    }

    public function actualizar()
    {

        $mysqli = new mysqli(Config::BBDD_HOST, Config::BBDD_USUARIO, Config::BBDD_CLAVE, Config::BBDD_NOMBRE, Config::BBDD_PORT);
        $sql = "UPDATE ventas SET

fecha = '$this->fecha',
cantidad = $this->cantidad,
preciounitario = $this->preciounitario,
total = $this->total,
fk_idclientes=$this->fk_idcliente;
fk_idproducto = $this->fk_idproducto

WHERE idventa = $this->idventa";


        if (!$mysqli->query($sql)) {
            printf("Error en query: %s\n", $mysqli->error . " " . $sql);
        }
        $mysqli->close();
    }

    public function eliminar()
    {
        $mysqli = new mysqli(Config::BBDD_HOST, Config::BBDD_USUARIO, Config::BBDD_CLAVE, Config::BBDD_NOMBRE, Config::BBDD_PORT);
        $sql = "DELETE FROM ventas WHERE idventa = " . $this->idventa;
        //Ejecuta la query
        if (!$mysqli->query($sql)) {
            printf("Error en query: %s\n", $mysqli->error . " " . $sql);
        }
        $mysqli->close();
    }

    public function obtenerPorId()
    {
        $mysqli = new mysqli(Config::BBDD_HOST, Config::BBDD_USUARIO, Config::BBDD_CLAVE, Config::BBDD_NOMBRE, Config::BBDD_PORT);
        $sql = "SELECT idventa,

fecha,
cantidad,
preciounitario,
total,
fk_idproducto,
fk_idcliente

FROM ventas
WHERE idventa = $this->idventa";
        if (!$resultado = $mysqli->query($sql)) {
            printf("Error en query: %s\n", $mysqli->error . " " . $sql);
        }

        //Convierte el resultado en un array asociativo
        if ($fila = $resultado->fetch_assoc()) {
            $this->idventa = $fila["idventa"];

            $this->fecha = $fila["fecha"];
            $this->cantidad = $fila["cantidad"];
            $this->preciounitario = $fila["preciounitario"];
            $this->total = $fila["total"];
            $this->fk_idcliente = $fila["fk_idproducto"];
            $this->fk_idcliente = $fila["fk_idcliente"];
        }
        $mysqli->close();
    }

    public function obtenerTodos()
    {
        $mysqli = new mysqli(Config::BBDD_HOST, Config::BBDD_USUARIO, Config::BBDD_CLAVE, Config::BBDD_NOMBRE, Config::BBDD_PORT);
        $sql = "SELECT
idventa,

fecha,
cantidad,
preciounitario,
total,
fk_idcliente,
fk_idproducto


FROM ventas";
        if (!$resultado = $mysqli->query($sql)) {
            printf("Error en query: %s\n", $mysqli->error . " " . $sql);
        }

        
        $aResultado = array();

        if ($resultado) {
            //Convierte el resultado en un array asociativo

            while ($fila = $resultado->fetch_assoc()) {

                $entidadAux = new Venta();
                $entidadAux->idventa = $fila["idventa"];
                $entidadAux->fecha=$fila["fecha"];

                // if (isset($fila["fecha"])) {
                //     $entidadAux->fecha = $fila["fecha"];
                // } else {
                //     $entidadAux->fecha = "";
                // }
                $entidadAux->cantidad = $fila["cantidad"];
                $entidadAux->preciounitario = $fila["preciounitario"];
                $entidadAux->total = $fila["total"];
                $entidadAux->fk_idcliente = $fila["fk_idcliente"];
                $entidadAux->fk_idproducto = $fila["fk_idproducto"];
                $aResultado[]=$entidadAux;
            }
        }
        
        return $aResultado;
    }

    public function obtenerVentasPorCliente($idCliente)
    {
        $mysqli = new mysqli(Config::BBDD_HOST, Config::BBDD_USUARIO, Config::BBDD_CLAVE, Config::BBDD_NOMBRE, Config::BBDD_PORT);
        $sql = "SELECT idventa,
                        fk_idcliente,
                        fk_idproducto,
                        fecha,
                        cantidad,
                        preciounitario,
                        total
                FROM ventas WHERE fk_idcliente = $idCliente";
        if (!$resultado = $mysqli->query($sql)) {
            printf("Error en query: %s\n", $mysqli->error . " " . $sql);
        }

        $aResultado = array();
        if ($resultado) {
            //Convierte el resultado en un array asociativo
            while ($fila = $resultado->fetch_assoc()) {
                $entidadAux = new Venta();
                $entidadAux->idventa = $fila["idventa"];
                $entidadAux->fk_idcliente = $fila["fk_idcliente"];
                $entidadAux->fk_idproducto = $fila["fk_idproducto"];
                $entidadAux->fecha = $fila["fecha"];
                $entidadAux->cantidad = $fila["cantidad"];
                $entidadAux->preciounitario = $fila["preciounitario"];
                $entidadAux->total = $fila["total"];
                $aResultado[] = $entidadAux;
            }
        }
        $mysqli->close();
        return $aResultado;
    }
    public function cargarGrilla()
    {
        $mysqli = new mysqli(Config::BBDD_HOST, Config::BBDD_USUARIO, Config::BBDD_CLAVE, Config::BBDD_NOMBRE, Config::BBDD_PORT);

        $sql = "SELECT 
                A.idventa,
                A.fecha,
                A.cantidad,
                A.fk_idcliente,
                B.nombre as nombre_cliente,
                A.fk_idproducto,
                A.total,
                A.preciounitario,
                C.nombre as nombre_producto
            FROM ventas A
            INNER JOIN clientes B ON A.fk_idcliente = B.idcliente
            INNER JOIN producto C ON A.fk_idproducto = C.idproducto
            ORDER BY A.fecha DESC";

        if (!$resultado = $mysqli->query($sql)) {
            printf("Error en query: %s\n", $mysqli->error . " " . $sql);
        }

        $aResultado = array();
        if ($resultado) {
            //Convierte el resultado en un array asociativo
            while ($fila = $resultado->fetch_assoc()) {
                $entidadAux = new Venta();
                $entidadAux->idventa = $fila["idventa"];
                $entidadAux->fk_idcliente = $fila["fk_idcliente"];
                $entidadAux->fk_idproducto = $fila["fk_idproducto"];
                $entidadAux->fecha = $fila["fecha"];
                $entidadAux->cantidad = $fila["cantidad"];
                $entidadAux->preciounitario = $fila["preciounitario"];
                $entidadAux->nombre_cliente = $fila["nombre_cliente"];
                $entidadAux->nombre_producto = $fila["nombre_producto"];
                $entidadAux->total = $fila["total"];
                $aResultado[] = $entidadAux;
            }
        }
        $mysqli->close();
        return $aResultado;
    }
    public function obtenerFacturacionMensual($mes)
    {
        $mysqli = new mysqli(Config::BBDD_HOST, Config::BBDD_USUARIO, Config::BBDD_CLAVE, Config::BBDD_NOMBRE, Config::BBDD_PORT);
        $sql = "SELECT SUM(total) AS total FROM ventas WHERE MONTH(fecha) = $mes";
        if (!$resultado = $mysqli->query($sql)) {
            printf("Error en query: %s\n", $mysqli->error . " " . $sql);
        }
        $fila = $resultado->fetch_assoc();
        $mysqli->close();
        return $fila["total"] != "" ? $fila["total"] : 0;
    }

    public function obtenerFacturacionAnual($anio)
    {
        $mysqli = new mysqli(Config::BBDD_HOST, Config::BBDD_USUARIO, Config::BBDD_CLAVE, Config::BBDD_NOMBRE, Config::BBDD_PORT);
        $sql = "SELECT SUM(total) AS total FROM ventas WHERE YEAR(fecha) = $anio";
        if (!$resultado = $mysqli->query($sql)) {
            printf("Error en query: %s\n", $mysqli->error . " " . $sql);
        }
        $fila = $resultado->fetch_assoc();
        $mysqli->close();
        return $fila["total"] != "" ? $fila["total"] : 0;
    }
}
