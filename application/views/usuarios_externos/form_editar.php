<h3 align="center">Editar Usuario Externo</h3>
<hr>
<?php
echo form_open('',array(
									'id'=>'form_nuevo'
										),
					array('id'=>$dato['id_usuario'],'user'=>$dato['usuario'])
				);
?>

<table>
	<tr>
		<td>Nombre Completo: </td>
		<td><?php echo form_input('nombre_completo',$dato['nombre_completo'],'class="requerido"');?></td>
	</tr>
	<tr>
		<td>Telefono: </td>
		<td><?php echo form_input('telefono',$dato['telefono'],'class="requerido"');?></td>
	</tr>
	<tr>
		<td>Celular: </td>
		<td><?php echo form_input('celular',$dato['celular'],'class="requerido"');?></td>
	</tr>
	<tr>
		<td>Email</td>
		<td><?php echo form_input('correo',$dato['correo'],'class=""');?></td>
	</tr>
	<tr>
		<td colspan="2"><hr></td>
	</tr>
	<tr>
		<td>Usuario: </td>
		<td><?php echo form_input('usuario',$dato['usuario'],'class="requerido"');?></td>
		
	</tr>

	<tr>
		<td>Contraseña: </td>
		<td><?php echo form_password('clave','','class="requerido"');?></td>
		
	</tr>
	<tr>
		<td>Repita Contraseña: </td>
		<td><?php echo form_password('clave2','','class="requerido"');?></td>
	</tr>
     <tr>
		<td>Exigir Contraseña Nueva: </td>
		<td><?php echo form_checkbox('exigir', '1', $dato['exigir']);?></td>
	</tr>
	<tr>
		<td colspan="2"><hr></td>
	</tr>
	<tr>
		<td>Rol:</td>
		<td> 
			<?php echo form_dropdown('id_subrol',$subroles,$dato['id_subrol'],'id="subrol_"'); ?>
		</td>
	</tr>
	<tr>
		<td>Cooperativa:</td>
		<td> 
			<?php echo form_dropdown('id_cooperativa',$cooperativas,$dato_extra['id_cooperativa'],'id="cooperativa_select"'); ?>
		</td>
	</tr>
	<tr class="sucur_">
		<td>Sucursal:</td>
		<td> 
			<div id="div_result_sucursal">

			</div>
		</td>
	</tr>
	<tr>
		<td>Estado: </td>
		<td>
			Activo <input type="radio" name="estado" value="1" <?php echo ($dato['estado']==1)?'checked':'';?>  /> 
			Inactivo <input type="radio" name="estado" value="0" <?php echo ($dato['estado']==0)?'checked':'';?>  />
		</td>
	</tr>

	<tr>
		<td colspan="2"><hr></td>
	</tr>
	<tr>
		<td colspan="2" align="center"><div id="div_error" ></div></td>
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

	$('#subrol_').change(function(){
		
			if($(this).val()==2)
			{
				$('.sucur_').hide();
				$('select[name=id_sucursal]').val(0);
			}else{
				$('.sucur_').show();
				
				}
		});
	$('#subrol_').change();


	$('#form_nuevo').submit(function(){

		form=$(this);

		form.fadeOut('fast',function(){

			$('.cargando_').fadeIn('fast');

			$.ajax({
				  url: "<?php echo site_url($this->nombre_controlador.'/actualizar');?>",
				  type:"POST",
				  dataType:"json",
				  data:$(this).serialize(),
				  success:function(data){

				  		if(data.error)
				  		{
				  			$('#div_error').html(data.mensaje);
				  			$('.cargando_').fadeOut('fast');
				  			form.fadeIn('fast');
				  		}else{

				  			//$.fancybox(data.mensaje);

				  			location.reload();
				  		}
				  		
				  }
			});

		});

		return false;
	});

	$('#cooperativa_select').change(function(event){

		$('#div_result_sucursal').fadeOut('fast');
		$.ajax({
				  url: "<?php echo site_url($this->nombre_controlador.'/select_sucursal/'.$dato_extra['id_sucursal']);?>",
				  type:"POST",
				  dataType:"json",
				  data:{id:$(this).val()},
				  success:function(data){

				  		$('#div_result_sucursal').html(data.html);
				  		$('#div_result_sucursal').fadeIn('fast');
				  		
				  }
			});


	});

	$('#cooperativa_select').change();

});


</script>