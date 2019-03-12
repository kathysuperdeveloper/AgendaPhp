<?php
//session_start();
require('./conector.php');
$username =$_POST['username'];
$password = $_POST['password'];
$con = new ConectorBD('localhost','root','');

$response['conexion'] = $con->initConexion('agenda_db');
//session_start();
if(isset($_SESSION['username'])){
  $response['msg'] = 'OK';
}else{
  if ($response['conexion']=='OK') {
    $resultado_consulta = $con->ejecutarQuery('select email, password from usuarios WHERE email="'.$username.'"');
    if ($resultado_consulta->num_rows != 0) {
      $fila = $resultado_consulta->fetch_assoc();
      $response['pass']=$fila['password'];
      if (password_verify($password, $fila['password'])) {
        $response['msg'] = 'OK';
        //session_start();
        $_SESSION['username']=$fila['email'];
      }else {
        $response['motivo'] = 'Contraseña incorrecta';
        $response['msg'] = 'rechazado';
      }
    }else{
      $response['motivo'] = 'Email incorrecto';
      $response['msg'] = 'rechazado';
    }
  }
}
echo json_encode($response);

$con->cerrarConexion();






 ?>
