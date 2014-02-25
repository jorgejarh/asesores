<div id="content_main" class="clearfix">
  <div id="main_panel_container" class="left" style="width:900px;">
    <div id="dashboard" style="width:100%;padding-bottom:50px;">
    
    
      <h2 class="ico_mug">
      	<table style="width:100%;">
      		<tr>
      			<td>Mis inscripciones</td>
      			<td style="text-align:right;"><button onClick="nuevo_registro();">Nueva Inscripcion</button></td>
      		</tr>
      	</table>
      </h2>
      <div class="bot_atras">
    	
    </div>
      <div class="" style="width:90%; margin:auto;">
      
        <?php
if($listado)
{
	?>
  <table id="example" class="display" >
    <thead>
      <tr>
      	<th>Nombre del tema</th>
        
        <th >Precio por persona</th>
        
        <th >Inscritos</th>
        
        <th >Total a Pagar</th>
        
        <th >Asignar personas</th>
        
        <th >Fecha de inscripcion</th>
        <th>&nbsp;</th>
      </tr>
    </thead>
    <tbody>
      <?php
		foreach($listado as $valor)
		{
			//print_r($valor);
			?>
      <tr class="gradeA">
      	<td><?php echo $valor['nombre_capacitacion'];?></td>
        
        <td>$ <?php $total=obtener_precio_capacitacion($valor['id_capacitacion']); echo number_format($total,2);?></td>
        
        <td><?php echo $valor['n_personas'];?></td>
        
        <td>$ <?php echo number_format(($total*$valor['n_personas']),2);?></td>
        
        <td align="center"	class="datatable_icono"><a href="<?php echo site_url('inscripcion_temas_personas/index/'.idencode($valor[$this->$model->id_tabla]));?>" ><?php echo img('public/img/ico_settings.png');?></a></td>
        
        <td><?php echo date('d-m-Y',strtotime($valor['f_creacion']));?></td>
        
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

</script>

