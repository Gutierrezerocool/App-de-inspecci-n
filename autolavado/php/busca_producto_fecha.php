<?php
include('conexion.php');

$desde = $_POST['desde'];
$hasta = $_POST['hasta'];

//COMPROBAMOS QUE LAS FECHAS EXISTAN
if(isset($desde)==false){
	$desde = $hasta;
}

if(isset($hasta)==false){
	$hasta = $desde;
}

function fechaNormal($fecha){
        $nfecha = date('d/m/Y',strtotime($fecha));
        return $nfecha;
                }

                function dateNormalTiempo($date){
        $ndate = date('d/m/Y',strtotime($date));
        return $ndate;
                }

//EJECUTAMOS LA CONSULTA DE BUSQUEDA

$registro = mysql_query("SELECT c.id_conductor, c.nombre_conductor, c.telefono, c.telefono2,v.id_vehiculo, UPPER(v.placa), v.nombre_vehiculo, v.ano, v.color, u.fecha, u.vehiculo_id_vehiculo, u.conductor_id_conductor from conductor c, vehiculo v, conductor_vehiculo u WHERE u.fecha BETWEEN '$desde' AND '$hasta' and c.id_conductor=u.conductor_id_conductor and v.id_vehiculo=u.vehiculo_id_vehiculo");

//$registro = mysql_query("SELECT * FROM productos WHERE fecha_reg BETWEEN '$desde' AND '$hasta' ORDER BY id_prod ASC");

//CREAMOS NUESTRA VISTA Y LA DEVOLVEMOS AL AJAX

echo '<table class="table table-striped table-condensed table-hover">
        	<tr>
                <th width="130" style="font-size: 20px; text-align: center; ">Placa</th>
                <th width="130" style="font-size: 20px; text-align: center;">Vehículo</th>
                <th width="130" style="font-size: 20px; text-align: center;">Conductor</th>
                <th width="150" style="font-size: 20px; text-align: center;">Fecha Registro</th>
                <th width="50"  style="font-size: 20px; padding-left: 20px; ">Opciones</th>
            </tr>';
            if(mysql_num_rows($registro)>0){
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
}else{
	echo '<tr>
				<td colspan="6">No se encontraron resultados</td>
			</tr>';
}
echo '</table>';
?>