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
    <td colspan="2"><div class="accordion">
        <?php
					if($menus)
					{
						$activo=false;
						foreach($menus as $valor1)
						{
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
        <div class="div_a" style="display:none;">
          <?php
								foreach ($valor1['submenu'] as $valor2) 
								{
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
										?>
                                        <div class="sub_m">
                                        <?php
										foreach($valor2['submenu'] as $valor3)
										{

											$data3 = array(
											'name' => 'permisos[]',
											'id' => $valor1['id_menu'].'_'.$valor2['id_menu'].'_'.$valor3['id_menu'],
											'value' => $valor3['id_menu'],
											'checked' => $activo,
											'class'=>'check'
											);

											echo '<h4 style="margin-left:30px; font-weight:normal;">'.form_checkbox($data3)." ".$valor3['nombre_menu'].'</h4>';
	
										}
										?>
                                    </div>
                                    <?php
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
          <td><?php
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
							
							?></td>
          <?php
							
						}
					}
					?>
          <td></td>
        </tr>
      </table>-->
      
      </td>
  </tr>
  <tr>
    <td colspan="2"><hr></td>
  </tr>
  <tr>
    <td colspan="2" align="center"><input type="hidden" name="estado" value="1" />
      <input type="submit" id="save" value="Guardar" /></td>
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
	
	
	
	
	$('.check').click(function(e) {
        
		var check_padre=0;
		$(this).parent('h4').parent('.sub_m').find('input[type=checkbox]').each(function(index, element) {
            
			if($(this).is(':checked'))
			{
				check_padre=check_padre+1;
			}
			
			//$(this).css('border','red 1px solid');
        });
		
		//alert(check_padre);
		if(check_padre==0)
		{
			$(this).parent('h4').parent('.sub_m').prev('h4').children('input[type=checkbox]').removeAttr("checked");
			$(this).parent('h4').parent('.sub_m').parent('.div_a').prev('h3').children('input[type=checkbox]').removeAttr("checked");
			
		}else{
			$(this).parent('h4').parent('.sub_m').prev('h4').children('input[type=checkbox]').prop("checked","checked");
			$(this).parent('h4').parent('.sub_m').parent('.div_a').prev('h3').children('input[type=checkbox]').prop("checked","checked");
			}
		
		// para los hijos
		
		if($(this).is(':checked'))
		{
			$(this).parent().next('div').find('.check').prop("checked","checked");
		}else{
			$(this).parent().next('div').find('.check').removeAttr("checked");
			}
		
		
		
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
	 /*
	var determinar_parentesco = function( id_array ){
		var longitud   = id_array.length;
		var parentesco = new Array();

		parentesco[1] = 'abuelo';
		parentesco[2] = 'padre';
		parentesco[3] = 'hijo';

		return parentesco[longitud];
	}
	*/
	/* ********************************************** funciones para seleccionar padres ***************************************************** */



$(document).ready(function(){
  $(".accordion h3:first").addClass("active");
  $(".accordion div.div_a:not(:first)").hide();
  $(".accordion h3").click(function(){
	  
    $(this).next("div.div_a").slideToggle("slow")
    .siblings("div.div_a:visible").slideUp("slow");
    $(this).toggleClass("active");
    $(this).siblings("h3").removeClass("active");
	//$(this).find('input[type=checkbox]').click();
  });

});


</script>