<?php 
/**
 * 
 */
require_once '../modelo/login_model.php';

class InicioSesion{
	 
	public function inicio()
	{

		$data = ['usuario' => $_POST['usuario'],
				 'contrasenia' => $_POST['contrasenia']];
	   global $response;
	    $response = LoginModelo::iniciarSesion($data);
		
		
		if (empty($response) || is_null($response)) {
			echo "<script>
				window.location='../vistas/error_alert.php?q=2';</script>";
		} else{
			echo "<script>
				window.location='../vistas/vista_general.php';</script>";			
		}
	}

	function usuario()
	{
	}
}

if(isset($_POST['usuario'])){
	$is = new InicioSesion();
	$is->inicio();
}

?>