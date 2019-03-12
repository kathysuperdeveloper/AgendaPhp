<?php
	require('./conector.php');
  $con = new ConectorBD('localhost','root','');

  $response['conexion'] = $con->initConexion('agenda_db');
	if ($response['conexion'] == 'OK') {

		if ($con->ejecutarQuery('delete from eventos where id='.$_POST['id'])) {
			$response['msg'] = 'OK';
		}else{
			$response['msg'] = 'No se a podido eliminar el registro';
		}
	}else{
			$response['msg'] = "error en la comunicacion con la base de datos";
		}
	echo json_encode($response)


 ?>
