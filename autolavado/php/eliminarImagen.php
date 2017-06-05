<script src="../js/myjava.js"></script>
<?php

$idImagen=$_POST['idImagen'];
$id_vehiculo = $_POST['id_vehiculo'];

include "conexion.php";

$eliminar=mysql_query("DELETE FROM imagenes WHERE id='".$idImagen."'");

$consultar=mysql_query("SELECT * FROM imagenes where revisiones_conductor_vehiculo_vehiculo_id_vehiculo = '$id_vehiculo'");


echo "<table border='2' width='100%'>
        <tr>
            <th style='text-align:center; width:20px;'><h4>Imagen</h4></th>
            <th style='text-align:center;'><h4>Texto</h4></th>
            <th style='text-align:center;'><h4>Tiempo</h4></th>
            <th style='text-align:center;'><h4>Eliminar</h4></th>
        </tr>
";

while($imagenes=mysql_fetch_array($consultar))
{
    $imagen=$imagenes['imagen'];
    $texto=$imagenes['texto'];
	$idImagen=$imagenes['id'];
    $tiempo = $imagenes['hora_imagen'];
	
    echo "<tr>
            
            <td style='text-align:center; width:100px;'><img onclick='javascript:this.width=450;this.height=338' ondblclick='javascript:this.width=150;this.height=100' src='$imagen' class=' img-thumbnail' width='150' height='100'></td>
            <td width='100' style='text-align:center;' ><h4>$texto</h4></td>
            <td width='100' style='text-align:center;' ><h4>$tiempo</h4></td>
            <td width='100' style='text-align:center;'><a href='javascript:preguntar($idImagen,$id_vehiculo)'><h4>Eliminar</h4></a></td>
            
        </tr>"  ;    


}




?>
