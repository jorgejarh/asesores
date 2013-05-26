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
						$activo=$this->conf_menu_model->existe_permiso($permisos,$valor1['id_menu']);

						echo "<h4>".form_checkbox('permisos[]',$valor1['id_menu'],$activo)." ".$valor1['nombre_menu']."</h4>";
						if($valor1['submenu'])
						{
							
							foreach ($valor1['submenu'] as $valor2) 
							{
								$activo=$this->conf_menu_model->existe_permiso($permisos,$valor2['id_menu']);
								echo '<h4 style="margin-left:15px; font-weight:normal;">'.form_checkbox('permisos[]',$valor2['id_menu'],$activo)." ".$valor2['nombre_menu'].'</h4>';
								if($valor2['submenu'])
								{
									
									foreach($valor2['submenu'] as $valor3)
									{
										$activo=$this->conf_menu_model->existe_permiso($permisos,$valor3['id_menu']);
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
				
				</tr>
            </table>
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