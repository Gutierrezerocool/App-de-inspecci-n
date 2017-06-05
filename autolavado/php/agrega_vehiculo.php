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

                function dateNormalTiempo($date){
        $ndate = date('d/m/Y',strtotime($date));
        return $ndate;
                }

//$id= $_POST['condid'];      // id del conductor
$conductor = $_POST['cond']; // nombre del conductor
$proceso = $_POST['pro'];   // proceso en el que se esta
$telefono = $_POST['tel'];   /// telefono
$telefono2 = $_POST['tel2'];  // Segundo telefono
$vehiculo = $_POST['veh'];   // nombre del vehiculo
$placa = $_POST['pla'];      // placa del carro
$ano = $_POST['an'];        //año del carro
$color = $_POST['col'];     // Color del carro
$fecha = date('Y-m-d');     //fecha del registro
$date = date('Y-m-d H:i:s');
$id_vehiculo=$_POST['id_vehiculo'];


//$id_estado =$_POST['id_estado'];
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

$luces_delanteras =$_POST['luces_delanteras'];
$luces_traseras =$_POST['luces_traseras'];
$antena =$_POST['antena'];
$espejo_derecho =$_POST['espejo_derecho'];
$espejo_izquierdo =$_POST['espejo_izquierdo'];
$vidrios =$_POST['vidrios'];
$emblema_delantero =$_POST['emblema_delantero'];
$emblema_trasero =$_POST['emblema_trasero'];
$tapones_rines =$_POST['tapones_rines'];
$tapon_gasolina =$_POST['tapon_gasolina'];
$carroceria =$_POST['carroceria'];
$encendedor =$_POST['encendedor'];
$espejo_retrovisor =$_POST['espejo_retrovisor'];
$cenicero =$_POST['cenicero'];
$alfombras =$_POST['alfombras'];
$forros_asientos =$_POST['forros_asientos'];
$gato =$_POST['gato'];
$llave_ruedas =$_POST['llave_ruedas'];
$caucho_repuesto =$_POST['caucho_repuesto'];
$estuche_herramientas =$_POST['estuche_herramientas'];
$triangulo =$_POST['triangulo'];
$bateria =$_POST['bateria'];
$tapa_fusilera =$_POST['tapa_fusilera'];

$consulta = mysql_query('SELECT MAX(id_conductor) as id_conductor FROM conductor LIMIT 1');
$consulta = mysql_fetch_array($consulta,MYSQL_ASSOC);

$id = (empty($consulta['id_conductor']) ? 1 : $consulta['id_conductor']+=1);

$iddd= $_POST['id_conductor'];

switch($proceso){
	case 'Registro':

        mysql_query(" INSERT INTO conductor (id_conductor, nombre_conductor, telefono, telefono2) VALUES ('$id','$conductor','$telefono','$telefono2')");

        mysql_query(" INSERT INTO vehiculo (id_vehiculo, placa, nombre_vehiculo, ano, color) VALUES ('$id_vehiculo','$placa','$vehiculo','$ano','$color') ");

        mysql_query(" INSERT INTO conductor_vehiculo (fecha, vehiculo_id_vehiculo, conductor_id_conductor) VALUES ('$fecha','$id_vehiculo','$id') ");

       mysql_query(" INSERT INTO revisiones (luces_delanteras, luces_traseras, antena, espejo_derecho, espejo_izquierdo, vidrios, emblema_delantero, emblema_trasero, tapones_rines, tapon_gasolina, carroceria, encendedor, espejo_retrovisor, cenicero, alfombras, forros_asientos, gato, llave_ruedas, caucho_repuesto, estuche_herramientas, triangulo_emergencia, bateria, tapa_fusilera,create_time, conductor_vehiculo_vehiculo_id_vehiculo, conductor_vehiculo_conductor_id_conductor) VALUES ('$luces_delanteras','$luces_traseras','$antena','$espejo_derecho','$espejo_izquierdo','$vidrios','$emblema_delantero','$emblema_trasero','$tapones_rines','$tapon_gasolina','$carroceria','$encendedor','$espejo_retrovisor','$cenicero','$alfombras','$forros_asientos','$gato','$llave_ruedas','$caucho_repuesto','$estuche_herramientas','$triangulo','$bateria','$tapa_fusilera','$date','$id_vehiculo','$id')");

        //mysql_query("INSERT INTO imagenes VALUES('".$idd."','".$texto."','".$ruta."')");

		//mysql_query("INSERT INTO conductor  (id_conductor, nombre_conductor, telefono)VALUES('$id','$conductor','$telefono')");

		//mysql_query("INSERT INTO vehiculos (placa, fecha, marca, nombre, conductor_id_conductor)VALUES('$placa','$fecha','$marca','$vehiculo','$id')");



	break;
	
	case 'Edicion':
		//mysql_query("UPDATE productos SET nomb_prod = '$nombre', tipo_prod = '$tipo', precio_unit = '$precio_uni', precio_dist = '$precio_dis' WHERE id_prod = '$id'");

        mysql_query("UPDATE conductor SET nombre_conductor ='$conductor',telefono ='$telefono',telefono2 ='$telefono2'      WHERE id_conductor = '$iddd'");

        mysql_query("UPDATE vehiculo SET placa='$placa' ,nombre_vehiculo = '$vehiculo', ano ='$ano', color='$color'   WHERE id_vehiculo='$id_vehiculo'");

        //mysql_query("UPDATE vehiculo v, conductor c, conductor_vehiculo a SET c.nombre_conductor ='$conductor',c.telefono ='$telefono',c.telefono2 ='$telefono2'   WHERE c.id_conductor='$id' and a.vehiculo_placa = '$placa'and v.placa ='$placa' ");
        
        mysql_query("UPDATE revisiones SET luces_delanteras = '$luces_delanteras', luces_traseras = '$luces_traseras', antena ='$antena', espejo_derecho='$espejo_derecho', espejo_izquierdo='$espejo_izquierdo', vidrios='$vidrios', emblema_delantero='$emblema_delantero', emblema_trasero='$emblema_trasero', tapones_rines='$tapones_rines', tapon_gasolina='$tapon_gasolina', carroceria='$carroceria', encendedor='$encendedor', espejo_retrovisor='$espejo_retrovisor', cenicero='$cenicero', alfombras='$alfombras', forros_asientos='$forros_asientos', gato='$gato', llave_ruedas='$llave_ruedas', caucho_repuesto='$caucho_repuesto', estuche_herramientas='$estuche_herramientas', triangulo_emergencia='$triangulo', bateria='$bateria',tapa_fusilera='$tapa_fusilera', create_time='$date'   WHERE conductor_vehiculo_vehiculo_id_vehiculo = '$id_vehiculo'");


	break;
}



