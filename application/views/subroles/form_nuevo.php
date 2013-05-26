<h3 align="center">Nuevo Rol</h3>
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
		<td>Rol: </td>
		<td><?php echo form_dropdown('id_rol',$roles);?></td>
	</tr>
	<tr>
		<td>Sub Rol: </td>
        <td><?php echo form_input('subrol', '','class="requerido"');?></td>
	</tr>
	<tr>
		<td colspan="2"><hr></td>
	</tr>
    <tr>
		<td colspan="2"><h3>Permisos</h3></td>
	</tr>
	<tr>
		<td colspan="2">
			<table>
            	<tr>
                	<?php
					if($menus)
					{
						$activo=false;
						foreach($menus as $valor1)
						{
							?>
                            <td>
                            <?php
							echo "<h4>".form_checkbox('permisos[]',$valor1['id_menu'],$activo)." ".$valor1['nombre_menu']."</h4>";
							if($valor1['submenu'])
							{
								
								foreach ($valor1['submenu'] as $valor2) 
								{
									echo '<h4 style="margin-left:15px; font-weight:normal;">'.form_checkbox('permisos[]',$valor2['id_menu'],$activo)." ".$valor2['nombre_menu'].'</h4>';
									if($valor2['submenu'])
									{
										
										foreach($valor2['submenu'] as $valor3)
										{
											echo '<h4 style="margin-left:30px; font-weight:normal;">'.form_checkbox('permisos[]',$valor3['id_menu'],$activo)." ".$valor3['nombre_menu'].'</h4>';
	
										}
									}
								}
							}
							
							?>
                            </td>
                            <?php
							
						}
					}
					?>
                	<td></td>
                </tr>
            </table>
				
				
			
		</td>
	</tr>
    <tr>
		<td colspan="2"><hr></td>
	</tr>
	<tr>
		<td colspan="2" align="center">
        	<input type="hidden" name="estado" value="1" />
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
			  url: "<?php echo site_url('subroles/insertar');?>",
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