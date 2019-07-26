<?php  
session_start();
include('core/php_conexion.php'); 

if($_SESSION['tipo_usu'] == 'admin' or $_SESSION['tipo_usu'] == 'normal'){

}
else{
    header('location:error.php');
}
if($_SESSION['tipo_usu'] == 'admin'){
    $titulo='Administrador';
}
else{
    $titulo='Usuario';
}
//$titulo='Centros Municipales de ';
$usuario = limpiar($_SESSION['username']);
$strQuery = "SELECT * FROM usuario WHERE usuario = '$usuario'";
        
$sqll = mysql_query($strQuery);
if($dato=mysql_fetch_array($sqll)){
    $nombre = $dato['nombre'];
    $palabra = explode(" ", $nombre);
    $nomb = $palabra[0];
}
?>


<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>Crear alumno</title>
<link href="libraries/boostrap/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">

        <!-- MetisMenu CSS -->
        <link href="libraries/boostrap/vendor/metisMenu/metisMenu.min.css" rel="stylesheet">

        <!-- Custom CSS -->
        <link href="libraries/boostrap/dist/css/sb-admin-2.css" rel="stylesheet">

        <!-- Morris Charts CSS -->
        <link href="libraries/boostrap/vendor/morrisjs/morris.css" rel="stylesheet">

        <!-- Custom Fonts -->
        <link href="libraries/boostrap/vendor/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">
        <link rel="shortcut icon" href="ico/favicon.png">

        <meta http-equiv="content-type" content="text/html; charset=iso-8859-1;" />
        <style type="text/css">
        body {
                background-color: #FFF;
                background-image: url(img/fondoP.png);
        }
        </style>
</head>

<body>

<div class="container">

<div class="center-block">
	  <img src="images/cemucaf.jpeg" alt="img" height="100" width="900" class="img-responsive"
      
