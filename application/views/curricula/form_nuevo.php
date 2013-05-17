<h3 align="center">Nueva Cooperativa</h3>
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
		<td valign="middle">Nombre de la Curricula: </td>
		<td valign="middle"><input type="text" id="curricula" name="curricula" /></td>
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

		if($('#curricula').val()=="")
		{
			poner_malo('#curricula');
			$('#error').html('Campo Requerido');
			return false;
		}else{

			poner_bueno('#curricula');
		}

		

		//$('input[type=submit]').disable();

		$.ajax({
			  url: "<?php echo site_url('curriculas/insertar_curricula');?>",
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