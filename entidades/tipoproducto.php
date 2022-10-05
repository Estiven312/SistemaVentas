<?php 
class TipoProducto
{
private $idtipoproducto;
private $nombre;



public function __construct()
{

}

public function __get($atributo)
{
return $this->$atributo;
}

public function __set($atributo, $valor)
{
$this->$atributo = $valor;
return $this;
}

public function cargarFormulario($request)
{
$this->idtipoproducto= isset($request["id"]) ? $request["id"] : "";
$this->nombre = isset($request["txtNombre"]) ? $request["txtNombre"] : "";
$this->cuit = isset($request["txtCuit"]) ? $request["txtCuit"] : "";
$this->telefono = isset($request["txtTelefono"]) ? $request["txtTelefono"] : "";
$this->correo = isset($request["txtCorreo"]) ? $request["txtCorreo"] : "";
$this->fk_idprovincia = isset($request["lstProvincia"]) ? $request["lstProvincia"] : "";
$this->fk_idlocalidad = isset($request["lstLocalidad"]) ? $request["lstLocalidad"] : "";
$this->domicilio = isset($request["txtDomicilio"]) ? $request["txtDomicilio"] : "";
if (isset($request["txtAnioNac"]) && isset($request["txtMesNac"]) && isset($request["txtDiaNac"])) {
$this->fecha_nac = $request["txtAnioNac"] . "-" . $request["txtMesNac"] . "-" . $request["txtDiaNac"];
}
}

public function insertar()
{
//Instancia la clase mysqli con el constructor parametrizado
$mysqli = new mysqli(Config::BBDD_HOST, Config::BBDD_USUARIO, Config::BBDD_CLAVE, Config::BBDD_NOMBRE, Config::BBDD_PORT);
//Arma la query
$sql = "INSERT INTO tipo_productos (
nombre
) VALUES (

'$this->nombre' );";
// print_r($sql);exit;
//Ejecuta la query
if (!$mysqli->query($sql)) {
printf("Error en query: %s\n", $mysqli->error . " " . $sql);
}
//Obtiene el id generado por la inserción
$this->idtipoproducto = $mysqli->insert_id;
//Cierra la conexión
$mysqli->close();
}

public function actualizar()
{

$mysqli = new mysqli(Config::BBDD_HOST, Config::BBDD_USUARIO, Config::BBDD_CLAVE, Config::BBDD_NOMBRE, Config::BBDD_PORT);
$sql = "UPDATE tipo_productos SET
nombre = '$this->nombre'

WHERE idtipoporducto = $this->idtipoproducto";

if (!$mysqli->query($sql)) {
printf("Error en query: %s\n", $mysqli->error . " " . $sql);
}
$mysqli->close();
}
    public function eliminar()
    {
        $mysqli = new mysqli(Config::BBDD_HOST, Config::BBDD_USUARIO, Config::BBDD_CLAVE, Config::BBDD_NOMBRE, Config::BBDD_PORT);
        $sql = "DELETE FROM tipo_productos WHERE idtipoporducto = " . $this->idtipoproducto;
        //Ejecuta la query
        if (!$mysqli->query($sql)) {
            printf("Error en query: %s\n", $mysqli->error . " " . $sql);
        }
        $mysqli->close();
    }

// public function eliminar()
// {
// $mysqli = new mysqli(Config::BBDD_HOST, Config::BBDD_USUARIO, Config::BBDD_CLAVE, Config::BBDD_NOMBRE, Config::BBDD_PORT);

// $sql = "DELETE FROM tipo_productos WHERE idtipoporducto =".$this->idtipoproducto;

// //Ejecuta la query
// if (!$mysqli->query($sql)) {
// printf("Error en query: %s\n", $mysqli->error . " " . $sql);
// }
// $mysqli->close();
// }

public function obtenerPorId()
{
$mysqli = new mysqli(Config::BBDD_HOST, Config::BBDD_USUARIO, Config::BBDD_CLAVE, Config::BBDD_NOMBRE, Config::BBDD_PORT);
$sql = "SELECT idtipoporducto, nombre FROM tipo_productos 
WHERE idtipoporducto = $this->idtipoproducto";
        print_r($sql);
if (!$resultado = $mysqli->query($sql)) {
  
printf("Error en query: %s\n", $mysqli->error . " " . $sql);
}

//Convierte el resultado en un array asociativo
if ($fila = $resultado->fetch_assoc()) {
$this->idcliente = $fila["idtipoporducto"];
$this->nombre = $fila["nombre"];

}
$mysqli->close();

}

public function obtenerTodos(){
$mysqli = new mysqli(Config::BBDD_HOST, Config::BBDD_USUARIO, Config::BBDD_CLAVE, Config::BBDD_NOMBRE, Config::BBDD_PORT);
$sql = "SELECT
idtipoporducto,
nombre
FROM tipo_productos";
if (!$resultado = $mysqli->query($sql)) {
printf("Error en query: %s\n", $mysqli->error . " " . $sql);
}

$aResultado = array();

if($resultado){
//Convierte el resultado en un array asociativo

while($fila = $resultado->fetch_assoc()){
$entidadAux = new TipoProducto();
$entidadAux->idtipoproducto= $fila["idtipoporducto"];
$entidadAux->nombre=$fila["nombre"];
$aResultado[]=$entidadAux;


}
}

return $aResultado;
}

}
