<h3 align="center">Nuevo Perfil</h3>
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
	<input type="hidden" value="<?php echo $id_curricula; ?>" name="id_curricula">
	<tr>
		<td valign="middle">Nombre del perfil: </td>
		<td valign="middle">
        <?php
        echo form_dropdown('id_cargo', $cargos);
		?>
        </td>
	</tr>
    <tr>
		<td valign="middle">Fecha: </td>
		<td valign="middle"><input type="date" id="fecha" name="fecha" value="<?php echo date('Y-m-d'); ?>"/></td>
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
<div class="cargando_">

</div>
<script type="text/javascript">
$(document).ready(function(e){


	$('#form_nuevo').submit(function(){


		valido=validar_form("#"+$(this).attr('id'));
		
		
		if(valido==false)
		{
			return false;
		}

		form=$(this);
		
		form.fadeOut('fast',function(){
			
			
			$('.cargando_').fadeIn('fast');

				$.ajax({
					  url: "<?php echo site_url('perfiles/insertar_perfil');?>",
					  type:"POST",
					  data:$(this).serialize(),
					  success:function(data){
		
							if(data=="ok")
							{
								alert('Registro guardado correctamente.');
								location.reload();
							}else{
								$('.cargando_').fadeOut('fast');
								form.fadeIn('fast');	
								alert(data);
							}
							
					  }
				});
			
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