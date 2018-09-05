<?php

require_once '../modelo/layout_model.php';
require_once '../modelo/beneficiario_model.php';
require_once '../modelo/main_model.php';
/**
 *
 */
class LayoutController{

	public function calculaFechaNac()
	{
		$curp = $_POST['curp'];

		$fn = substr($curp, 4, 6);
		$anio = substr($fn,0,2);
		$mes = substr($fn, 2, 2);
		$dia = substr($fn, 4);

		if ($anio >= 00 && $anio <= 18) {
			$xxi = "20".$anio."-".$mes."-".$dia;
			return $xxi;
		}else{
			$xx = "19".$anio."-".$mes."-".$dia;
			return $xx;
		}

	}

	function entidades($localidad, $municipio, $proyecto,$estado,$layout, $motivo)
	{
	#variables manipuladas

		$nom_comp = $_POST['nombre']." ".$_POST['apellido_p']." ".$_POST['apellido_m'];
		$coordenada = $_POST['latitud']." ".$_POST['longitud'];
		$rfc = substr($_POST['curp'], 0, 10);
		$enganche_especie =  implode ( ', ' , $_POST['enganche_especie']);
		$fecha_nacimiento = $this->calculaFechaNac();
		$gen = substr($_POST['curp'], 10, 1);

		$genero = ($gen == 'M') ? 'Femenino' : 'Masculino';
		
		// echo $enganche_especie; die();

	#Arreglo traido del formulario
		$data = ['proyecto' => $proyecto,
		'curp' => $_POST['curp'],
		'nombre' => $_POST['nombre'],
		'apellido_p' => $_POST['apellido_p'],
		'apellido_m' => $_POST['apellido_m'],
		'nombre_completo' => $nom_comp,
		'genero' => $genero,
		'estado_civil' => $_POST['estado_civil'],
		'fecha_nacimiento' => $fecha_nacimiento,
		'rfc' => $rfc,
		'ingreso' => $_POST['ingreso'],
		'antiguedad' => $_POST['antiguedad'],
		'ocupacion' => $_POST['ocupacion'],
		'telefono' => $_POST['telefono'],
		'solucion' => $_POST['solucion'],
		'subsidio' => $_POST['subsidio'],
		'credito' => $_POST['credito'],
		'enganche_efectivo' => $_POST['enganche_efectivo'],
		'enganche_especie' => $enganche_especie,
		'otros_apoyos' => $_POST['otros_apoyos'],
		'modalidad' => $_POST['modalidad'],
		'cuv' => $_POST['cuv'],
		'puntaje' => $_POST['puntaje'],
		'estado' => $estado,
		'municipio' => $municipio,
		'cp' => $_POST['cp'],
		'localidad'=>$localidad,
		'colonia' => $_POST['colonia'],
		'domicilio_beneficiario' => $_POST['domicilio_beneficiario'],
		'tipo_asentamiento' => $_POST['tipo_asentamiento'],
		'coordenada' => $coordenada,
		'latitud' => $_POST['latitud'],
		'longitud' => $_POST['longitud'],
		'domicilio_terreno' => $_POST['domicilio_terreno'],
		'pcu' => $_POST['pcu'],
		'zona'=>$_POST['zona'],
		'motivo'=>$motivo,
		'layout'=>$layout];

		return $data;
	}
	function guardaLayout(){
		$data = ['id' => $_POST['municipio']];
		$result = MainModelo::obtenerMunicipio($data);

		foreach ($result as $row => $item) {
			$localidad = $item['municipio'];
			$data = $this->entidades($localidad, $_POST['municipio'], $_POST['proyecto'], $_POST['estado'],"0", "0");
		}

		if ($data['modalidad']=='Autoproduccion') {
			if ($data['ingreso']>=6900 && $data['ingreso']<=11000){

				$x = $data['ingreso'];
				if(strlen($x)<5){
					$x1 = substr($x, 0,1);
					$x2 = substr($x, -3);
					$arr = array($x1, $x2);
					$ingreso = implode(",",$arr);
					$data['ingreso'] = $ingreso;
				}else{
					$x1 = substr($x, 0,2);
					$x2 = substr($x, 2);
					$arr = array($x1, $x2);
					$ingreso = implode(",",$arr);
					$data['ingreso'] = $ingreso;

				}	

				$response = LayoutModelo::insertaLayout($data);

				if ($response==1) {
					echo "<script>window.location = '../vistas/proyectos.php';</script>";
				}else{
					var_dump($response);
					echo "<br>";
					var_dump($data);
				}
			} else{
				// echo "<script>alert('Ingreso no válido'); window.location = '../vistas/form_layout.php?w=".$data['proyecto']."';</script>";
				echo "<script>	window.location='../vistas/error_alert.php?w=".$data['proyecto']."';</script>";
				// echo "<script>alertIngreso(".$data['proyecto']."); ";
				// $this->alerta($data['proyecto']);
			}
			
		}else{
			$response = LayoutModelo::insertaLayout($data);

			if ($response==1) {
				echo "<script>window.location = '../vistas/proyectos.php';</script>";
			}else{
				var_dump($response);
				echo "<br> Inserta :";
				var_dump($data);
			}
		}
	}

