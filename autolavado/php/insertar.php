<?php

include "conexion.php";

function dateNormalTiempo($date2){
        $ndate2 = date('d/m/Y',strtotime($date2));
        return $ndate2;
                }

$ruta="../imagenes";
$archivo=$_FILES['imagen']['tmp_name'];
$nombreArchivo=$_FILES['imagen']['name'];
move_uploaded_file($archivo,$ruta."/".$nombreArchivo);
$ruta=$ruta."/".$nombreArchivo;
$texto=$_POST['texto'];
//$id=rand(1,200);
$idd=$_POST['condidd'];
$placa = $_POST['plaquita'];
$date2 = date('Y-m-d H:i:s');



//duplicado

/*$ruta2="../imagenes";
$archivo2=$_FILES['imagen2']['tmp_name'];
$nombreArchivo2=$_FILES['imagen2']['name'];
move_uploaded_file($archivo2,$ruta2."/".$nombreArchivo2);
$ruta2=$ruta2."/".$nombreArchivo2;
$texto2=$_POST['texto2'];
$id2=rand(1,200);
$placa = $_POST['plaquita'];*/

//mysql_query(" INSERT INTO vehiculo (placa, nombre_vehiculo, ano, color) VALUES ('$placa','$vehiculo','$ano','$color') ");


$insertar=mysql_query("INSERT INTO imagenes (id, texto, imagen ,placa, revisiones_conductor_vehiculo_vehiculo_id_vehiculo,hora_imagen) VALUES ('".$idd."','".$texto."','".$ruta."','".$placa."','".$placa."','".$date2."')");

//$insertar2=mysql_query("INSERT INTO imagenes (id, texto, imagen , revisiones_conductor_vehiculo_vehiculo_placa) VALUES ('".$id2."','".$texto2."','".$ruta2."','".$placa."')");


if($insertar) //&& $insertar2
{
    echo "<html>
		<head>
		
		</head>
		<body>
			<meta http-equiv='REFRESH' content='0 ; url=http://localhost/autolavado/vistas/'>
			<script>
			
				alert('Imagen insertada con exito');
			
			</script>
		</body>
    
    
    
    </html>";

}
else
{
	
	echo "<html>
		<head>
		
		
		</head>
		<body>
			<meta http-equiv='REFRESH' content='0 ; url=http://localhost/autolavado/vistas/'>
			<script>
			
				alert('La insercion Fallo');
			
			</script>
		</body>
    
    
    
    </html>";
}


?>