</div>	

	<form action="insert_alu.php" class="form-horizontal" method="post">
    <div class="form-group">
    	<label for="sub1">DATOS PERSONALES</label>
    </div>
	   <div class="form-group">
	   	<label for="Nombre" class="control-label col-md-2">Nombre Completo</label>
		    <div class="col-md-10">
		    	<input class="form-control" id="nombre" name="nombre" type="text" placeholder="Nombre">
		    </div>
   			
	   </div>
		
		<div class="form-group">
			<label for="dpi" class="control-label col-md-2">DPI</label>
			<div class="col-md-10">
				<input class="form-control" id="dpi" name="dpi" type="" placeholder="DPI">
			</div>
		</div>
		
		<div class="form-group">
			<label for"archivo" class="control-label col-md-2">Adjuntar</label>
	         <div class="col-md-10">
	         	<input type="file" id="archivo">
	         </div>	
		</div>
		
		<div class="form-group">
			<label for="Estado" class="control-label col-md-2">Estado civil</label>
			<div class="col-md-10">
			<label class"radio-inline">
				<input type="radio" name="estado" value="">Soltero
			</label>
			<label class"radio-inline">
				<input type="radio" name="estado" value="">Casado
			</label>
			</div>
		</div>
		
		<div class="form-group">
			<label for="Sexo" class="control-label col-md-2">Sexo</label>
			<div class="col-md-10">
				<label for="radio" class"radio-inline">			
				<input type="radio" name="sexo" value="">Masculino
				</label>
			<label for="radio2" class"radio-inline">			
				<input type="radio" name="sexo" value="">Femenino
			  </label>
			</div>
			
		</div>
		
		<div class="form-group">
			<label for="Telefono" class="control-label col-md-2">Telefono</label>
			<div class="col-md-10">
			 <input class="form-control" id="telefono" type="" placeholder="Telefono">
			</div>
			
		</div>
		
		<div class="form-group">
			<label for="Direccion" class="control-label col-md-2">Direccion</label>
			<div class="col-md-10">
			<input class="form-control" id="dirección" name="direccion" type="" placeholder="Direccion">
			</div>
		</div>
		
		<br>
    <div class="form-group">
    	<label for="sub2">OCUPACION O TRABAJO</label>
    </div>
    
    <div class="form-group">
			<label for="estado_t" class="control-label col-md-2">Trabaja actualemente</label><br />
			<div class="col-md-10">
			<label for="radio" class"radio-inline">
			<input type="radio" name="estado_t" value="">Si
			  </label>
				<label for="radio" class"radio-inline">
			<input type="radio" name="estado_t" value="">No
				</label>
			</div>
	  </div>
   <div class="form-group">
			<label for="Trabajo" class="control-label col-md-2">Empleo Actual</label>
			<div class="col-md-10">
			<input class="form-control" id="trabajo" name="trabajo" type="" placeholder="Empleo Actual">
			</div>
	  </div>
   
   <div class="form-group">
			<label for="Ocupacion" class="control-label col-md-2">Otra Ocupacion</label>
			<div class="col-md-10">
			<input class="form-control" id="ocupacion" name="ocupacion" type="" placeholder="Otra Ocupacion">
			</div>
	  </div>
    <br>
     <div class="form-group">
    	<label for="sub3">ESCOLARIDAD</label>
    </div>
     <div class="form-group">
			<label for="Escolaridad" class="control-label col-md-2">Sabe leer</label>
			<div class="col-md-10">
			<label for="radio" class"radio-inline">
			<input type="radio" name="escolaridad" value="">Si
			  </label>
				<label for="radio" class"radio-inline">
			<input type="radio" name="escolaridad" value="">No
				</label>
			</div>
	  </div>
		
	<div class="form-group">
		<label for="grado" class="control-label col-md-2">Ultimo grado de Escolaridad</label>
		<div class="col-md-10">
		<select class="form-control" name="grado" id"grado">
		 <option value="">No tiene</option>
		 <option value="">Primaria</option>
		 <option value="">Basico</option>
		 <option value="">Diversificado</option>
		 <option value="">Universidad</option>
		</select>
		</div>
	</div>
	<br>
     <div class="form-group">
    	<label for="sub4">IMPEDIMENTO FISICO</label>
    </div>
    
    <div class="form-group">
			<label for="Impedimento" class="control-label col-md-2">Tiene algun impedimento fisico</label><br />
			<div class="col-md-10">
			<label for="radio" class"radio-inline">
			<input type="radio" name="estado_i" value="">Si
			  </label>
				<label for="radio" class"radio-inline">
			<input type="radio" name="estado_i" value="">No
				</label>
			</div>
	  </div>
		
		<div class="form-group">
			<label for="Impedimento" class="control-label col-md-2">Descripcion Impedimento</label>
			<div class="col-md-10">
			<input class="form-control" id="impedimento" name="impedimento" type="" placeholder="Descripcion Impedimento">
			</div>
		</div>
		
		<div class="form-group">
		   <div class="col-md-2 col-md-offset-2">
		   	<button class="btn btn-primary"	>Guardar</button>
		   </div>	
		</div>
	
  </form>
	
</div>

<script src="js/jquery.js"></script>
            <script src="js/bootstrap-transition.js"></script>
            <script src="js/bootstrap-alert.js"></script>
            <script src="js/bootstrap-modal.js"></script>
            <script src="js/bootstrap-dropdown.js"></script>
            <script src="js/bootstrap-scrollspy.js"></script>
            <script src="js/bootstrap-tab.js"></script>
            <script src="js/bootstrap-tooltip.js"></script>
            <script src="js/bootstrap-popover.js"></script>
            <script src="js/bootstrap-button.js"></script>
            <script src="js/bootstrap-collapse.js"></script>
            <script src="js/bootstrap-carousel.js"></script>
            <script src="js/bootstrap-typeahead.js"></script>
</body>
</html>