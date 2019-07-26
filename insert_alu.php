<?php
include('core/php_conexion.php');
$nombre = $_POST["nombre"];
$dpi = $_POST["dpi"];
$estado = $_POST["estado"];
$sexo = $_POST["sexo"];
$telefono = $_POST["telefono"];
$direccion = $_POST["direccion"];
$estado_t = $_POST["estado_t"];
$trabajo = $_POST["trabajo"];
$ocupacion = $_POST["ocupacion"];
$escolaridad = $_POST["escolaridad"];
$grado = $_POST["grado"];
$estado_i = $_POST["estado_i"];
$incapacidad = $_POST["incapacidad"];

$insertar = "INSERT INTO alumno(nombre,dpi,estado,sexo,telefono,direccion,estado_t,trabajo,ocupacion,escolaridad,grado,estado_i,incapacidad)
VALUES ($nombre,$dpi,$estado,$sexo,$telefono,$direccion,$estado_t,$trabajo,$ocupacion,$escolaridad,$grado,$estado_i,$incapacidad)";

$resultado = mysqli_query($conexion,$insertar)
	
?>