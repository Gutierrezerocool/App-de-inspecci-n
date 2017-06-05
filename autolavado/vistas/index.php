<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Autolavado</title>
<link href="../css/estilo.css" rel="stylesheet">
<script src="../js/jquery.js"></script>
<script src="../js/myjava.js"></script>
<link href="../bootstrap/css/bootstrap.css" rel="stylesheet">
<link href="../bootstrap/css/bootstrap.min.css" rel="stylesheet">
<link href="../bootstrap/css/bootstrap-theme.css" rel="stylesheet">
<link href="../bootstrap/css/bootstrap-theme.min.css" rel="stylesheet">
<script src="../bootstrap/js/bootstrap.min.js"></script>
<script src="../bootstrap/js/bootstrap.js"></script>
</head>
<body>
    <header>
        <section class="wrapper">
            <nav>
                <ul>
                    <li style="padding-right:5px; padding-left:5px;"><button id="nuevo-producto" class="btn btn-primary" style=" padding: 15px; margin-top:1px; margin-bottom:1px;"><span class="glyphicon glyphicon-check"></span> Inspección</button></li>

                    <li style=" padding-right: 5px;"><button id="nuevo-estado" class="btn btn-primary" style=" padding: 15px; margin-top:1px; margin-bottom:1px;"><span class="glyphicon glyphicon-plus"></span> Agregar Estado</button></li>

                    <li style=" padding-right: 5px;"><button id="nueva-foto" class="btn btn-primary" style=" padding: 15px; margin-top:1px; margin-bottom:1px;"><span class="glyphicon glyphicon-camera"></span> Tomar Foto</button></li>

                    <a href="http://localhost/autolavado/vistas/" style="color: #fff; margin-left:610px;" class="navbar-brand">Autolavado El Carmen C.A</a>
                </ul>
            </nav>
        </section>
    </header>

    <section class="contenido wrapper" style="text-align:center; ">
        <div class="row">
            <div class="col-sm-7 contenido" style="margin-top:-80px; margin-left: 90px; margin-right:-160px; ">
                 <h1 id="modulo-inspeccion" class="" style="font-size:35px;"> Módulo de inspección</h1>
                 <td><input style=" width:300px;  font-size: 18px;" type="text" placeholder="         Buscar vehículo por placa" id="bs-prod"/></td>
                 <br><br>

                 <td><input style="font-weight: bold; text-align: center; " type="date" id="bd-desde"/></td>
                <td>&nbsp;&nbsp;&nbsp;<span id="fin">Hasta</span>&nbsp;&nbsp;&nbsp;&nbsp;</td>
                <td><input style="font-weight: bold; text-align: center;" type="date" id="bd-hasta"/></td>
            </div>
            <div class="col-sm-5 contenido" style="margin-top:-90px;">
                 <h3 id="guia" class="">Guía:</h3>
                 <h4 id="edicion" ><span class="label label-info">Edición <span class="glyphicon glyphicon-edit"></span></span></h4>
                 <h4 id="eliminar"><span class="label label-info">Eliminar Registro <span class="glyphicon glyphicon-remove-circle"></span></h4>
                 <h4 id="galeria" ><span class="label label-info">Galería de Fotos <span class="glyphicon glyphicon-camera"></span></h4>
                 <h4 id="ver" ><span class="label label-info">Ver Registro <span class="glyphicon glyphicon-eye-open"></span></h4>
                 
            </div>
        </div>
    </section >
    
    <div class="registros" id="agrega-registros">
        <table class="table table-striped table-condensed table-hover">
            <tr>
                <th width="130" style="font-size: 20px; text-align: center; ">Placa</th>
                <th width="130" style="font-size: 20px; text-align: center;">Vehículo</th>
                <th width="130" style="font-size: 20px; text-align: center;">Conductor</th>
                <th width="150" style="font-size: 20px; text-align: center;">Fecha Registro</th>
                <th width="50"  style="font-size: 20px; padding-left: 20px; ">Opciones</th>
            </tr>
            

        <?php

            function fechaNormal($fecha){
        $nfecha = date('d/m/Y',strtotime($fecha));
        return $nfecha;
                }

            include('../php/conexion.php');
            $registro = mysql_query("SELECT c.id_conductor, c.nombre_conductor, c.telefono, c.telefono2,v.id_vehiculo, UPPER(v.placa), v.nombre_vehiculo, v.ano, v.color, u.fecha, u.vehiculo_id_vehiculo, u.conductor_id_conductor from conductor c, vehiculo v, conductor_vehiculo u WHERE c.id_conductor = u.conductor_id_conductor and v.id_vehiculo = u.vehiculo_id_vehiculo and u.fecha=curdate() "); 

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
                        <a href="javascript:verVehiculos('.$idvehiculo.','.$idconductor.');" class="glyphicon glyphicon-eye-open" style="font-size: 25px; width:32px;"></a></td>
                    </tr>';       
            }
        ?>
        </table>
    </div>



    <!-- MODAL PARA EL REGISTRO DE VEHÍCULOS-->
    <div class="modal fade" id="registra-producto" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog" style="width:950px">
          <div class="modal-content">
            <div class="modal-header">
              <button style="font-size: 55px;" type="button" class="close" onclick="javascript:window.location.reload();" data-dismiss="modal" aria-hidden="true">&times;</button>
              <h4 style="font-size: 25px; " class="modal-title" id="myModalLabel"><b>Autolavado el Carmen C.A - App de Inspección</b></h4>
            </div>
            <form id="formulario"  class="formulario"  onsubmit="return agregaRegistro();">
            <div class="modal-body"  style="font-size: 20px;" >
                <table border="0" width="100%">     

                

                <!--<input type="text"  name="pla" id="pla" maxlength="100" style="width:120px; text-transform: uppercase;" />-->

                <!--<input type="text" required="required" readonly="readonly" id="id_conductor_veh" name="id_conductor_veh" readonly="readonly" style="visibility:hidden; height:5px;"/>-->

               <t class="text-primary" >Tipo de proceso: </t>
                <input  style="width:80px; border: 0; " type="text" required="required" readonly="readonly" id="pro" name="pro"/>


               <h3 class="text-primary" style=" padding-bottom:10px;"> Datos del Cliente </h3>

                <t>Cliente: </t>
                <input type="text"  name="cond" id="cond" maxlength="100" style="width:250px" />

                <t style="padding-left:20px;">Teléfono 1: </t>
                <input type="text"  name="tel" id="tel" maxlength="100" style="width:140px;" />

                <t style="padding-left:20px">Teléfono 2: </t>
                <input type="text"  name="tel2" id="tel2" maxlength="100" style="width:140px;" />

                <h3 class="text-primary" style=" padding-bottom:10px;"> Datos del Vehículo </h3>

                <t style="padding-left:0px">Vehículo: </t>
                <input type="text"  name="veh" id="veh" maxlength="100" style="width:200px" />
                
                <t style="padding-left:20px">Placa: </t>
                <input type="text"  name="pla" id="pla" maxlength="100" style="width:120px; text-transform: uppercase;" />

                <t style="padding-left:20px">Año: </t>
                <input type="text"  name="an" id="an" maxlength="100" style="width:120px;"/>

                <t style="padding-left:20px">Color: </t>
                <input type="text"  name="col" id="col" maxlength="100" style="width:120px;"/>

                <br>

                <input type="text" required="required" readonly="readonly" id="id_conductor" name="id_conductor" readonly="readonly" style="visibility:hidden; height:25px;"/><!--ESTE ES EL ID DEL CONDUCTOR-->

                <input type="text" required="required" readonly="readonly" id="id_vehiculo" name="id_vehiculo" readonly="readonly" style="visibility:hidden; height:25px;"/>  

                <h3 class="text-primary" >Inspección </h3>
                
                

                <div class="panel-group" id="accordion" role="tablist">
                    <div class="panel panel-default">
                        <div class="panel-heading" role="tab" id="heading1">
                            <h4 class="panel-title">
                                <a style="font-size: 20px;" href="#collapse1" data-toggle="collapse" data-parent="#accordion">
                                 Exteriores
                                </a>
                            </h4>
                        </div>  

                        <div id="collapse1" class="panel-collapse collapse">
                            <div class="panel-body" style="font-size: 20px;" >
                                
                                <t style="padding-left:100px" >Antena:</t>
                                    <select required="required" name="antena" id="antena" style="padding:10px;">
                                    <?php require('../php/conexion.php'); 
                                    $lug = mysql_query("SELECT * FROM estado ORDER BY nombre_estado");
                                    echo '<option selected="selected" disabled="disabled">Elija un estado</option>';
                                    while($lug2 = mysql_fetch_array($lug)){
                                    echo '<option value="'.$lug2['nombre_estado'].'">'.$lug2['nombre_estado'].'</option>';
                                    }
                                    ?>         
                                    </select>

                                <t style="padding-left:79px">Emblema Delantero:</t>
                                    <select required="required" name="emblema_delantero" id="emblema_delantero" style="padding:10px;">
                                    <?php require('../php/conexion.php'); 
                                    $lug = mysql_query("SELECT * FROM estado ORDER BY nombre_estado");
                                    echo '<option selected="selected" disabled="disabled">Elija un estado</option>';
                                    while($lug2 = mysql_fetch_array($lug)){
                                    echo '<option value="'.$lug2['nombre_estado'].'">'.$lug2['nombre_estado'].'</option>';
                                    }
                                    ?>         
                                    </select>

                                <br> <br>

                                <t style="padding-left:5px">Emblema Trasero:</t>
                                    <select required="required" name="emblema_trasero" id="emblema_trasero" style="padding:10px;">
                                    <?php require('../php/conexion.php'); 
                                    $lug = mysql_query("SELECT * FROM estado ORDER BY nombre_estado");
                                    echo '<option selected="selected" disabled="disabled">Elija un estado</option>';
                                    while($lug2 = mysql_fetch_array($lug)){
                                    echo '<option value="'.$lug2['nombre_estado'].'">'.$lug2['nombre_estado'].'</option>';
                                    }
                                    ?>         
                                    </select>


                                <t style="padding-left:160px">Carrocería:</t>
                                    <select required="required" name="carroceria" id="carroceria" style="padding:10px;">
                                    <?php require('../php/conexion.php'); 
                                    $lug = mysql_query("SELECT * FROM estado ORDER BY nombre_estado");
                                    echo '<option selected="selected" disabled="disabled">Elija un estado</option>';
                                    while($lug2 = mysql_fetch_array($lug)){
                                    echo '<option value="'.$lug2['nombre_estado'].'">'.$lug2['nombre_estado'].'</option>';
                                    }
                                    ?>         
                                    </select>

                                <br> <br>


                                <t style="padding-left:20px">Espejo Derecho:</t>
                                    <select required="required" name="espejo_derecho" id="espejo_derecho" style="padding:10px;">
                                    <?php require('../php/conexion.php'); 
                                    $lug = mysql_query("SELECT * FROM estado ORDER BY nombre_estado");
                                    echo '<option selected="selected" disabled="disabled">Elija un estado</option>';
                                    while($lug2 = mysql_fetch_array($lug)){
                                    echo '<option value="'.$lug2['nombre_estado'].'">'.$lug2['nombre_estado'].'</option>';
                                    }
                                    ?>         
                                    </select>

                                <t style="padding-left:105px">Espejo Izquierdo:</t>
                                    <select required="required" name="espejo_izquierdo" id="espejo_izquierdo" style="padding:10px;">
                                    <?php require('../php/conexion.php'); 
                                    $lug = mysql_query("SELECT * FROM estado ORDER BY nombre_estado");
                                    echo '<option selected="selected" disabled="disabled">Elija un estado</option>';
                                    while($lug2 = mysql_fetch_array($lug)){
                                    echo '<option value="'.$lug2['nombre_estado'].'">'.$lug2['nombre_estado'].'</option>';
                                    }
                                    ?>         
                                    </select>

                                <br> <br>
                                
                                <t style="padding-left:100px">Vídrios:</t>
                                    <select required="required" name="vidrios" id="vidrios" style="padding:10px;">
                                    <?php require('../php/conexion.php'); 
                                    $lug = mysql_query("SELECT * FROM estado ORDER BY nombre_estado");
                                    echo '<option selected="selected" disabled="disabled">Elija un estado</option>';
                                    while($lug2 = mysql_fetch_array($lug)){
                                    echo '<option value="'.$lug2['nombre_estado'].'">'.$lug2['nombre_estado'].'</option>';
                                    }
                                    ?>         
                                    </select>

                                <t style="padding-left:100px">Luces Delanteras:</t>
                                    <select required="required" name="luces_delanteras" id="luces_delanteras" style="padding:10px;">
                                    <?php require('../php/conexion.php'); 
                                    $lug = mysql_query("SELECT * FROM estado ORDER BY nombre_estado");
                                    echo '<option selected="selected" disabled="disabled">Elija un estado</option>';
                                    while($lug2 = mysql_fetch_array($lug)){
                                    echo '<option value="'.$lug2['nombre_estado'].'">'.$lug2['nombre_estado'].'</option>';
                                    }
                                    ?>         
                                    </select>

                                <br> <br>


                                <t style="padding-left:25px">Luces Traseras:</t>
                                    <select required="required" name="luces_traseras" id="luces_traseras" style="padding:10px;">
                                    <?php require('../php/conexion.php'); 
                                    $lug = mysql_query("SELECT * FROM estado ORDER BY nombre_estado");
                                    echo '<option selected="selected" disabled="disabled">Elija un estado</option>';
                                    while($lug2 = mysql_fetch_array($lug)){
                                    echo '<option value="'.$lug2['nombre_estado'].'">'.$lug2['nombre_estado'].'</option>';
                                    }
                                    ?>         
                                    </select>

                                <t style="padding-left:102px">Tapones de rines:</t>
                                    <select required="required" name="tapones_rines" id="tapones_rines" style="padding:10px;">
                                    <?php require('../php/conexion.php'); 
                                    $lug = mysql_query("SELECT * FROM estado ORDER BY nombre_estado");
                                    echo '<option selected="selected" disabled="disabled">Elija un estado</option>';
                                    while($lug2 = mysql_fetch_array($lug)){
                                    echo '<option value="'.$lug2['nombre_estado'].'">'.$lug2['nombre_estado'].'</option>';
                                    }
                                    ?>         
                                    </select>

                                    <br> <br>

                                 <t style="padding-left:0px">Tapón de gasolina:</t>
                                    <select required="required" name="tapon_gasolina" id="tapon_gasolina" style="padding:10px;">
                                    <?php require('../php/conexion.php'); 
                                    $lug = mysql_query("SELECT * FROM estado ORDER BY nombre_estado");
                                    echo '<option selected="selected" disabled="disabled">Elija un estado</option>';
                                    while($lug2 = mysql_fetch_array($lug)){
                                    echo '<option value="'.$lug2['nombre_estado'].'">'.$lug2['nombre_estado'].'</option>';
                                    }
                                    ?>         
                                    </select>
                            </div>
                        </div>
                    </div>
                </div>

                

                <!-- DESDE AQUI LA SECCIÓN PARA INTERIORES - ACORDEON -->

                

                <div class="panel-group" id="accordion" role="tablist">
                    <div class="panel panel-default">
                        <div class="panel-heading" role="tab" id="heading2">
                            <h4 class="panel-title">
                                <a style="font-size: 20px;" href="#collapse2" data-toggle="collapse" data-parent="#accordion">
                                 Interiores
                                </a>
                            </h4>
                        </div>

                        <div id="collapse2" class="panel-collapse collapse">
                            <div class="panel-body" style="font-size: 20px;" >
                                
                                <t style="padding-left:70px">Alfombras:</t>
                                    <select required="required" name="alfombras" id="alfombras" style="padding:10px;">
                                    <?php require('../php/conexion.php'); 
                                    $lug = mysql_query("SELECT * FROM estado ORDER BY nombre_estado");
                                    echo '<option selected="selected" disabled="disabled">Elija un estado</option>';
                                    while($lug2 = mysql_fetch_array($lug)){
                                    echo '<option value="'.$lug2['nombre_estado'].'">'.$lug2['nombre_estado'].'</option>';
                                    }
                                    ?>         
                                    </select>

                                <t style="padding-left:59px">Caucho de Repuesto:</t>
                                    <select required="required" name="caucho_repuesto" id="caucho_repuesto" style="padding:10px;">
                                    <?php require('../php/conexion.php'); 
                                    $lug = mysql_query("SELECT * FROM estado ORDER BY nombre_estado");
                                    echo '<option selected="selected" disabled="disabled">Elija un estado</option>';
                                    while($lug2 = mysql_fetch_array($lug)){
                                    echo '<option value="'.$lug2['nombre_estado'].'">'.$lug2['nombre_estado'].'</option>';
                                    }
                                    ?>         
                                    </select>                            

                                <br> <br>

                                <t style="padding-left:80px">Cenicero:</t>
                                    <select required="required" name="cenicero" id="cenicero" style="padding:10px;">
                                    <?php require('../php/conexion.php'); 
                                    $lug = mysql_query("SELECT * FROM estado ORDER BY nombre_estado");
                                    echo '<option selected="selected" disabled="disabled">Elija un estado</option>';
                                    while($lug2 = mysql_fetch_array($lug)){
                                    echo '<option value="'.$lug2['nombre_estado'].'">'.$lug2['nombre_estado'].'</option>';
                                    }
                                    ?>         
                                    </select>

                                <t style="padding-left:78px">Forros de Asientos:</t>
                                    <select required="required" name="forros_asientos" id="forros_asientos" style="padding:10px;">
                                    <?php require('../php/conexion.php'); 
                                    $lug = mysql_query("SELECT * FROM estado ORDER BY nombre_estado");
                                    echo '<option selected="selected" disabled="disabled">Elija un estado</option>';
                                    while($lug2 = mysql_fetch_array($lug)){
                                    echo '<option value="'.$lug2['nombre_estado'].'">'.$lug2['nombre_estado'].'</option>';
                                    }
                                    ?>         
                                    </select>

                                <br> <br>

                                <t style="padding-left:2px">Espejo Retrovisor:</t>
                                    <select required="required" name="espejo_retrovisor" id="espejo_retrovisor" style="padding:10px;">
                                    <?php require('../php/conexion.php'); 
                                    $lug = mysql_query("SELECT * FROM estado ORDER BY nombre_estado");
                                    echo '<option selected="selected" disabled="disabled">Elija un estado</option>';
                                    while($lug2 = mysql_fetch_array($lug)){
                                    echo '<option value="'.$lug2['nombre_estado'].'">'.$lug2['nombre_estado'].'</option>';
                                    }
                                    ?>         
                                    </select>

                                <t style="padding-left:20px">Estuche de Herramientas:</t>
                                    <select required="required" name="estuche_herramientas" id="estuche_herramientas" style="padding:10px;">
                                    <?php require('../php/conexion.php'); 
                                    $lug = mysql_query("SELECT * FROM estado ORDER BY nombre_estado");
                                    echo '<option selected="selected" disabled="disabled">Elija un estado</option>';
                                    while($lug2 = mysql_fetch_array($lug)){
                                    echo '<option value="'.$lug2['nombre_estado'].'">'.$lug2['nombre_estado'].'</option>';
                                    }
                                    ?>         
                                    </select>

                                <br> <br>

                                <t style="padding-left:51px">Encendedor:</t>
                                    <select required="required" name="encendedor" id="encendedor" style="padding:10px;">
                                    <?php require('../php/conexion.php'); 
                                    $lug = mysql_query("SELECT * FROM estado ORDER BY nombre_estado");
                                    echo '<option selected="selected" disabled="disabled">Elija un estado</option>';
                                    while($lug2 = mysql_fetch_array($lug)){
                                    echo '<option value="'.$lug2['nombre_estado'].'">'.$lug2['nombre_estado'].'</option>';
                                    }
                                    ?>         
                                    </select>

                                <t style="padding-left:97px">Llave de Ruedas:</t>
                                    <select required="required" name="llave_ruedas" id="llave_ruedas" style="padding:10px;">
                                    <?php require('../php/conexion.php'); 
                                    $lug = mysql_query("SELECT * FROM estado ORDER BY nombre_estado");
                                    echo '<option selected="selected" disabled="disabled">Elija un estado</option>';
                                    while($lug2 = mysql_fetch_array($lug)){
                                    echo '<option value="'.$lug2['nombre_estado'].'">'.$lug2['nombre_estado'].'</option>';
                                    }
                                    ?>         
                                    </select>

                                    <br> <br>

                                <t style="padding-left:114px">Gato:</t>
                                    <select required="required" name="gato" id="gato" style="padding:10px;">
                                    <?php require('../php/conexion.php'); 
                                    $lug = mysql_query("SELECT * FROM estado ORDER BY nombre_estado");
                                    echo '<option selected="selected" disabled="disabled">Elija un estado</option>';
                                    while($lug2 = mysql_fetch_array($lug)){
                                    echo '<option value="'.$lug2['nombre_estado'].'">'.$lug2['nombre_estado'].'</option>';
                                    }
                                    ?>         
                                    </select>

                                <t style="padding-left:25px">Triángulo de Emergencia:</t>
                                    <select required="required" name="triangulo" id="triangulo" style="padding:10px;">
                                    <?php require('../php/conexion.php'); 
                                    $lug = mysql_query("SELECT * FROM estado ORDER BY nombre_estado");
                                    echo '<option selected="selected" disabled="disabled">Elija un estado</option>';
                                    while($lug2 = mysql_fetch_array($lug)){
                                    echo '<option value="'.$lug2['nombre_estado'].'">'.$lug2['nombre_estado'].'</option>';
                                    }
                                    ?>         
                                    </select>
    
                            </div>
                        </div>
                    </div>
                </div>
                
                
                
                <!-- DESDE AQUI LA SECCIÓN PARA MOTOR - ACORDEON -->

                

                <div class="panel-group" id="accordion" role="tablist">
                    <div class="panel panel-default">
                        <div class="panel-heading" role="tab" id="heading4">
                            <h4 class="panel-title">
                                <a style="font-size: 20px;" href="#collapse4" data-toggle="collapse" data-parent="#accordion">
                                 Motor
                                </a>
                            </h4>
                        </div>

                        <div id="collapse4" class="panel-collapse collapse">
                            <div class="panel-body" style="font-size: 20px;" >
                                
                                <t style="padding-left:92px">Batería:</t>
                                    <select required="required" name="bateria" id="bateria" style="padding:10px;">
                                    <?php require('../php/conexion.php'); 
                                    $lug = mysql_query("SELECT * FROM estado ORDER BY nombre_estado");
                                    echo '<option selected="selected" disabled="disabled">Elija un estado</option>';
                                    while($lug2 = mysql_fetch_array($lug)){
                                    echo '<option value="'.$lug2['nombre_estado'].'">'.$lug2['nombre_estado'].'</option>';
                                    }
                                    ?>         
                                    </select>

                                <t style="padding-left:80px">Tapa de la Fusilera:</t>
                                    <select required="required" name="tapa_fusilera" id="tapa_fusilera" style="padding:10px;">
                                    <?php require('../php/conexion.php'); 
                                    $lug = mysql_query("SELECT * FROM estado ORDER BY nombre_estado");
                                    echo '<option selected="selected" disabled="disabled">Elija un estado</option>';
                                    while($lug2 = mysql_fetch_array($lug)){
                                    echo '<option value="'.$lug2['nombre_estado'].'">'.$lug2['nombre_estado'].'</option>';
                                    }
                                    ?>         
                                    </select>

                            </div>
                        </div>
                    </div>
                </div>
         
                    <tr>
                        <td colspan="2">
                            <div id="mensaje"></div>
                        </td>
                    </tr>
                </table>
            </div>
            
            <div class="modal-footer">
                <input style="font-size: 25px;" type="submit" value="Registrar" class="btn btn-success" id="reg" />
                <input style="font-size: 25px;" type="submit" value="Editar" class="btn btn-warning"  id="edi"/>
            </div>
            </form>

