<h3 align="center"><?php echo $title;?></h3>
<hr>
<?php echo form_open('', array('id'=>'form_nuevo') ); ?>

<table align="center" style="margin:auto;">

	<tr>
		<td>Seleccione una cooperativa:</td>
		<td> 
			<?php $cooperativas['']="-Seleccione-"; ksort($cooperativas); echo form_dropdown('id_cooperativa',$cooperativas,'','id="cooperativas_select"'); ?>
		</td>
	</tr>

	<tr>
		<td>Seleccione un Tema:</td>
		<td><div id="div_result_temas"></div></td>
	</tr>

	<tr>
		<td>Abono: </td>
		<td><?php echo form_input('abono', set_value( 'abono' )); ?> </td>
	</tr>
			
	<tr>
		<td colspan="2"><hr></td>
	</tr>

	<tr>
		<td colspan="2" align="center"><div id="div_error" ></div></td>
	</tr>

	<tr>
		<td colspan="2" align="center"><input type="submit" id="save" value="Guardar" /></td>
	</tr>

</table>
<?php echo form_close(); ?>

<div class="cargando_">
</div>

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

	/* ******************************************************************************************* */

	$('#cooperativas_select').change(function(event){

		$('#div_result_temas').fadeOut('fast');
		$.ajax({
				  url: "<?php echo site_url($this->nombre_controlador.'/select_cooperativas');?>",
				  type:"POST",
				  dataType:"json",
				  data:{id:$(this).val()},
				  success:function(data){

				  		$('#div_result_temas').html(data.html);
				  		$('#div_result_temas').fadeIn('fast');
						
						//$('#select_modalidades').change();
				  		
				  }
			});

	});
	/* ******************************************************************************************* */

	$('#cooperativas_select').change();

});


</script>