	public function actualizaLayout()
	{
		$data = ['municipio' => $_POST['municipio'], 'proyecto'=>$_POST['proyecto'], 'estado'=>$_POST['estado']];
		$result = MainModelo::obtenerIdMunicipio($data);
		$response = MainModelo::obtenerIdProyecto($data);
		$resultadoestado = MainModelo::obtenerIdEstado($data);

		foreach ($resultadoestado as $row => $item) {
			$idestado = $item['idestado'];
		}

		foreach ($response as $row => $item) {
			$idproyecto = $item['idproyecto'];
		}
		foreach ($result as $row => $item) {
			$idmunicipio = $item['idmunicipio'];
			if (isset($_POST['observacion'])) {
				$data = $this->entidades($_POST['municipio'],$idmunicipio,$idproyecto, $idestado, $_POST['layout'], $_POST['observacion']);
			}else{
				$data = $this->entidades($_POST['municipio'],$idmunicipio,$idproyecto, $idestado, $_POST['layout'], $_POST['motivo']);	
			}
		}


		$response = LayoutModelo::actualizaLayout($data);

		if ($response==1) {
			echo "<script>window.location = '../vistas/proyectos.php';</script>";
		}else{

			echo "datos no insertado<br>";
			var_dump($data);

		}
	}

	public function ejecucionLayout()
	{
		$data = ['id' => $_POST['layout'], 'cuv'=>$_POST['cuv'], 'puntaje'=>$_POST['puntaje']];
		 
		$result = LayoutModelo::ejecucionLayout($data);

		if ($result==1) {
			echo "<script>window.location = '../vistas/proyectos.php';
			</script>";
		}else{

			echo "datos no insertado<br>";
			var_dump($data);
		}
	}

	public function apartaLayout()
	{
		$data = ['id' => $_POST['layout'], 'fecha' => $_POST['fecha_apartado']];
		$result = LayoutModelo::apartaLayout($data);

		if ($result==1) {
			echo "<script>window.location = '../vistas/proyectos.php';
			</script>";
		}else{

			echo "datos no insertado<br>";
			var_dump($data);
		}
	}

	public function cancelacionLayout()
	{
		$data = ['id' => $_POST['layout'],
		'motivo' => $_POST['cancelacion']];
		
		$result = BeneficiarioModelo::cancelarBeneficiario($data);

		$response = ($result==1) ? "<script>window.location='../vistas/proyectos.php';</script>" : "Error al insertar";

		echo $response;
	}
}
// $layout = new LayoutController();
if (isset($_POST['cancelacion'])) {
	$layout = new LayoutController();
	$layout->cancelacionLayout();
}else{

	if(isset($_POST['ejecuta'])){
		$layout = new LayoutController();
		$layout->ejecucionLayout();
	}else{

	if(isset($_POST['aparta'])){
		$layout = new LayoutController();
		$layout->apartaLayout();
	}else{
		if(isset($_POST['curp']) && is_numeric($_POST['municipio']) && is_numeric($_POST['proyecto'])){

			$layout = new LayoutController();
			$layout->guardaLayout();
		}else{
			$layout = new LayoutController();
			$layout->actualizaLayout();
			}	
		}
	}
}



?>
