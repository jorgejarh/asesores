<h3 align="center"><?php echo $title;?></h3>
<hr>
<?php
echo form_open('',array(
					'id'=>'form_nuevo'
						),
					array(
					
						)
				);
?>

<table align="center" style="margin:auto; width:400px;">

	<tr>
		<td>Seleccione un plan:</td>
		<td> 
			<?php $planes[0]="-Seleccione-"; ksort($planes); echo form_dropdown('',$planes,'','id="planes_select"'); ?>
		</td>
	</tr>
	<tr >
		<td>Seleccione una modalidad:</td>
		<td> 
			<div id="div_result_modalidades">

			</div>
		</td>
	</tr>
    <tr >
		<td>Seleccione el tema a inscribir:</td>
		<td> 
			<div id="div_result_capacitaciones">

			</div>
		</td>
	</tr>
	
	<?php
	foreach($this->campos as $llave=>$valor)
	{
		?>
	<tr>
		<td><?php echo $valor['nombre_mostrar']; ?>: </td>
		<td><?php 
			switch($valor['tipo_elemento'])
			{
				case 'text':
					echo form_input($valor['nombre_campo'], set_value($valor['nombre_campo']));
					break;
				
				case 'select':
					echo form_dropdown($valor['nombre_campo'],$valor['datos_select']);
					break;
				case 'textarea':
					echo form_textarea($valor['nombre_campo'],'');
					break;
				case 'multi_select':
					echo form_multiselect($valor['nombre_campo'],$valor['datos_select']);
					break;
			}
			
			?></td>
	</tr>
		<?php
	}
	?>
	
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

<style type="text/css">
.conte_f
{
	position:relative;
}
.conte_f
{
	position:absolute;
	left:0px;
	top:0px;
}
</style>

<script type="text/javascript">
$(document).ready(function(e){
		
	

	$('#form_nuevo').submit(function(){

		form=$(this);

		form.fadeOut('fast',function(){

			$('.cargando_').fadeIn('fast');

			$.ajax({
				  url: "<?php echo site_url($this->nombre_controlador.'/insertar');?>",
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
				  		
				  },
				   error:function()
				  {
					 alert("Error al procesar, Intente de nuevo"); 
					 location.reload();
				  }
			});

		});

		return false;
	});
	
	
	$('#planes_select').change(function(event){

		$('#div_result_modalidades').fadeOut('fast');
		$.ajax({
				  url: "<?php echo site_url($this->nombre_controlador.'/select_planes');?>",
				  type:"POST",
				  dataType:"json",
				  data:{id:$(this).val()},
				  success:function(data){

				  		$('#div_result_modalidades').html(data.html);
				  		$('#div_result_modalidades').fadeIn('fast');
						
						$('#select_modalidades').change();
				  		
				  }
			});

	});
	
	$('#select_modalidades').live('change',function(event){

		$('#div_result_capacitaciones').fadeOut('fast');
		$.ajax({
				  url: "<?php echo site_url($this->nombre_controlador.'/select_modalidades');?>",
				  type:"POST",
				  dataType:"json",
				  data:{id:$(this).val()},
				  success:function(data){

				  		$('#div_result_capacitaciones').html(data.html);
				  		$('#div_result_capacitaciones').fadeIn('fast');
				  		
				  }
			});

	});
	
	$('#planes_select').change();
});


</script>