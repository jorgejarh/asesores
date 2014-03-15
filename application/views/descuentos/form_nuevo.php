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

<table align="center" style="margin:auto;">
	<?php
	foreach($this->campos as $llave=>$valor)
	{
		?>
	<tr>
		<td><?php echo $valor['nombre_mostrar']; ?>: </td>
		<td>
			<?php
			switch ($valor['tipo_input']) 
			{
			 	case 'text':
			 		echo form_input($valor['nombre_campo'], set_value($valor['nombre_campo']));
			 		break;
			 	
			 	case 'select':
					echo form_dropdown($valor['nombre_campo'], $valor['datos_select'], '0');
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
	
	$("select[name=id_cooperativa]").change(function(e) {
        
		var id_cooperativa=$(this).val();
		
		$.ajax({
				  url: "<?php echo site_url($this->nombre_controlador.'/obtener_inscripciones');?>",
				  type:"POST",
				  dataType:"json",
				  data:{'id_cooperativa':id_cooperativa},
				  success:function(data){
					  $("select[name=id_inscripcion_tema]").html("");
					  $.each(data,function(index,elemento){
						  
						  $("select[name=id_inscripcion_tema]").append(obtener_opcion(elemento.id_inscripcion_tema,elemento.nombre_capacitacion));
						  //alert(elemento.nombre_capacitacion);
						  });
					  
				  			//$("input[name=id_inscripcion_tema]").html(data);			  		
				  },
				   error:function()
				  {
					 alert("Error al procesar, Intente de nuevo"); 
					 location.reload();
				  }
			});
		
    });
	
	
	$("select[name=id_cooperativa]").change();
});

function obtener_opcion(id,nombre)
{
	return '<option value="'+id+'">'+nombre+'</option>'
}

</script>