<!--            <form method="post" action="../php/insertar.php" enctype="multipart/form-data">

                        <label>Elige Imagen:</label>
                        <br/>
                        <input type="file" name="imagen" id="imagen"/>
                        <br/>
                        <label>Descripcion:</label>
                        <br/>
                        <textarea cols="20" rows="10" name="texto"></textarea>
                        <br/>
                        <input type="submit" value="Enviar"/>
                </form> -->


          </div>
        </div>
    </div>

    <!--*********************************************** MODAL PARA VER INSPECCION **********************************-->

    <div class="modal fade" id="modal-ver" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog" style="width:950px">
          <div class="modal-content">
            <div class="modal-header">
              <button style="font-size: 55px;" type="button" class="close"  data-dismiss="modal" aria-hidden="true">&times;</button>
              <h4 style="font-size: 25px; " class="modal-title" id="myModalLabel"><b>Autolavado el Carmen C.A - App de Inspección</b></h4>
            </div>
            <form id="formulario5"  class="formulario5"  onsubmit="return verVehiculos();">
            <div class="modal-body"  style="font-size: 20px;" >
                <table border="0" width="100%">     

                <t style="padding-left:0px">Fecha y Hora de Registro: </t>
                <input type="text" required="required" readonly="readonly" id="date" name="date" readonly="readonly" style="visibility:visible; height:25px;"/>

                <!--<input type="text"  name="pla" id="pla" maxlength="100" style="width:120px; text-transform: uppercase;" />-->

                <!--<input type="text" required="required" readonly="readonly" id="id_conductor_veh" name="id_conductor_veh" readonly="readonly" style="visibility:hidden; height:5px;"/>-->

               <!--<t class="text-primary" >Tipo de proceso: </t>
                <input  style="width:80px; border: 0; " type="text" required="required" readonly="readonly" id="pro" name="pro"/>-->


               <h3 class="text-primary" style=" padding-bottom:10px;"> Datos del Cliente </h3>

                <t>Conductor: </t>
                <input type="text" readonly="readonly" name="cond1" id="cond1" maxlength="100" style="width:250px" />

                <t style="padding-left:20px;">Teléfono 1: </t>
                <input type="text" readonly="readonly" name="tel1" id="tel1" maxlength="100" style="width:140px;" />

                <t style="padding-left:20px">Teléfono 2: </t>
                <input type="text" readonly="readonly" name="tel22" id="tel22" maxlength="100" style="width:140px;" />

                <h3 class="text-primary" style=" padding-bottom:10px;"> Datos del Vehículo </h3>

                <t style="padding-left:0px">Vehículo: </t>
                <input type="text" readonly="readonly" name="veh1" id="veh1" maxlength="100" style="width:200px" />
                
                <t style="padding-left:20px">Placa: </t>
                <input type="text" readonly="readonly" name="pla1" id="pla1" maxlength="100" style="width:120px; text-transform: uppercase;" />

                <t style="padding-left:20px">Año: </t>
                <input type="text" readonly="readonly" name="an1" id="an1" maxlength="100" style="width:120px;"/>

                <t style="padding-left:20px">Color: </t>
                <input type="text" readonly="readonly" name="col1" id="col1" maxlength="100" style="width:120px;"/>

                <br>

                <input type="text" required="required" readonly="readonly" id="id_conductor" name="id_conductor" readonly="readonly" style="visibility:hidden; height:25px;"/><!--ESTE ES EL ID DEL CONDUCTOR-->

                <input type="text" required="required" readonly="readonly" id="id_vehiculo" name="id_vehiculo" readonly="readonly" style="visibility:hidden; height:25px;"/>  

                

                <h3 class="text-primary" >Inspección </h3>
                
                

                <div class="panel-group" id="accordion" role="tablist">
                    <div class="panel panel-default">
                        <div class="panel-heading" role="tab" id="heading5">
                            <h4 class="panel-title">
                                <a style="font-size: 20px;" href="#collapse5" data-toggle="collapse" data-parent="#accordion">
                                 Exteriores
                                </a>
                            </h4>
                        </div>  

                        <div id="collapse5" class="panel-collapse collapse">
                            <div class="panel-body" style="font-size: 20px;" >
                                
                                <t style="padding-left:100px" >Antena:</t>
                                    <input type="text" readonly="readonly" name="antena1" id="antena1" maxlength="100" style="width:120px;"/>

                                <t style="padding-left:79px">Emblema Delantero:</t>
                                    <input type="text" readonly="readonly" name="emblema_delantero1" id="emblema_delantero1" maxlength="100" style="width:120px;"/>

                                <br> <br>

                                <t style="padding-left:5px">Emblema Trasero:</t>
                                    <input type="text" readonly="readonly" name="emblema_trasero1" id="emblema_trasero1" maxlength="100" style="width:120px;"/>


                                <t style="padding-left:160px">Carrocería:</t>
                                    <input type="text" readonly="readonly" name="carroceria1" id="carroceria1" maxlength="100" style="width:120px;"/>

                                <br> <br>


                                <t style="padding-left:20px">Espejo Derecho:</t>
                                    <input type="text" readonly="readonly" name="espejo_derecho1" id="espejo_derecho1" maxlength="100" style="width:120px;"/>

                                <t style="padding-left:105px">Espejo Izquierdo:</t>
                                    <input type="text" readonly="readonly" name="espejo_izquierdo1" id="espejo_izquierdo1" maxlength="100" style="width:120px;"/>

                                <br> <br>
                                
                                <t style="padding-left:100px">Vídrios:</t>
                                    <input type="text" readonly="readonly" name="vidrios1" id="vidrios1" maxlength="100" style="width:120px;"/>

                                <t style="padding-left:100px">Luces Delanteras:</t>
                                    <input type="text" readonly="readonly" name="luces_delanteras1" id="luces_delanteras1" maxlength="100" style="width:120px;"/>

                                <br> <br>


                                <t style="padding-left:25px">Luces Traseras:</t>
                                    <input type="text" readonly="readonly" name="luces_traseras1" id="luces_traseras1" maxlength="100" style="width:120px;"/>

                                <t style="padding-left:102px">Tapones de rines:</t>
                                    <input type="text" readonly="readonly" name="tapones_rines1" id="tapones_rines1" maxlength="100" style="width:120px;"/>

                                    <br> <br>

                                 <t style="padding-left:0px">Tapón de gasolina:</t>
                                    <input type="text" readonly="readonly" name="tapon_gasolina1" id="tapon_gasolina1" maxlength="100" style="width:120px;"/>
                            </div>
                        </div>
                    </div>
                </div>

                

                <!-- DESDE AQUI LA SECCIÓN PARA INTERIORES - ACORDEON -->

                

                <div class="panel-group" id="accordion" role="tablist">
                    <div class="panel panel-default">
                        <div class="panel-heading" role="tab" id="heading6">
                            <h4 class="panel-title">
                                <a style="font-size: 20px;" href="#collapse6" data-toggle="collapse" data-parent="#accordion">
                                 Interiores
                                </a>
                            </h4>
                        </div>

                        <div id="collapse6" class="panel-collapse collapse">
                            <div class="panel-body" style="font-size: 20px;" >
                                
                                <t style="padding-left:70px">Alfombras:</t>
                                    <input type="text" readonly="readonly" name="alfombras1" id="alfombras1" maxlength="100" style="width:120px;"/>

                                <t style="padding-left:59px">Caucho de Repuesto:</t>
                                    <input type="text" readonly="readonly" name="caucho_repuesto1" id="caucho_repuesto1" maxlength="100" style="width:120px;"/>                            

                                <br> <br>

                                <t style="padding-left:80px">Cenicero:</t>
                                    <input type="text" readonly="readonly" name="cenicero1" id="cenicero1" maxlength="100" style="width:120px;"/>

                                <t style="padding-left:78px">Forros de Asientos:</t>
                                    <input type="text" readonly="readonly" name="forros_asientos1" id="forros_asientos1" maxlength="100" style="width:120px;"/>

                                <br> <br>

                                <t style="padding-left:2px">Espejo Retrovisor:</t>
                                    <input type="text" readonly="readonly" name="espejo_retrovisor1" id="espejo_retrovisor1" maxlength="100" style="width:120px;"/>

                                <t style="padding-left:20px">Estuche de Herramientas:</t>
                                    <input type="text" readonly="readonly" name="estuche_herramientas1" id="estuche_herramientas1" maxlength="100" style="width:120px;"/>

                                <br> <br>

                                <t style="padding-left:51px">Encendedor:</t>
                                    <input type="text" readonly="readonly" name="encendedor1" id="encendedor1" maxlength="100" style="width:120px;"/>

                                <t style="padding-left:97px">Llave de Ruedas:</t>
                                    <input type="text" readonly="readonly" name="llave_ruedas1" id="llave_ruedas1" maxlength="100" style="width:120px;"/>

                                    <br> <br>

                                <t style="padding-left:114px">Gato:</t>
                                    <input type="text" readonly="readonly" name="gato1" id="gato1" maxlength="100" style="width:120px;"/>

                                <t style="padding-left:25px">Triángulo de Emergencia:</t>
                                    <input type="text" readonly="readonly" name="triangulo1" id="triangulo1" maxlength="100" style="width:120px;"/>
    
                            </div>
                        </div>
                    </div>
                </div>
                
                
                
                <!-- DESDE AQUI LA SECCIÓN PARA MOTOR - ACORDEON -->

                

                <div class="panel-group" id="accordion" role="tablist">
                    <div class="panel panel-default">
                        <div class="panel-heading" role="tab" id="heading7">
                            <h4 class="panel-title">
                                <a style="font-size: 20px;" href="#collapse7" data-toggle="collapse" data-parent="#accordion">
                                 Motor
                                </a>
                            </h4>
                        </div>

                        <div id="collapse7" class="panel-collapse collapse">
                            <div class="panel-body" style="font-size: 20px;" >
                                
                                <t style="padding-left:92px">Batería:</t>
                                    <input type="text" readonly="readonly" name="bateria1" id="bateria1" maxlength="100" style="width:120px;"/>

                                <t style="padding-left:80px">Tapa de la Fusilera:</t>
                                    <input type="text" readonly="readonly" name="tapa_fusilera1" id="tapa_fusilera1" maxlength="100" style="width:120px;"/>

                            </div>
                        </div>
                    </div>
                </div>
         
                    <tr>
                        
                    </tr>
                </table>
            </div>
            
            <div class="modal-footer">
                <h1></h1>
            </div>
            </form>

