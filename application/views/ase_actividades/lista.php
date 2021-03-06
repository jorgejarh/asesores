<div id="content_main" class="clearfix">
  <div id="main_panel_container" class="left" style="width:900px;">
    <div id="dashboard" style="width:100%;padding-bottom:50px;">
      <h2 class="ico_mug">
        <table style="width:100%;">
          <tr>
            <td><?php echo $title;?></td>
            <td style="text-align:right;"><button onClick="nuevo_registro(<?php echo $dato['id_proyecto']?>);">Nuevo</button></td>
          </tr>
        </table>
      </h2>
      <div class="bot_atras">
      <?php echo anchor('ase_proyectos/index/'.$dato['id_servicio'],'<- Regresar');?>
    	
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
              <th>Fecha Fin</th>
              <th>Producto Esperado</th>
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
              <td><?php echo $valor['id_actividad'];?></td>
              <td><?php echo $valor['nombre_actividad'];?></td>
              <td><?php echo date('d/m/Y',strtotime($valor['fecha_inicio']));?></td>
               <td><?php echo date('d/m/Y',strtotime($valor['fecha_fin']));?></td>
               <td><?php echo $valor['resultado_esperado'];?></td>
              
              
              <td align="center" class="datatable_icono"><a title="Editar" onClick="editar_registro(<?php echo $valor[$this->$model->id_tabla]; ?>);"><?php echo img('public/img/edit.png');?></a></td>
              <td align="center" class="datatable_icono"><a title="Eliminar" onClick="eliminar_registro(<?php echo $valor[$this->$model->id_tabla]; ?>);" title="Clic para Eliminar"><?php echo img('public/img/cancel.png');?></a></td>
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
