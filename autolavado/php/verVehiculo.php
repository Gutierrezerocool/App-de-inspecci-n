<?php
include('conexion.php');

function fechaNormal($fecha){
        $nfecha = date('d/m/Y',strtotime($fecha));
        return $nfecha;
                }

$id_vehiculo = $_POST['id_vehiculo'];      // placa del carro
$id_conductor = $_POST['id_conductor'];  // id del conductor

//OBTENEMOS LOS VALORES DEL PRODUCTO

//$valores = mysql_query("SELECT id_conductor, nombre_conductor, telefono, telefono2 from conductor ")

$valores = mysql_query("SELECT * from conductor c, vehiculo v, conductor_vehiculo u, revisiones r where c.id_conductor ='$id_conductor' and v.id_vehiculo ='$id_vehiculo' and u.vehiculo_id_vehiculo ='$id_vehiculo' and u.conductor_id_conductor='$id_conductor' and r.conductor_vehiculo_vehiculo_id_vehiculo ='$id_vehiculo' and r.conductor_vehiculo_conductor_id_conductor='$id_conductor'");

//$valores = mysql_query("SELECT * FROM productos WHERE id_prod = '$id'");
$valores2 = mysql_fetch_array($valores);

$datos = array(
				//0 => $valores2['id_conductor'],
				0 => $valores2['nombre_conductor'], 
				1 => $valores2['telefono'], 
				2 => $valores2['telefono2'], 
				3 => $valores2['placa'],
				4 => $valores2['ano'],
				5 => $valores2['color'],
				6 => $valores2['nombre_vehiculo'],
				7 => $valores2['luces_delanteras'],
				8 => $valores2['luces_traseras'],
				9 => $valores2['antena'],
				10 => $valores2['espejo_derecho'],
				11 => $valores2['espejo_izquierdo'],
				12 => $valores2['vidrios'],
				13 => $valores2['emblema_delantero'],
				14 => $valores2['emblema_trasero'],
				15 => $valores2['tapones_rines'],
				16 => $valores2['tapon_gasolina'],
				17 => $valores2['carroceria'],
				18 => $valores2['encendedor'],
				19 => $valores2['espejo_retrovisor'],
				20 => $valores2['cenicero'],
				21 => $valores2['alfombras'],
				22 => $valores2['forros_asientos'],
				23 => $valores2['gato'],
				24 => $valores2['llave_ruedas'],
				25 => $valores2['caucho_repuesto'],
				26 => $valores2['estuche_herramientas'],
				27 => $valores2['triangulo_emergencia'],
				28 => $valores2['bateria'],
				29 => $valores2['tapa_fusilera'],
				30 => $valores2['create_time'],
				);
echo json_encode($datos);
?>