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
		<td>Menu Padre: </td>
		<td><?php echo form_dropdown('id_padre',$menus);?></td>
	</tr>
	<tr>
		<td>Nombre del menu: </td>
        <td><?php echo form_input('nombre_menu','','class="requerido"');?></td>
	</tr>
    <tr>
		<td>Url: </td>
		<td><?php echo form_input('url', '','class=""');?></td>
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

		valido=0;
		
		$('.requerido').each(function(index,element){
				
				if($(this).val()=="")
				{
					poner_malo_texto($(this));
					$('#error').html('Campo Requerido');
					valido=1;
				}else{
		
					poner_bueno_texto($(this));
				}
				
			});
		
		if(valido==1)
		{
			return false;
		}

		//$('input[type=submit]').disable();

		$.ajax({
			  url: "<?php echo site_url('conf_menu/insertar_datos');?>",
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


</script>