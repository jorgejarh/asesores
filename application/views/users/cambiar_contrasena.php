<h3 align="center"><?php echo $title;?></h3>

<hr>

<?php 
	$attributes = array('id'=>'cambiar_pass');
?>

<?php echo form_open( '', $attributes); ?>
<table align="center" style="margin:auto;">
	<tr>
		<td>Contraseña Actual:</td>
		<td><input type="password" name="clave_actual"></td>
	</tr>
    <tr>
		<td>Contraseña Nueva:</td>
		<td><input type="password" name="clave_nueva"></td>
	</tr>
	<tr>
		<td>Repita Contraseña Nueva:</td>
		<td><input type="password" name="clave_nueva2"></td>
	</tr>
	<tr>
		<td colspan="2">
			<hr>
		</td>
	</tr>
	<tr>
		<td colspan="2" align="center">
			<div id="div_error" ></div>
		</td>
	</tr>
	<tr>
		<td colspan="2" align="center">
			<input type="submit" id="save" value="Guardar" />
		</td>
	</tr>
</table>

<?php echo form_close(); ?>

<div class="cargando_"></div>

<script>
	$(document).ready(function(e) {

		$('#cambiar_pass').submit(function(){

			var form = $(this);

			form.fadeOut('fast', function(){

				$('.cargando_').fadeIn('fast');

				$.ajax({
				  	url: "<?php echo site_url('users/cambiar_contrasena_proceso');?>",
				  	type:"POST",
				  	dataType:"json",
				  	data:$(this).serialize(),
				  	success:function(data){

				  		if(data.error)
				  		{
				  			$('#div_error').html(data.mensaje);
				  			$('.cargando_').fadeOut('fast');
				  			form.fadeIn('fast');
				  		}else{

				  			location.reload();
				  		}				  		
				  	},
				   	error:function()
				  	{
					 	alert("Error al procesar, Intente de nuevo"); 
					 	location.reload();
				  	}
				});
			});
			return false;
		});
	});
</script>