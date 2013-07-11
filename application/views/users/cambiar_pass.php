<h3 align="center"><?php echo $title;?></h3>

<hr>

<?php 
	$attributes = array('id'=>'cambiar_pass');
	$hidden     = array('id_usuario' => $id_usuario);
?>

<?php echo form_open( '', $attributes, $hidden ); ?>

<table align="center" style="margin:auto;">
	<tr>
		<td>contraseña:</td>
		<td><input type="password" name="clave"></td>
	</tr>
	<tr>
		<td>confirme contraseña:</td>
		<td><input type="password" name="confirma_clave"></td>
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
				  	url: "<?php echo site_url('users/cambiar_pass');?>",
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