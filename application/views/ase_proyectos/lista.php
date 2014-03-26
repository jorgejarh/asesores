<div id="content_main" class="clearfix">
  <div id="main_panel_container" class="left" style="width:900px;">
    <div id="dashboard" style="width:100%;padding-bottom:50px;">
      <h2 class="ico_mug">
        <table style="width:100%;">
          <tr>
            <td><?php echo $title;?></td>
            <td style="text-align:right;"><button onClick="nuevo_registro(<?php echo $dato['id_servicio']?>);">Nuevo</button></td>
          </tr>
        </table>
      </h2>
       <div class="bot_atras">
      <?php echo anchor('ase_servicios/index/','<- Regresar');?>
    	
         </div>
      <div class="" style="width:90%; margin:auto;">
        <?php
if($listado)
{
	?>
        <table id="example" class="display" >
          <thead>
            <tr>
              <th>Id</th>
              <th>Nombre Proyecto</th>
              <th>Fecha Inicio</th>
              <th>Duración</th>
              <th>Fecha Fin</th>
              <th>Tecnicos Asignados</th>
              <th>&nbsp;</th>
              <th>&nbsp;</th>
              <th>&nbsp;</th>
              <th>&nbsp;</th>
            </tr>
          </thead>
          <tbody>
            <?php
		foreach($listado as $valor)
		{
			
			?>
            <tr class="gradeA">
              <td><?php echo $valor['id_proyecto'];?></td>
              <td><?php echo $valor['nombre_proyecto'];?></td>
              <td><?php echo date('d/m/Y',strtotime($valor['fecha_inicio']));?></td>
              <td><?php echo $valor['cantidad_tiempo_estimado']." ".traducir_tipo_tiempo($valor['nombre_tiempo_estimado']);?></td>
              <td><?php echo date('d/m/Y',strtotime($valor['fecha_fin']));?></td>
              <td align="center" class="">
              <?php
              foreach($valor['tecnicos'] as $val)
			  {
				  ?>
                  <div class="tec_<?php echo $val['id_tecnico_asignado'];?>"><?php echo $val['apellidos'].", ".$val['nombres']?> <a title="Eliminar Tecnico" onclick="eliminar_asignado(<?php echo $val['id_tecnico_asignado'];?>);"><b ><?php echo img('public/img/cancel.png');?></b></a></div>
                  <?php
				 }
			  ?>
              
              <div>
              	<a onclick="agregar_tecnico(<?php echo $valor[$this->$model->id_tabla];?>);" >+ Agregar</a>
              </div>
              
              
              </td>
              <td align="center" class=""><a title="Actividades" href="<?php echo site_url('ase_actividades/index/'.$valor[$this->$model->id_tabla]);?>" ><?php echo img('public/img/ico_posts.png');?></a></td>
              <td align="center" class=""><a title="Reporte" target="_blank" href="<?php echo site_url('ase_proyectos/reporte/'.$valor[$this->$model->id_tabla]);?>" ><?php echo img('public/img/ico_chart_bar.png');?></a></td>
              <td align="center" class=""><a title="Editar" onClick="editar_registro(<?php echo $valor[$this->$model->id_tabla]; ?>);"><?php echo img('public/img/edit.png');?></a></td>
              <td align="center" class=""><a title="Eliminar" onClick="eliminar_registro(<?php echo $valor[$this->$model->id_tabla]; ?>);" title="Clic para Eliminar"><?php echo img('public/img/cancel.png');?></a></td>
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

function agregar_tecnico(id)
{
	$.ajax({
		  url: "<?php echo site_url($this->nombre_controlador.'/asignar_tecnico');?>/"+id,
		  type:"POST",
		  success:function(data){

		  	$.fancybox(data);
		  }
		  
		});
}

function eliminar_asignado(id)
{
	$.ajax({
		  url: "<?php echo site_url($this->nombre_controlador.'/eliminar_tecnico');?>",
		  type:"POST",
		  data:{'id':id},
		  success:function(data){

		  	$('.tec_'+id).remove();
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
