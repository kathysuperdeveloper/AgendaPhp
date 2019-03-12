<?php

session_start();
if (isset($_SESSION['username'])) {
  session_destroy();
  $response['msg'] = 'Salir';
}else{
  $response['msg'] = 'No ha iniciado sesion';
}
echo json_encode($response);

 ?>
