<?php
require_once '../modelo/excel_model.php';
/**
 *
 */
class ExcelController
{

  function exportar()
  {
    $data = ['id' => $_POST['folio']];
    $result = ExcelModelo::exportar($data);
  }

  function exportarChecklist()
  {
  	$data = ['id' => $_POST['check']];
    $result = ExcelModelo::exportarChecklist($data);
  }
}

  $excel = new ExcelController();
if(isset($_POST['folio'])){
  $excel->exportar();
}

if (isset($_POST['check'])) {
	$excel->exportarChecklist();
}

?>
