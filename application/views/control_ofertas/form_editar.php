<h3 align="center"><?php echo $title;?></h3>
<hr>
<?php
echo form_open('',array(
									'id'=>'form_nuevo'
										),
					array('id'=>$dato[$this->$model->id_tabla])
				);
?>

<table align="center" style="margin:auto;">


	<?php
	foreach($this->campos as $llave=>$valor)
	{
		?>
	<tr>
		<td><?php echo $valor['nombre_mostrar']; ?>: </td>
		<td>
			<?php
			switch ($valor['tipo_elemento']) {
			 	case 'text':
			 		echo form_input($valor['nombre_campo'], $dato[$valor['nombre_campo']] );
			 		break;
			 	case 'textarea':
			 		echo form_textarea($valor['nombre_campo'], $dato[$valor['nombre_campo']]);
			 		break;
			 	case 'select':
			 		
					echo form_dropdown($valor['nombre_campo'], $valor['datos_select'], $dato[$valor['nombre_campo']] );

			 		break;
			 } 
				
			?> 
		</td>
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
<script type="text/javascript">
$(document).ready(function(e){
		
		$(this).val(<?php echo $dato['id_plan'];?>);
		
		$( "input[name=fecha_inicio]" ).datepicker({
		dateFormat: "yy-mm-dd",
		changeMonth: true,
      changeYear: true
		});
	
	$( "input[name=fecha_fin]" ).datepicker({
			dateFormat: "yy-mm-dd",
			changeMonth: true,
		  changeYear: true
			});
	
	$( "input[name=fecha_aceptada]" ).datepicker({
			dateFormat: "yy-mm-dd",
			changeMonth: true,
		  changeYear: true
			});
			
	$( "input[name=fecha_envio_solicitante]" ).datepicker({
			dateFormat: "yy-mm-dd",
			changeMonth: true,
		  changeYear: true
			});
	$( "input[name=fecha_entrega]" ).datepicker({
			dateFormat: "yy-mm-dd",
			changeMonth: true,
		  changeYear: true
			});
	
	
	
	$('select[name=id_plan]').change(function(e) {
		
		
        $.ajax({
				  url: "<?php echo site_url($this->nombre_controlador.'/modalidades');?>",
				  type:"POST",
				 
				  data:{id:$(this).val()},
				  success:function(data){
					  
					   $('select[name=id_modalidad]').html("");
					  $('select[name=id_modalidad]').html(data);
					   $('select[name=id_modalidad]').val(<?php echo $dato['id_modalidad'];?>);
					  $('select[name=id_modalidad]').change();
					  
				  }
			});
    });
	
	
	$('select[name=id_modalidad]').change(function(e) {
		
        $.ajax({
				  url: "<?php echo site_url($this->nombre_controlador.'/capacitaciones');?>",
				  type:"POST",
				 
				  data:{id:$(this).val()},
				  success:function(data){
					  
					   $('select[name=id_capacitacion]').html("");
					  $('select[name=id_capacitacion]').html(data)
					  $('select[name=id_capacitacion]').val(<?php echo $dato['id_capacitacion'];?>);
				  		
				  }
			});
    });
	
	
	$('select[name=id_plan]').change();

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

});


</script>