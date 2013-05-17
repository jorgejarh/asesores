<h3 align="center">Nuevo Usuario</h3>
<hr>
<?php
echo form_open('',array(
									'id'=>'form_nuevo'
										)
				);
?>

<table>
	<tr>
		<td colspan="2" align="center"><div id="error" style="color:red;"></div></td>
	</tr>
	<tr>
		<td>Nombre Completo: </td>
		<td><input type="text" id="nombre_completo" name="nombre_completo" /></td>
	</tr>
	<tr>
		<td>Telefono: </td>
		<td><input type="text" id="telefono" name="telefono" /></td>
	</tr>
	<tr>
		<td>Celular: </td>
		<td><input type="text" id="telefono" name="celular" /></td>
	</tr>
	<tr>
		<td colspan="2"><hr></td>
	</tr>
	<tr>
		<td>Usuario: </td>
		<td><input type="text" id="usuario" name="usuario" /></td>
	</tr>

	<tr>
		<td>Contraseña: </td>
		<td><input id="clave" name="clave" type="password" /></td>
	</tr>
	<tr>
		<td>Repita Contraseña: </td>
		<td><input id="clave2" type="password" /></td>
	</tr>
	<tr>
		<td colspan="2"><hr></td>
	</tr>
	<tr>
		<td>Rol:</td>
		<td> 
			<?php
			if($roles)
			{
				?>
				<select name="id_rol" id="id_rol" class="cajas_texto" >
					<option value="0">Seleccione...</option>
					<?php
					foreach($roles as $valor)
					{
						?>
						<option value="<?php echo $valor['id_rol'];?>"><?php echo $valor['rol'];?></option>
						<?php
					}
					?>
				</select>
				<?php
			}
			?>
		</td>
	</tr>
	<tr>
		<td>Estado: </td>
		<td>
			Activo <input type="radio" name="estado" value="1" checked /> 
			Inactivo <input type="radio" name="estado" value="0" />
		</td>
	</tr>
	<tr>
		<td colspan="2"><hr></td>
	</tr>
	<tr>
		<td colspan="2" align="center">
			<input type="submit" id="save" value="Guardar" />
		</td>
	</tr>
</table>
<?php
echo form_close();
?>
<script type="text/javascript">
$(document).ready(function(e){


	$('#form_nuevo').submit(function(){

		if($('#nombre_completo').val()=="")
		{
			poner_malo('#nombre_completo');
			$('#error').html('Nombre Completo Requerido');
			return false;
		}else{

			poner_bueno('#nombre_completo');
		}

		if($('#usuario').val()=="")
		{
			poner_malo('#usuario');
			$('#error').html('Usuario Requerido');
			return false;
		}else{

			poner_bueno('#usuario');
		}
		
		if($('#clave').val()=="")
		{
			poner_malo('#clave');
			$('#error').html('Contraseña Requerida');
			return false;
		}else{

			poner_bueno('#clave');
		}

		if($('#clave').val()!=$('#clave2').val())
		{
			poner_malo('#clave');
			poner_malo('#clave2');
			$('#error').html('Contraseñas no Coinciden');
			return false;
		}else{

			poner_bueno('#clave');
			poner_bueno('#clave2');

		}

		if($('#id_rol').val()==0)
		{
			poner_malo('#id_rol');
			$('#error').html('Seleccione un rol');
			return false;
		}else{

			poner_bueno('#id_rol');
		}

		//$('input[type=submit]').disable();

		$.ajax({
			  url: "<?php echo site_url('users/insertar_usuario');?>",
			  type:"POST",
			  data:$(this).serialize(),
			  success:function(data){

			  		if(data=="ok")
			  		{
			  			alert('Usuario guardado correctamente.');
			  			location.reload();
			  		}else{
			  			alert(data);
			  		}
			  		
			  }
		});

		return false;
	});

});


function poner_malo(selector)
{
	$(selector).css('border','1px solid red');
}

function poner_bueno(selector)
{
	$(selector).css('border','1px solid green');
}

</script>