<?php 
include '../controladores/cancela_controller.php';
?>
<div id="cancelarm" class="modal">
	<div class="modal-content">
		<h3>Cancelación de beneficiario</h3>
			<div id="formcancela">
				
			</div>
		<script> 
			$(document).ready(function() {
				$(document).on('click', '.cancelar', function() {
					
				var btn=$('.cancelar').val();
				 var dataString = 'id='+btn;
				console.log(dataString);
				$.ajax({
					url:"../controladores/cancela_controller.php",
					type:"POST",
					data:dataString,
					success: function(response) {
						// console.log("response: "+response);
						$('#formcancela').html(response);
					}
				});
				return false;
				});
			});
		</script>
		<?php
      // $cancelar = new CancelaController();
      // $cancelar->obtenerDatos($usuario); ?>
      
  </div>
</div>  

