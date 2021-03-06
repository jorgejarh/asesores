<h3 align="center"><?php echo $title;?></h3>
<hr>
<?php
echo form_open('',array(
							'id'=>'form_nuevo'
								),
					array('id'=>$dato[$this->$model->id_tabla])
				);
?>

<table align="center" style="margin:auto;  width:400px;">
	
    <tr>
		<td>DUI: </td>
		<td><?php 
			echo form_input("dui",$dato['dui']);
			?><button onclick="buscar_persona();">Buscar</button></td>
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
				echo form_input($valor['nombre_campo'], $dato[$valor['nombre_campo']]);
				break;
			
			case 'select':
				echo form_dropdown($valor['nombre_campo'],$valor['datos_select'],$dato[$valor['nombre_campo']]);
				break;
			case 'textarea':
					echo form_textarea($valor['nombre_campo'],$dato[$valor['nombre_campo']]);
					break;
			case 'multi_select':
					echo form_multiselect($valor['nombre_campo'],$valor['datos_select'],$dato[$valor['nombre_campo']]);
					break;
		}
		
		?> </td>
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


function buscar_persona()
{
	event.preventDefault();
	
	$.ajax({
		  url: "<?php echo site_url($this->nombre_controlador.'/buscar_persona');?>",
		  type:"POST",
		  dataType:"json",
		  data:$('#form_nuevo').serialize(),
		  success:function(data){
			  
			  	if(data.dato)
				{
					$('input[name=dui]').val(data.dui);
					$('input[name=nombres]').val(data.nombres);
					$('input[name=apellidos]').val(data.apellidos);
					$('select[name=id_sucursal]').val(data.id_sucursal);
					$('select[name=id_cargo]').val(data.id_cargo);
					
				}else{
					alert("Persona No encontrada");
					}
				
		  },
		   error:function()
		  {
			 alert("Error al procesar, Intente de nuevo"); 
		  }
	});
	return false;
}



</script>