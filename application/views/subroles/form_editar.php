<h3 align="center">Editar Rol</h3>
<hr>
<?php
echo form_open('',array(
						'id'=>'form_nuevo'
							),
					array('id'=>$dato['id_subrol'])
				);
?>

<table>
	<tr>
		<td colspan="2" align="center"><div id="error" style="color:red;"></div></td>
	</tr>
    <tr>
		<td>Rol: </td>
		<td><?php echo form_dropdown('id_rol',$roles,$dato['id_rol']);?></td>
	</tr>
	<tr>
		<td>Sub Rol: </td>
        <td><?php echo form_input('subrol', $dato['subrol'],'class="requerido"');?></td>
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

		valido=validar_form("#"+$(this).attr('id'));
		
		
		if(valido==false)
		{
			return false;
		}
		
		//$('input[type=submit]').disable();

		$.ajax({
			  url: "<?php echo site_url('subroles/actualizar');?>",
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

</script>