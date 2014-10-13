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
	
    <tr>
		<td>Tipo Persona: </td>
		<td><?php 
			echo form_dropdown('tipo_persona',array('A'=>'Afiliado','NA'=>'No Afiliado','EX'=>'Extranjero'));
			?></td>
	</tr>
    
    <tr>
		<td>DUI / Identificación: </td>
		<td><?php 
			echo form_input("dui");
			?></td>
	</tr>
    <tr>
		<td>Nombres: </td>
		<td><?php 
			echo form_input("nombres");
			?></td>
	</tr>
    <tr>
		<td>Apellidos: </td>
		<td><?php 
			echo form_input("apellidos");
			?></td>
	</tr>
    <tr>
		<td>Correo: </td>
		<td><?php 
			echo form_input("correo");
			?></td>
	</tr>
    
    <tr class="no_afi">
		<td>Cooperativa: </td>
		<td><?php 
			echo form_dropdown('id_cooperativa',$cooperativas);
			?></td>
	</tr>
    <tr class="no_afi">
		<td>Sucursal: </td>
		<td><?php 
			echo form_dropdown('id_sucursal',array('0'=>'Ninguna'));
			?></td>
	</tr>
	<tr>
		<td>Cargo: </td>
		<td><?php 
			echo form_dropdown('id_cargo',$cargos);
			?></td>
	</tr>
    <tr>
		<td>Genero: </td>
		<td><?php 
			echo form_dropdown('genero',array('M'=>'Masculino','F'=>'Femenino'));
			?></td>
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


	$('#form_nuevo').submit(function(){

		form=$(this);

		form.fadeOut('fast',function(){

			$('.cargando_').fadeIn('fast');

			$.ajax({
				  url: "<?php echo site_url($this->nombre_controlador.'/insertar_nueva_persona/'.$id_modulo);?>",
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
							
							$('.form_user').hide();
							alert("Persona Ingresada Correctamente.");
				  			//$.fancybox(data.mensaje);

				  			//location.reload();
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
	
	
	$('select[name=tipo_persona]').change(function(e) {
		
		if($(this).val()=="A")
		{
			$('.no_afi').show();
			$('select[name=id_cooperativa]').val(1);
			$('select[name=id_cooperativa]').change();
			
		}else{
			$('.no_afi').hide();
			}
	});
	
	
});


</script>