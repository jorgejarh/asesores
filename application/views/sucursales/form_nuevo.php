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
		<td valign="middle">Cooperativa: </td>
		<td valign="middle">
        <select id="id_cooperativa" name="id_cooperativa">
        	<option value="0">Seleccione...</option>
            <?php
            if($cooperativas)
			{
				foreach($cooperativas as $valor)
				{
					?>
                    <option value="<?php echo $valor['id_cooperativa'];?>"><?php echo $valor['cooperativa'];?></option>
                    <?php
				}
			}
			?>
        </select>
        </td>
	</tr>
	<tr>
		<td valign="middle">Nombre de la sucursal: </td>
		<td valign="middle"><input type="text" id="sucursal" name="sucursal" /></td>
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
		
		if($('#id_cooperativa').val()==0)
		{
			poner_malo('#id_cooperativa');
			$('#error').html('Campo Requerido');
			return false;
		}else{

			poner_bueno('#id_cooperativa');
		}
		
		if($('#sucursal').val()=="")
		{
			poner_malo('#sucursal');
			$('#error').html('Campo Requerido');
			return false;
		}else{

			poner_bueno('#sucursal');
		}

		

		//$('input[type=submit]').disable();

		$.ajax({
			  url: "<?php echo site_url('sucursales/insertar_sucursal');?>",
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