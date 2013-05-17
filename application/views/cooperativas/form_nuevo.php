<h3 align="center">Nueva Cooperativa</h3>
<hr>
<?php
echo form_open_multipart('cooperativas/do_upload',array(
						'id'=>'form_nuevo'
							)
				);
?>

<table>
	<tr>
		<td colspan="2" align="center"><div id="error" style="color:red;"></div></td>
	</tr>
	<tr>
		<td valign="middle">Logo: </td>
		<td valign="middle"><input type="file" name="logotipo" size="25" /></td>
	</tr>
	<tr>
		<td valign="middle">Nombre Cooperativa: </td>
		<td valign="middle"><input type="text" id="cooperativa" name="cooperativa"  size="30" /></td>
	</tr>
	<tr>
		<td valign="middle">Ubicaci&oacute;n: </td>
		<td valign="middle"><textarea id="ubicacion" name="ubicacion" cols="25" rows="5" /></td>
	</tr>
	<tr>
		<td valign="middle">Tel&eacute;fono: </td>
		<td valign="middle"><input type="text" id="telefono" name="telefono"  size="30" /></td>
	</tr>
	<tr>
		<td valign="middle">Fax: </td>
		<td valign="middle"><input type="text" id="fax" name="fax"  size="30" /></td>
	</tr>
	<tr>
		<td valign="middle">Correo Electr&oacute;nico: </td>
		<td valign="middle"><input type="mail" id="email" name="email"  size="30" /></td>
	</tr>
	<tr>
		<td valign="middle">Cr&eacute;dito Fiscal: </td>
		<td valign="middle"><input type="text" id="credito_fiscal" name="credito_fiscal"  size="30" /></td>
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

		if($('#cooperativa').val()=="")
		{
			poner_malo('#cooperativa');
			$('#error').html('Campo Requerido');
			return false;
		}else{

			poner_bueno('#cooperativa');
		}
		if($('#credito_fiscal').val()=="")
		{
			poner_malo('#credito_fiscal');
			$('#error').html('Campo Requerido');
			return false;
		}else{

			poner_bueno('#credito_fiscal');
		}

		//$('input[type=submit]').disable();

		$.ajax({
			  url: "<?php echo site_url('cooperativas/insertar_cooperativa');?>",
			  type:"POST",
			  data:$(this).serialize(),
			  success:function(data){

			  		if(data=="ok")
			  		{
			  			alert('Registro guardado correctamente.');
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