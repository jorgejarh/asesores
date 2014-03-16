<h3 align="center"><?php echo $title;?></h3>
<hr>
<?php
echo form_open('',array(
							'id'=>'form_nuevo'
								),
					array('id'=>$dato[$this->$model->id_tabla])
				);
?>

<table align="center" style="margin:auto; ">
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
	
$('select[name=id_tipo_solicitante]').change(function(e) {
        var tipo=$(this).val();
		$.ajax({
				  url: "<?php echo site_url($this->nombre_controlador.'/obtener_cooperativas');?>",
				  type:"POST",
				  dataType:"json",
				  data:{id_tipo:tipo},
				  success:function(data){

				  		$('select[name=id_cooperativa]').html("");
						$.each(data,function(index,element){
							//alert(element.id_cooperativa);
							$('select[name=id_cooperativa]').append(obtener_opcion(element.id_cooperativa,element.cooperativa));
							
							});
				  		$('select[name=id_cooperativa]').val(<?php echo $dato['id_cooperativa'];?>);
						$('select[name=id_cooperativa]').change();
				  },
				   error:function()
				  {
					 alert("Error al procesar, Intente de nuevo"); 
				  }
			});
		
    });
	
	$('select[name=id_tipo_solicitante]').change();
	
	
	$('select[name=id_cooperativa]').change(function(e) {
        
		if($('select[name=id_tipo_solicitante]').val()==1)
		{
			$('input[name=nombre_solicitante]').attr('readonly',true);
			$('input[name=nombre_solicitante]').val($(this).children('option[selected=selected]').html());
		}else{
			$('input[name=nombre_solicitante]').attr('readonly',false);
			$('input[name=nombre_solicitante]').val("<?php echo $dato['nombre_solicitante'];?>");
			}
		
		
    });
	
	$('select[name=id_cooperativa]').change();
});


function obtener_opcion(id,value)
{
	return '<option value="'+id+'">'+value+'</option>';
}


</script>