<?php include '../libs/header.php'; ?>

<?php for ($i=10; $i >0 ; $i--) { ?>
	<span class='span<?php echo $i;?>'><?php echo $i; ?></span>
	<button value='<?php echo $i; ?>' class='boton' id='boton'>id</button>

	<script>
		$(document).ready(function (){
			$(document).on('click', '#boton', function() {
				
			var btn = $('.boton').val();
			console.log(btn);
			});
		})
	</script>
<?php } ?>
<?php include '../libs/footer.php'; ?>