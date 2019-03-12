<?php
  	require('./conector.php');

$con = new ConectorBD('localhost','root','');

$response['conexion'] = $con->initConexion('agenda_db');
//session_start();

if($response['conexion'] == 'OK'){
    $titulo = $_POST['titulo'];
    $fecha_inicio = $_POST['start_date'];
    $hora_inicio = $_POST['start_hour'].':00';
    $fecha_fin = $_POST['end_date'];
    $hora_fin = $_POST['end_hour'].':00';
    $allday = $_POST['allDay'];
    $fk_usuarios = $_SESSION['username'];

    $consulta = $con->ejecutarQuery("insert into eventos (titulo, fecha_inicio, fecha_fin, hora_inicio, hora_fin, allday, fk_usuarios) values ('$titulo', '$fecha_inicio', '$fecha_fin', '$hora_inicio', '$hora_fin', '$allday', '$fk_usuarios')");

    if($consulta){
        $resultado = $con->ejecutarQuery('select MAX(id) from eventos');
        while($fila = $resultado->fetch_assoc()){
          $response['id']=$fila['MAX(id)'];
        }
        $response['msg'] = 'OK';
    }else{
        $response['msg'] = "Ha ocurrido un error al guardar el evento";
    }
}else{
    $response['msg'] = "Error en la comunicacion con la base de datos";
}

echo json_encode($response);
//$con->cerrarConexion();

 ?>
