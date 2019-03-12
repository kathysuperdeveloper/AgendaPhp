<?php
 	require('./conector.php');

		$con = new ConectorBD('localhost','root','');

		$response['conexion'] = $con->initConexion('agenda_db');
		if($response['conexion'] == 'OK'){
					$id = $_POST['id'];
			    $fecha_inicio = $_POST['start_date'];
			    $hora_inicio = $_POST['start_hour'];
			    $fecha_final = $_POST['end_date'];
			    $hora_final = $_POST['end_hour'];

					$resultado = $con->ejecutarQuery('update eventos SET fecha_inicio="'.$fecha_inicio.'", fecha_fin="'.$fecha_final.'", hora_inicio="'.$hora_inicio.'", hora_fin="'.$hora_final.'" where id ='.$id);
					$response['msg'] = 'OK';

		}else{
		    $response['msg'] = "Error en la comunicacion con la base de datos";
		}
		echo json_encode($response);

	$con->cerrarConexion()


 ?>
