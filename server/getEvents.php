<?php
require('./conector.php');
$con = new ConectorBD('localhost','root','');

$response['conexion'] = $con->initConexion('agenda_db');

if($response['conexion']=='OK'){
  $resultado = $con->ejecutarQuery('select * from eventos where fk_usuarios ="'.$_SESSION['username'].'"');
  $i = 0;

  while($fila = $resultado->fetch_assoc()){
    $response['eventos'][$i]['id']=$fila['id'];
    $response['eventos'][$i]['title']=$fila['titulo'];
    if ($fila['allday'] == 0){
      $allDay = false;
      $response['eventos'][$i]['start']=$fila['fecha_inicio'].'T'.$fila['hora_inicio'];
      $response['eventos'][$i]['end']=$fila['fecha_fin'].'T'.$fila['hora_fin'];
    }else{
      $allDay= true;
      $response['eventos'][$i]['start']=$fila['fecha_inicio'];
      $response['eventos'][$i]['end']="";
    }


    $response['eventos'][$i]['allDay']=$allDay;
    $i++;
  }
  $response['msg'] = 'OK';
  $response['sesion'] = $_SESSION['username'];
}
echo json_encode($response);
 ?>
