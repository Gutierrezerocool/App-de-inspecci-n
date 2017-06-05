<?php
include('conexion.php');

function fechaNormal($fecha){
        $nfecha = date('d/m/Y',strtotime($fecha));
        return $nfecha;
                }

$id_estado = $_POST['id_estado'];      // placa del carro 
//ELIMINAMOS EL PRODUCTO



mysql_query("DELETE FROM estado where id_estado ='$id_estado'");


//DELETE FROM conductor_vehiculo WHERE vehiculo_placa = 'a';
//DELETE FROM vehiculo WHERE placa = 'a';
//DELETE FROM conductor WHERE id_conductor = '4';

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