<h3 align="center">Editar Perfil</h3>
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
		<td valign="middle">Nombre del perfil: </td>
		<td valign="middle">
         <?php
        echo form_dropdown('id_cargo', $cargos,$dato['id_cargo']);
		?>
        </td>
	</tr>
    <tr>
		<td valign="middle">Fecha: </td>
		<td valign="middle"><input type="date" id="fecha" name="fecha" value="<?php echo $dato['fecha'];?>" /></td>
	</tr>
	<tr>
		<td colspan="2"><hr></td>
	</tr>
	<tr>
		<td colspan="2" align="center">
			<input type="hidden" value="<?php echo $dato['id_perfil']; ?>" name="id_perfil" />
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

		valido=validar_form("#"+$(this).attr('id'));
		
		
		if(valido==false)
		{
			return false;
		}

		/*if($('#id_curricula').val()==0)
		{
			poner_malo('#id_curricula');
			$('#error').html('Campo Requerido');
			return false;
		}else{

			poner_bueno('#id_curricula');
		}
	
		if($('#perfil').val()=="")
		{
			poner_malo('#perfil');
			$('#error').html('Campo Requerido');
			return false;
		}else{

			poner_bueno('#perfil');
		}*/
		
		//$('input[type=submit]').disable();

		$.ajax({
			  url: "<?php echo site_url('perfiles/editar_perfil');?>",
			  type:"POST",
			  data:$(this).serialize(),
			  success:function(data){

			  		if(data=="ok")
			  		{
			  			alert('Registro actualizado correctamente.');
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