<!--            <form method="post" action="../php/insertar.php" enctype="multipart/form-data">

                        <label>Elige Imagen:</label>
                        <br/>
                        <input type="file" name="imagen" id="imagen"/>
                        <br/>
                        <label>Descripcion:</label>
                        <br/>
                        <textarea cols="20" rows="10" name="texto"></textarea>
                        <br/>
                        <input type="submit" value="Enviar"/>
                </form> -->


          </div>
        </div>
    </div>

    <!--*********************************************** FIN MODAL PARA VER INSPECCION ******************************-->

    <!-- REGISTRO ESTADOS -->

    <div class="modal fade" id="registra-estado" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog" style="width:1000px">
          <div class="modal-content">
            <div class="modal-header">
              <button style="font-size: 55px;" type="button" class="close" onclick="javascript:window.location.reload();" data-dismiss="modal" aria-hidden="true">&times;</button>
              <h4 style="font-size: 25px; " class="modal-title" id="myModalLabel"><b>Autolavado el Carmen C.A - App de Inspección</b></h4>
            </div>
            <form id="formulario3"  class="formulario3"  onsubmit="return agregaRegistroEstado();">
            <div class="modal-body"  style="font-size: 20px;" >

               <t>Nuevo Estado: </t>
                <input type="text"  name="nombre_estado" id="nombre_estado" maxlength="100" style="width:250px" />

                <input type="text" required="required" readonly="readonly" id="id_estado" name="id_estado" readonly="readonly" style="visibility:hidden; height:5px;"/>
                    

                    <div class="registros" id="agrega-estados">
        <table class="table table-striped table-condensed table-hover border="0" width="100%"">
            <tr>
                <th width="150" style="font-size: 20px;">ID Estado</th>
                <th width="130" style="font-size: 20px;">Estado</th>
                <th width="50"  style="font-size: 20px;">Opciones</th>
            </tr>
            

        <?php

           

            include('../php/conexion.php');
            $actualizar = mysql_query("SELECT id_estado, nombre_estado from estado"); 

            while($actualizar2 = mysql_fetch_array($actualizar)){
      $id_estado = "'".$actualizar2['id_estado']."'";
                echo '<tr>
                        <td style="font-size: 20px;">'.$actualizar2['id_estado'].'</td>
                        <td style="font-size: 20px;">'.$actualizar2['nombre_estado'].'</td> 

                        <td>
                        <a href="javascript:eliminarEstado('.$id_estado.');" class="glyphicon glyphicon-remove-circle" style="font-size: 25px; width:32px;"></a></td>
                    </tr>';       
            }
        ?>
        </table>
             <tr>
                        <td colspan="2">
                            <div id="mensaje3"></div>
                        </td>
                    </tr>
                
            </div>
            
            <div class="modal-footer">
                <input style="font-size: 25px;" type="submit" value="Registrar" class="btn btn-success" id="reg"/>
                <!--<input type="submit" value="Editar" class="btn btn-warning"  id="edi"/>-->
            </div>
            </form>

