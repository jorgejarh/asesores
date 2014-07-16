<div id="content_main" class="clearfix">
  <div id="main_panel_container" class="left" style="width:900px;">
    <div id="dashboard" style="width:100%;padding-bottom:50px;">
    
    
      <h2 class="ico_mug">
      	<table style="width:100%;">
      		<tr>
      			<td><?php echo $plan_modalidad['nombre_plan']." &gt; ".$plan_modalidad['nombre_modalidad'];?></td>
      			<td style="text-align:right;"><button onClick="nuevo_registro(<?php echo $plan_modalidad['id_plan_modalidad']?>);">Nuevo</button></td>
      		</tr>
      	</table>
      </h2>
      <div class="bot_atras">
    	<?php
        echo anchor('pl_modalidades/index/'.$plan_modalidad['id_plan'],'<- Regresar');
		?>
    </div>
      <div class="" style="width:90%; margin:auto;">
      
        <?php
if($listado)
{
	?>
  <table id="example" class="display" >
    <thead>
      <tr>
      	<th><?php echo $plan_modalidad['nombre_modalidad'];?></th>
        <th>Presupuesto</th>
        <th>Costo Real</th>
        <th># de Modulos</th>
        <th># Par. Estimados</th>
        
        <th>Asignar Modulos</th>
        <th>Agregar Documentos</th>
        <th>Estado</th>
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
      	<td><?php echo $valor['nombre_capacitacion'];?></td>
        <td align="center">
        <a target="_blank" href="<?php echo site_url('pl_capacitaciones/ver_presupuesto/'.$valor[$this->$model->id_tabla]);?>" ><?php echo img('public/img/ico_chart_bar.png');?></a></td>
        <td align="center">
        <a target="_blank" href="<?php echo site_url('pl_capacitaciones/ver_costo_real/'.$valor[$this->$model->id_tabla]);?>" ><?php echo img('public/img/ico_chart_bar.png');?></a></td>
        <td><?php echo $valor['num_modulos'];?></td>
        <td><?php echo $valor['n_participantes']+$valor['n_participantes_no']+$valor['n_participantes_ex'];?></td>
       
        <td align="center"	class="datatable_icono"><a href="<?php echo site_url('pl_modulos/index/'.$valor[$this->$model->id_tabla]);?>" ><?php echo img('public/img/ico_settings.png');?></a></td>
        <td align="center"	class="datatable_icono"><a href="<?php echo site_url('pl_capacitaciones_docs/index/'.$valor[$this->$model->id_tabla]);?>" ><?php echo img('public/img/ico_settings.png');?></a></td>
        <td align="center" class="datatable_icono">
        <?php
        if($valor['cerrado']==0)
		{
			?>
            Abierto
            <a onClick="cerrar_capacitacion(<?php echo $valor[$this->$model->id_tabla]; ?>);" title="Clic para cerrar este tema"><?php echo img('public/img/cancel.png');?></a>
            <?php
		}else{
			?>
            Cerrado
            <a onClick="abrir_capacitacion(<?php echo $valor[$this->$model->id_tabla]; ?>);" title="Clic para abrir este tema"><?php echo img('public/img/accept.png');?></a>
            <?php
			}
		?>
        
        
        </td>
        
        <td align="center" class="datatable_icono"><a title="Editar" onClick="editar_registro(<?php echo $valor[$this->$model->id_tabla]; ?>);"><?php echo img('public/img/edit.png');?></a></td>
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

function cerrar_capacitacion(id)
{
	if(!confirm('¿Seguro que desea cerrar este tema?'))
	{
		return false;
	}

	$.ajax({
		  url: "<?php echo site_url($this->nombre_controlador.'/estado');?>",
		  type:"POST",
		  data:{'id':id,'cerrado':'1'},
		  success:function(data){
		  	
		  		location.reload();
		
		  }
		  
		});
}

function abrir_capacitacion(id)
{
	if(!confirm('¿Seguro que desea abrir este tema?'))
	{
		return false;
	}

	$.ajax({
		  url: "<?php echo site_url($this->nombre_controlador.'/estado');?>",
		  type:"POST",
		  data:{'id':id,'cerrado':'0'},
		  success:function(data){
		  	
		  		location.reload();
		
		  }
		  
		});
}

</script>

