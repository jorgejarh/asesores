
<?php
//print_r($this->datos_user);
?>
<div id="content_main" class="clearfix">
  <div id="main_panel_container" class="left" style="width:900px;">
    <div id="dashboard" style="width:100%;padding-bottom:50px;">
    
    
      <h2 class="ico_mug">
      	<table style="width:100%;">
      		<tr>
      			<td>Inscripcion: <?php echo $inscripcion['nombre_capacitacion'];?></td>
      			<!--<td style="text-align:right;"><button onClick="nuevo_registro(<?php echo $inscripcion['id_inscripcion_tema'];?>);">Inscribir persona</button></td>-->
      		</tr>
          <tr>
            <td id="inversion" >inversión por persona $<?php echo $precio_venta; ?></td>
            <td></td>
          </tr>
      	</table>
      </h2>
      <div class="bot_atras">
    	<?php
        echo anchor('inscripcion_temas','<- Regresar');
		?>
    </div>
    <div style="margin:auto; width:500px;">
    	<?php
echo form_open('',array(
					'id'=>'form_nuevo'
						),
					array(
						'id_inscripcion_tema'=>$id,
						'tipo_persona'=>'A'
						)
				);
?>

<table align="center" style="margin:auto; width:400px;">

	<tr>
		<td>DUI: </td>
		<td><?php 
			echo form_input(array('name'=>"dui",'readonly'=>'readonly'));
			?><button class="bus" onclick="abrir_busqueda();">Buscar</button></td>
	</tr>
	<?php
	foreach($this->campos as $llave=>$valor)
	{
		?>
	<tr style="<?php echo ($valor['tipo_elemento']=='select')?'display:none':'';?>">
		<td><?php echo $valor['nombre_mostrar']; ?>: </td>
		<td><?php 
			switch($valor['tipo_elemento'])
			{
				case 'text':
					echo form_input(
							array(
									'name'=>$valor['nombre_campo'],
									'readonly'=>'readonly',
									'value'=>set_value($valor['nombre_campo'])
								));
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
			<input type="submit" id="save" value="Inscribir" />
		</td>
	</tr>
</table>
<?php
echo form_close();
?>
<div class="cargando_">

</div>
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
});
	</script>
    
      <div class="" style="width:90%; margin:auto;">
      
        <?php
if($listado)
{
	?>
  <table id="example" class="display" >
    <thead>
      <tr>
      	<th>DUI</th>
      	<th>Apellidos</th>
        
        <th >Nombres</th>
        
        <th >Sucursal</th>
        
        <th >Cargo</th>
        
        <th >Fecha de inscripcion</th>
        <!--<th>&nbsp;</th>-->
        <th>&nbsp;</th>
      </tr>
    </thead>
    <tbody>
      <?php
		foreach($listado as $valor)
		{
			?>
      <tr class="gradeA">
      	<td><?php echo $valor['dui'];?></td>

      	<td><?php echo $valor['apellidos'];?></td>
        
        <td><?php echo $valor['nombres'];?></td>
        
        <td><?php echo $valor['sucursal'];?></td>
        
        <td><?php echo $valor['nombre_cargo'];?></td>
        
        <td><?php echo date('d-m-Y',strtotime($valor['f_creacion']));?></td>
        
        <!--<td align="center" class="datatable_icono"><a title="Editar" onClick="editar_registro(<?php echo $valor[$this->$model->id_tabla]; ?>);"><?php echo img('public/img/edit.png');?></a></td>-->
        
        <td align="center" class="datatable_icono">
        
          <a title="Eliminar" onClick="eliminar_registro(<?php echo $valor[$this->$model->id_tabla]; ?>);" title="Clic para Eliminar"><?php echo img('public/img/cancel.png');?></a>
          </td>
      </tr>
      <?php
		}
		?>
    </tbody>
  </table>
  <?php
}
?>
          
      </div>
    </div>
    <!-- end #dashboard --> 
  </div>
  
  <!-- end #sidebar --> 
  
</div>
<script type="text/javascript">
	$(document).ready(function() {
	    $('#example').dataTable( {
	        <?php echo config_lenguaje_tabla(); ?>
	    } );
	} );

function nuevo_registro(id)
{
	$.ajax({
		  url: "<?php echo site_url($this->nombre_controlador.'/nuevo');?>/"+id,
		  type:"POST",
		  success:function(data){

		  	$.fancybox(data);
		  }
		  
		});
}

function editar_registro(id)
{
	$.ajax({
		  url: "<?php echo site_url($this->nombre_controlador.'/editar');?>/"+id,
		  type:"POST",
		  success:function(data){

		  	$.fancybox(data);
		  }
		  
		});
}

function eliminar_registro(id)
{
	if(!confirm('¿Seguro que desea eliminar?'))
	{
		return false;
	}

	$.ajax({
		  url: "<?php echo site_url($this->nombre_controlador.'/eliminar');?>",
		  type:"POST",
		  data:{'id':id},
		  success:function(data){
		  	
		  		location.reload();
		
		  }
		  
		});
}



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
					setTimeout("$('select[name=id_sucursal]').val("+data.id_sucursal+");",2000);
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

function abrir_busqueda()
{
	event.preventDefault();
	$.ajax({
		  url: "<?php echo site_url('inscripcion/buscar_todo');?>",
		  type:"POST",
		  success:function(data){

		  	$.fancybox(data);
		  }
	
	});
}

function seleccionar_dui(dui)
{
	$('input[name=dui]').val(dui);
	buscar_persona();
	$.fancybox.close();
	}





</script>


<style>
  #inversion /*celda que contiene la inversion*/
  {
    border-top: solid 2px;
    font-size: 17px;
    padding-top: 5px;
  }
</style>

