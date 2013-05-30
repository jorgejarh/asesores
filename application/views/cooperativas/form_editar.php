<h3 align="center">Editar Cooperativa</h3>
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
		<td>Nombre de la Cooperativa: </td>
		<td><input value= "<?php echo $dato['cooperativa']; ?>" type="text" id="cooperativa" name="cooperativa" /></td>
	</tr>
	<tr>
		<td colspan="2"><hr></td>
	</tr>
	<tr>
		<td colspan="2" align="center">
			<input type="hidden" value="<?php echo $dato['id_cooperativa']; ?>" name="id_cooperativa" />
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

		
		//$('input[type=submit]').disable();

		$.ajax({
			  url: "<?php echo site_url('cooperativas/editar_cooperativa');?>",
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