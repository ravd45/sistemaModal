<?php include '../libs/header.php'; 
	  include '../controladores/main_controller.php';
	  include '../controladores/cancela_controller.php'?>


<button data-target="cancelarm" id="cancelar" class="btn modal-trigger">cancelar</button>
<button data-target="checklistm" class="btn modal-trigger">checklist</button>
<button data-target="sustituirm" class="btn modal-trigger">sustituir</button>

 <?php include 'modals.php'; ?>
<script>
		$(document).ready(function(){
			$(document).on('click', '#cancelar', function(){
				//var id=$(this).val();
				// var first=$('#firstname1').text();
				// var last=$('#lastname1').text();
				// var address=$('#address1').text();
				// var btn=$('#cancelar').val();

				// $('#layoutm').modal('show');
				// $('#efirstname').val(first);
				// $('#elastname').val(last);
				// $('#eaddress').val(address);
				// $('#nombre').html('<i class="material-icons prefix">account_circle</i><input id="nombre" name="nombre" value="'+btn+'" type="text" class="validate focus" required><label>Nombre</label>');
				console.log(btn);
			});
		});
	</script>

<?php 
include '../libs/footer.php'; ?>