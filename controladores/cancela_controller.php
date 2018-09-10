<?php
require_once '../modelo/proyecto_model.php';
require_once '../modelo/beneficiario_model.php';
/**
 *
 */
class CancelaController
{
  public function obtenerDatos()
  {
    $id = $_POST['id'];

    $data = ['id'=>$id];

    $result = ProyectoModelo::obtenerDatos($data);
    

      foreach ($result as $row => $item) {
        echo"  <form action='../controladores/layout_controller.php' method='POST'>
          <input value='actualizacion' name='actualizacion' style='display:none;'>
          	<div class='row'>
          		<div class='col m12'>
              <!-- layout -->
              <div class='input-field col m12'>
                  <input style='display:none;' id='layout' name='layout' type='text' class='validate' value='".$item['id_layout']."' readonly required>
              </div>
              <!-- motivo -->
                <div class='input-field col m12'>
                  <i class='material-icons prefix'>compare_arrows</i>
                   <select id='motivo' name='cancelacion'>
                      <option value='' disabled>Seleccion el motivo</option>
                      <option value='El beneficiario cancelo'>El beneficiario canceló</option>
                      <option value='El municipio cancelo'>El municipio canceló</option>
                      <option value='Con subsidio / sin familiar'> Con subsidio / sin familiar</option>
                   </select>
                  <label class='active'>Motivo de sustitución</label>
                </div>
                <div class='input-field col m6' id='observacion'>
                </div>
          			<!-- proyecto -->
          			<div class='input-field col m12'>
          				<i class='material-icons prefix'>build</i>
          					<input id='proyecto' name='proyecto' type='text' class='validate' value='".$item['proyecto']."' readonly required>
          				<label class='active'>Proyecto</label>
          			</div>
          			<!-- nombre -->
          			<div class='input-field col m4'>
          				<i class='material-icons prefix'>account_circle</i>
          				<input id='nombre' name='nombre' type='text' class='validate' value='".$item['nombre']."' required readonly>
          				<label class='active'>Nombre</label>
          			</div>
          			<!-- apellido paterno -->
          			<div class='input-field col m4'>
          				<i class='material-icons prefix'>account_circle</i>
          				<input id='apellido_p' name='apellido_p' type='text' class='validate' value='".$item['apellido_paterno']."' required readonly>
          				<label class='active'>Apellido paterno</label>
          			</div>
          			<!-- apellido materno -->
          			<div class='input-field col m4'>
          				<i class='material-icons prefix'>account_circle</i>
          				<input id='apellido_m' name='apellido_m' type='text' class='validate'value='".$item['apellido_materno']."' required readonly>
          				<label class='active'>Apellido materno</label>
          			</div>
          			<!-- curp -->
          			<div class='input-field col m4'>
          				<i class='material-icons prefix'>recent_actors</i>
          				<input id='CURP' name='curp' value='". $item['curp']."' maxlength='18' style='text-transform: uppercase;' type='text'value='".$item['curp']."' class='validate' required readonly>
          				<label class='active'>CURP</label>
          			</div>	
          			<!-- teléfono -->
          			<div class='input-field col m4'>
          				<i class='material-icons prefix'>phone</i>
          				<input name='telefono' maxlength='10' type='number' value='".$item['telefono']."' class='validate' required readonly>
          				<label class='active'>Teléfono</label>
          			</div>
          			
                <div class='row'>
                	<div class='col m12'>
                		<div class='col m8 offset-m1'>
                        <a class='btn-floating btn-large waves-effect waves-light default-primario-color' href='proyectos.php'><i class='material-icons'>arrow_back</i></a>
                		</div>
                		<div class='col m2 offset-m1'>
                      <button class='btn waves-effect waves-light btn-floating btn-large waves-effect waves-light green accent-2' type='submit' name='action'>
                        <i class='material-icons right'>cancel</i>
                		</div>
                  </button>
                	</div>
                </div>
          		</div>
          	</div>
          </form>";
      }
  }
}

if(isset($_POST['id'])){
  $a = new CancelaController();
  $a -> obtenerDatos();
}

?>
