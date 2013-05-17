<h3 align="center"><?php echo $tipo_contenido['nombre_contenido'];?></h3>
<hr>
<?php
echo form_open('',array(
						'id'=>'form_nuevo'
							)
				);
?>

<table align="center" width="350">
	<tr>
		<td colspan="2" align="center"><div id="error" style="color:red;"></div></td>
	</tr>
	<tr>
		<td align="center" valign="middle"><input type="text" id="nombre" name="nombre" style="width:80%;" /></td>
	</tr>
	<tr>
		<td colspan="2"><hr></td>
	</tr>
	<tr>
		<td align="center">
        	<input type="hidden" name="tabla" value="<?php echo $tipo_contenido['nombre_tabla'];?>"  />
            <input type="hidden" name="id_perfil" value="<?php echo $id_perfil;?>"  />
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
				
		if($('#nombre').val()=="")
		{
			poner_malo('#nombre');
			$('#error').html('Campo Requerido');
			return false;
		}else{

			poner_bueno('#nombre');
		}

		

		//$('input[type=submit]').disable();

		$.ajax({
			  url: "<?php echo site_url('perfiles/insertar_contenido');?>",
			  type:"POST",
			  data:$(this).serialize(),
			  success:function(data){
					
			  		if(data=="ok")
			  		{
			  			alert('Registro guardado correctamente.');
			  			/*location.reload();*/
						actualizar(<?php echo $tipo_contenido['id_tabla_contenido'];?>,<?php echo $id_perfil;?>);
						$.fancybox.close();
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