<h3 align="center"><?php echo $title;?></h3>
<hr>
<?php
echo form_open('',array(
					'id'=>'form_nuevo'
						),
					array(
					'id_capacitacion'=>$id,
					'tipo_persona'=>'A'
						)
				);
?>

<table align="center" style="margin:auto;">
	<tr>
		<td>DUI / Identificación: </td>
		<td><?php 
			echo form_input("dui");
			?><button class="bus" onclick="buscar_persona();">Buscar</button></td>
	</tr>
	<?php
	foreach($this->campos as $llave=>$valor)
	{
		?>
	<tr class="<?php echo ($valor['nombre_campo']=='id_cooperativa' || $valor['nombre_campo']=='id_sucursal')?'no_afi':'';?>">
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
<script type="text/javascript">
$(document).ready(function(e){


	$('#form_nuevo').submit(function(){

		form=$(this);

		form.fadeOut('fast',function(){

			$('.cargando_').fadeIn('fast');

			$.ajax({
				  url: "<?php echo site_url($this->nombre_controlador.'/insertar/'.$id_modulo);?>",
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
							$('.cargando_').fadeOut('fast');
							crear_tr(data.datos.apellidos, data.datos.nombres, data.datos.id_asistencia, data.datos.nombre_cooperativa, data.datos.nombre_sucursal, data.datos.nombre_cargo);
							$('.form_user').hide();
				  			//$.fancybox(data.mensaje);

				  			//location.reload();
							location.reload();
				  		}
				  		
				  },
				   error:function()
				  {
					 alert("Error al procesar, Intente de nuevo"); 
					 //location.reload();
				  }
			});

		});

		return false;
	});
	
	$('select[name=id_cooperativa]').change(function(e) {
        
		
		id_cooperativa=$(this).val();
		
		$.ajax({
				  url: "<?php echo site_url($this->nombre_controlador.'/sucursales');?>/"+id_cooperativa,
				  type:"POST",
				  dataType:"html",
				  data:$(this).serialize(),
				  success:function(data){

				  		$('select[name=id_sucursal]').html(data);
						
				  },
				   error:function()
				  {
					 alert("Error al procesar, Intente de nuevo"); 
					 location.reload();
				  }
			});
		
    });
	$('input[name=nombres]').attr('readonly', true);
	$('input[name=apellidos]').attr('readonly', true);
	$('select[name=id_cooperativa]').attr('readonly', true);
	$('select[name=id_sucursal]').attr('readonly', true);
	$('select[name=id_cargo]').attr('readonly', true);
	$('input[name=correo]').attr('readonly', true);
	

});


function buscar_persona()
{
	event.preventDefault();
	var bot=$('.bus');
	bot.html("Buscando...");
	$.ajax({
		  url: "<?php echo site_url('inscripcion_temas_personas/buscar_persona');?>",
		  type:"POST",
		  dataType:"json",
		  data:$('#form_nuevo').serialize(),
		  success:function(data){
				bot.html("Buscar");
			  	if(data.dato)
				{
					$('input[name=dui]').val(data.dui);
					$('input[name=nombres]').val(data.nombres);
					$('input[name=apellidos]').val(data.apellidos);
					$('select[name=id_cooperativa]').val(data.id_cooperativa);
					$('select[name=id_cooperativa]').change();
					$('select[name=id_sucursal]').val(data.id_sucursal);
					setTimeout("$('select[name=id_sucursal]').val("+data.id_sucursal+");",3000);
					//setTimeout("alert('"+data.id_sucursal+"');",3000);
					//$('select[name=id_sucursal]').change();
					$('select[name=id_cargo]').val(data.id_cargo);
					$('input[name=correo]').val(data.correo);
					$('input[name=tipo_persona]').val(data.tipo_persona);
					
					if(data.tipo_persona=="A")
					{
						$('.no_afi').show();
						$('.no_afi').show();
						
					}else{
						$('.no_afi').hide();
						$('.no_afi').hide();
						}
					
					
				}else{
					alert("La persona que desea inscribir no existe. Puede agregarla en la opcion: Registro de Personal");
					
					$('input[name=dui]').val("");
					$('input[name=nombres]').val("");
					$('input[name=apellidos]').val("");
					$('select[name=id_cooperativa]').val(1);
					$('select[name=id_cooperativa]').change();
					$('select[name=id_sucursal]').val(0);
					$('select[name=id_cargo]').val(1);
					$('input[name=correo]').val("");
					
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