//ACTUALIZAMOS LOS REGISTROS Y LOS OBTENEMOS

$registro = mysql_query("SELECT c.id_conductor, c.nombre_conductor, c.telefono, c.telefono2,v.id_vehiculo, UPPER(v.placa), v.nombre_vehiculo, v.ano, v.color, u.fecha, u.vehiculo_id_vehiculo, u.conductor_id_conductor from conductor c, vehiculo v, conductor_vehiculo u WHERE c.id_conductor = u.conductor_id_conductor and v.id_vehiculo = u.vehiculo_id_vehiculo and u.fecha=curdate()");

//CREAMOS NUESTRA VISTA Y LA DEVOLVEMOS AL AJAX

echo '<table class="table table-striped table-condensed table-hover">
        	<tr>
                <th width="130" style="font-size: 20px; text-align: center; ">Placa</th>
                <th width="130" style="font-size: 20px; text-align: center;">Vehículo</th>
                <th width="130" style="font-size: 20px; text-align: center;">Conductor</th>
                <th width="150" style="font-size: 20px; text-align: center;">Fecha Registro</th>
                <th width="50"  style="font-size: 20px; padding-left: 20px; ">Opciones</th>
            </tr>';
	while($registro2 = mysql_fetch_array($registro)){
      $idvehiculo = "'".$registro2['id_vehiculo']."'";
      $idconductor = "'".$registro2['id_conductor']."'";
                echo '<tr>
                        <td style="font-size: 20px; text-align: center;">'.$registro2['UPPER(v.placa)'].'</td>
                        <td style="font-size: 20px; text-align: center;">'.$registro2['nombre_vehiculo'].'</td> 
                        <td style="font-size: 20px; text-align: center;">'.$registro2['nombre_conductor'].'</td>
                        <td style="font-size: 20px; text-align: center;">'.fechaNormal($registro2['fecha']).'</td>
                        <td>
                        <a href="javascript:editarProducto('.$idvehiculo.','.$idconductor.');" class="glyphicon glyphicon-edit" style="font-size: 25px; width:30px; "></a> 
                        <a href="javascript:eliminarProducto('.$idvehiculo.','.$idconductor.');" class="glyphicon glyphicon-remove-circle" style="font-size: 25px; width:32px;"></a>
                        <a href="javascript:fotoProducto('.$idvehiculo.');" class="glyphicon glyphicon-camera" style="font-size: 25px; width:32px;"></a>
                        <a href="javascript:verVehiculos('.$idvehiculo.','.$idconductor.');" class="glyphicon glyphicon-eye-open" style="font-size: 25px; width:32px;"></a></td></td>
                    </tr>';       
	}
echo '</table>';
?>