<!--            <form method="post" action="../php/insertar.php" enctype="multipart/form-data">

                        <label>Elige Imagen:</label>
                        <br/>
                        <input type="file" name="imagen" id="imagen"/>
                        <br/>
                        <label>Descripcion:</label>
                        <br/>
                        <textarea cols="20" rows="10" name="texto"></textarea>
                        <br/>
                        <input type="submit" value="Enviar"/>
                </form> -->
</div>

          </div>
        </div>
    </div>

    <!--FIN  REGISTRO ESTADOS -->
    
    <!-- Registra FOTOS-->
    <div class="modal fade" id="registra-foto" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog" style="width:500px">
          <div class="modal-content">
                <div class="modal-header">
                    <button style="font-size: 55px;" type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                    <h4 style="font-size: 25px; " class="modal-title" id="myModalLabel"><b>Módulo de Imágenes</b></h4>
                </div>
                <form id="formulario2"  class="formulario2" method="post" action="../php/insertar.php" enctype="multipart/form-data" style=" padding-top: 10px; ">

                        <h2 style="padding-left:10px; font-weight: bold; "><span class="label label-primary">Paso 1</span></h2>
              
                        <t style="padding-left:10px; font-weight: bold; ">Selecciona la placa del vehículo</t>
                                    <select required="required" name="plaquita" id="plaquita" style="padding:10px;">
                                    <?php require('../php/conexion.php'); 

                                    $lug = mysql_query("SELECT v.id_vehiculo, v.placa, v.nombre_vehiculo, v.ano, v.color, u.fecha, u.vehiculo_id_vehiculo, u.conductor_id_conductor FROM vehiculo v, conductor_vehiculo u Where u.fecha=curdate() and v.id_vehiculo=u.vehiculo_id_vehiculo ORDER BY v.nombre_vehiculo");
                                    echo '<option selected="selected" disabled="disabled">Elija una placa</option>';
                                    while($lug2 = mysql_fetch_array($lug)){
                                    echo '<option value="'.$lug2['id_vehiculo'].'">'.$lug2['placa'].'</option>';
                                    }
                                    ?>         
                                    </select>
                        <h2 style="padding-left:10px; font-weight: bold; "><span class="label label-primary">Paso 2</span></h2>
                        <br/>
                        <label style="padding-left:10px;">Toma o elige una fotografía:</label>
                        <br/>
                        <input style="padding-left:10px;" type="file" name="imagen" id="imagen"/>
                        <br/>
                        <h2 style="padding-left:10px; font-weight: bold; "><span class="label label-primary">Paso 3</span></h2>
                        <br/>

                        <label style="padding-left:10px;" >Breve descripción, es opcional:</label>
                        <br/>
                        <t style="padding-left:10px;"> <textarea cols="55" rows="2" name="texto"></textarea></t>
                        <br/>

                        <input type="text" required="required" readonly="readonly" id="condidd" name="condidd" readonly="readonly" style="visibility:hidden; height:5px;"/>


                        <!--<input type="file" name="imagen2" id="imagen2"/>
                        <br/>
                        <label>Descripcion:</label>
                        <br/>
                        <textarea cols="20" rows="10" name="texto2"></textarea>
                        <br/>-->
                        <!--<input type="submit" value="Enviar" />-->

                        
<div class="modal-footer">
    <input style="font-size: 25px;" type="submit" value="Agregar" class="btn btn-success" id="reg" />
</div>
                </form>
            </div>
        </div>
    </div>

    

</body>
</html>
