<?php

require('./conector.php');
$con = new ConectorBD('localhost','root','');

$response['conexion'] = $con->initConexion('agenda_db');
if ($response['conexion'] == 'OK'){
  $conexion = $con->getConexion();
  $insert = $conexion->prepare('INSERT INTO usuarios (email, nombre, password , fecha_nacimiento) VALUES (?,?,?,?)');
  $insert->bind_param("ssss", $email, $nombre, $password, $fecha_nacimiento);

  $d_password = "1234";
  $email = "jaan@mail.com";
  $nombre = "Jaan Palmera";
  $password = password_hash($d_password, PASSWORD_DEFAULT);
  $fecha_nacimiento = "1976-12-26";

  $insert->execute();

  $email = 'nextu@mail.com';
  $nombre = 'Next U';
  $password = password_hash($d_password, PASSWORD_DEFAULT);
  $fecha_nacimiento = '2017-12-01';

  $insert->execute();

  $email = 'usuario@mail.com';
  $nombre = 'usuario';
  $password = password_hash($d_password, PASSWORD_DEFAULT);
  $fecha_nacimiento = '1997-12-03';

  $insert->execute();
  $response['resultado'] = "1";
  $response['msg']= 'Informacio de inicio:';
  $getUsers = $con->consultar(['usuarios'],['*'],$condicion = "");
  while ($fila= $getUsers->fetch_assoc()) {
    $response['msg'].=$fila['email'];
  }
  $response['msg'].= 'contraenia: '.$d_password;
  }else{
    $response['resultado'] == "0";
    $response['msg'] = 'No se pudo conectar a la base de datos';
  }

  echo json_encode($response);


 ?>
