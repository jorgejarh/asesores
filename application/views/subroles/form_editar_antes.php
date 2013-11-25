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
        <div class="accordion">
        	<?php
				if($menus)
				{
					$activo=false;
					foreach($menus as $valor1)
					{
						
						$activo=$this->conf_menu_model->existe_permiso($permisos,$valor1['id_menu']);

						$data1 = array(
							'name' => 'permisos[]',
							'id' => $valor1['id_menu'],
							'value' => $valor1['id_menu'],
							'checked' => $activo,
							'class'=>'check'
							);


						echo '<h3 style="cursor:pointer;">'.form_checkbox($data1)." ".$valor1['nombre_menu']."</h3>";
						if($valor1['submenu'])
						{
							?>
                            <div style="display:none;">
                            <?php
							foreach ($valor1['submenu'] as $valor2) 
							{
								$activo=$this->conf_menu_model->existe_permiso($permisos,$valor2['id_menu']);

								$data2 = array(
									'name' => 'permisos[]',
									'id' => $valor1['id_menu'].'_'.$valor2['id_menu'],
									'value' => $valor2['id_menu'],
									'checked' => $activo,
									'class'=>'check'
									);

								echo '<h4 style="margin-left:15px; font-weight:normal;">'.form_checkbox($data2)." ".$valor2['nombre_menu'].'</h4>';
								if($valor2['submenu'])
								{
									
									foreach($valor2['submenu'] as $valor3)
									{
										$activo=$this->conf_menu_model->existe_permiso($permisos,$valor3['id_menu']);

										$data3 = array(
											'name' => 'permisos[]',
											'id' => $valor1['id_menu'].'_'.$valor2['id_menu'].'_'.$valor3['id_menu'],
											'value' => $valor3['id_menu'],
											'checked' => $activo,
											'class'=>'check'
											);

										echo '<h4 style="margin-left:30px; font-weight:normal;">'.form_checkbox($data3)." ".$valor3['nombre_menu'].'</h4>';

									}
								}
							}
							?>
                            </div>
                            <?php
						}
						
					}
				}
				?>
        </div>
			<!--<table>
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
            </table>-->
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

	
	
	
	$('.check').click(function(e) {
        
		alert("321");
    });
	
	
	
	
});



	/* ********************************************** funciones para seleccionar padres ***************************************************** */
	/**
	 * Selecciona a todos los ansestros
	 */
	 
	 /*
	$( "input[type=checkbox]" ).click(function(){
		var id         = $(this).attr('id');
		var id_array   = id.split("_");
		var parentesco = determinar_parentesco( id_array );

		if( parentesco == 'hijo' ){

			$('#'+id_array[0]+'_'+id_array[1]).attr('checked', true);
			$('#'+id_array[0]).attr('checked', true);

		}else if( parentesco == 'padre' ){

			$('#'+id_array[0]).attr('checked', true);
		}
	});
	*/
	
	/* ****************************************************** */
	/**
	 * Devuelve el parentesco
	 */
	 
	 
	/*var determinar_parentesco = function( id_array ){
		var longitud   = id_array.length;
		var parentesco = new Array();

		parentesco[1] = 'abuelo';
		parentesco[2] = 'padre';
		parentesco[3] = 'hijo';

		return parentesco[longitud];
	}*/
	/* ********************************************** funciones para seleccionar padres ***************************************************** */



$(document).ready(function(){
  $(".accordion h3:first").addClass("active");
  $(".accordion div:not(:first)").hide();
  $(".accordion h3").click(function(){
	  
    $(this).next("div").slideToggle("slow")
    .siblings("div:visible").slideUp("slow");
    $(this).toggleClass("active");
    $(this).siblings("h3").removeClass("active");
	//$(this).find('input[type=checkbox]').click();
  });

});

</script>