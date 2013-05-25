<h3 align="center">Editar Menu</h3>
<hr>
<?php
echo form_open('',array(
						'id'=>'form_nuevo'
							),
					array('id'=>$dato['id_menu'])
				);
?>

<table>
	<tr>
		<td colspan="2" align="center"><div id="error" style="color:red;"></div></td>
	</tr>
    <tr>
		<td>Menu Padre: </td>
		<td><?php echo form_dropdown('id_padre',$menus,$dato['id_padre']);?></td>
	</tr>
	<tr>
		<td>Nombre del menu: </td>
        <td><?php echo form_input('nombre_menu', $dato['nombre_menu'],'class="requerido"');?></td>
	</tr>
    <tr>
		<td>Url: </td>
		<td><?php echo form_input('url', $dato['url'],'class=""');?></td>
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
			  url: "<?php echo site_url('conf_menu/editar_datos');?>",
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