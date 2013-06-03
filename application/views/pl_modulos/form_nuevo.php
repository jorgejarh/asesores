<h3 align="center"><?php echo $title;?></h3>
<hr>
<?php
echo form_open('',array(
					'id'=>'form_nuevo'
						),
					array(
					'id_capacitacion'=>$id
						)
				);
?>

<table align="center" style="margin:auto; width:400px;">
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
			}
			
			?></td>
	</tr>
		<?php
	}
	?>
    <tr>
		<td>Fecha Prevista Inicio:</td>
		<td> 
        	
			<?php echo form_input('fecha_prevista', date('Y-m-d'),'id="fecha_pre"'); ?>
            <div class="conte_f">
            	<div class="f_pre d"></div>
            </div>
		</td>
	</tr>
    <tr>
		<td>Fecha Prevista Final:</td>
		<td> 
        	
			<?php echo form_input('fecha_prevista_fin', date('Y-m-d'),'id="fecha_pre_f"'); ?>
            <div class="conte_f">
            	<div class="f_pre_f d"></div>
            </div>
		</td>
	</tr>
	<tr>
		<td>Curricula:</td>
		<td> 
			<?php $curriculas[0]="-Seleccione-"; ksort($curriculas); echo form_dropdown('',$curriculas,'','id="curricula_select"'); ?>
		</td>
	</tr>
	<tr>
		<td>Perfil:</td>
		<td> 
			<div id="div_result_perfil">

			</div>
		</td>
	</tr>
    <tr>
		<td>Contenido:</td>
		<td> 
			<div id="div_result_contenido">

			</div>
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
	
	
	$('#curricula_select').change(function(event){

		$('#div_result_sucursal').fadeOut('fast');
		$.ajax({
				  url: "<?php echo site_url($this->nombre_controlador.'/select_curricula');?>",
				  type:"POST",
				  dataType:"json",
				  data:{id:$(this).val()},
				  success:function(data){

				  		$('#div_result_perfil').html(data.html);
				  		$('#div_result_perfil').fadeIn('fast');
						
						$('#perfiles_select').change();
				  		
				  }
			});

	});
	
	$('#perfiles_select').live('change',function(event){

		$('#div_result_sucursal').fadeOut('fast');
		$.ajax({
				  url: "<?php echo site_url($this->nombre_controlador.'/select_perfil');?>",
				  type:"POST",
				  dataType:"json",
				  data:{id:$(this).val()},
				  success:function(data){

				  		$('#div_result_contenido').html(data.html);
				  		$('#div_result_contenido').fadeIn('fast');
				  		
				  }
			});

	});
	
	
	$( ".f_pre" ).datepicker({
		 altField: "#fecha_pre",
		altFormat: "yy-mm-dd"
		});
	
	$( ".f_pre_f" ).datepicker({
		 altField: "#fecha_pre_f",
		altFormat: "yy-mm-dd"
		});
	
	$( ".f_pre" ).hide();
	$( ".f_pre_f" ).hide();
	
	$( ".ui-datepicker-calendar a" ).live('click',function(){
			$( ".f_pre" ).hide();
			$( ".f_pre_f" ).hide();
		});
	
	$('#fecha_pre').click(function(){
		$( ".f_pre" ).show();
		});
	$('#fecha_pre_f').click(function(){
		$( ".f_pre_f" ).show();
		});
	
});


</script>