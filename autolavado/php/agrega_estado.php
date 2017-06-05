<?php
include('conexion.php');
//$id = $_POST['id-prod'];
//$proceso = $_POST['pro'];
//$nombre = $_POST['nombre'];
//$tipo = $_POST['tipo'];
//$precio_uni = $_POST['precio-uni'];
//$precio_dis = $_POST['precio-dis'];
//$fecha = date('Y-m-d');

function fechaNormal($fecha){
        $nfecha = date('d/m/Y',strtotime($fecha));
        return $nfecha;
                }

$id_estado = $_POST['id_estado'];      // id del conductor
$estado = $_POST['nombre_estado']; // nombre del conductor

//$idconductor_vehiculo = $_POST['id_conductor_veh']; // id de la asociativa conductor_vehiculo

//VERIFICAMOS EL PROCESO

// prueba

/*$ruta="../imagenes";
$archivo=$_FILES['imagen']['tmp_name'];
$nombreArchivo=$_FILES['imagen']['name'];
move_uploaded_file($archivo,$ruta."/".$nombreArchivo);
$ruta=$ruta."/".$nombreArchivo;
$texto=$_POST['texto'];
$idd=rand(1,200);*/

// Variables revisiones


        mysql_query(" INSERT INTO estado (id_estado, nombre_estado) VALUES ('$id_estado','$estado')");

        

       // mysql_query(" INSERT INTO revisiones (luces_delanteras, luces_traseras, antena, espejo_derecho, espejo_izquierdo, vidrios, emblema_delantero, emblema_trasero, tapones_rines, tapon_gasolina, carroceria, encendedor, espejo_retrovisor, cenicero, alfombras, forros_asientos, gato, llave_ruedas, caucho_repuesto, estuche_herramientas, triangulo_emergencia, bateria, tapa_fusilera, estado_id_estado, timestamps_id_timestamp, conductor_vehiculo_conductor_id_conductor, conductor_vehiculo_vehiculo_placa) VALUES ('$luces_delanteras','$luces_traseras','$antena','$espejo_derecho','$espejo_izquierdo','$vidrios','$emblema_delantero','$emblema_trasero','$tapones_rines','$tapon_gasolina','$carroceria','$encendedor','$espejo_retrovisor','$cenicero','$alfombras','$forros_asientos','$gato','$llave_ruedas','$caucho_repuesto','$estuche_herramientas','$triangulo','$bateria','$tapa_fusilera','NOW()','$id','$placa','$OJOFALTAESTADO')");

        //mysql_query("INSERT INTO imagenes VALUES('".$idd."','".$texto."','".$ruta."')");

		//mysql_query("INSERT INTO conductor  (id_conductor, nombre_conductor, telefono)VALUES('$id','$conductor','$telefono')");

		//mysql_query("INSERT INTO vehiculos (placa, fecha, marca, nombre, conductor_id_conductor)VALUES('$placa','$fecha','$marca','$vehiculo','$id')");



	



//ACTUALIZAMOS LOS REGISTROS Y LOS OBTENEMOS

$actualizar = mysql_query("SELECT id_estado, nombre_estado from estado");

//CREAMOS NUESTRA VISTA Y LA DEVOLVEMOS AL AJAX

echo '<table class="table table-striped table-condensed table-hover">
            <tr>
                
                <th width="150" style="font-size: 20px;">ID Estado</th>
                <th width="130" style="font-size: 20px;">Estado</th>
                <th width="50"  style="font-size: 20px;">Opciones</th>
            </tr>';
    while($actualizar2 = mysql_fetch_array($actualizar)){
      $id_estado = "'".$actualizar2['id_estado']."'";
                echo '<tr>
                        <td style="font-size: 20px;">'.$actualizar2['id_estado'].'</td>
                        <td style="font-size: 20px;">'.$actualizar2['nombre_estado'].'</td> 

                        <td>
                        <a href="javascript:eliminarEstado('.$id_estado.');" class="glyphicon glyphicon-remove-circle" style="font-size: 25px; width:32px;"></a></td>
                    </tr>';       
            }
echo '</table>';
?>