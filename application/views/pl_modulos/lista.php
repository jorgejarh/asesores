<div id="content_main" class="clearfix">
  <div id="main_panel_container" class="left" style="width:900px;">
    <div id="dashboard" style="width:100%;padding-bottom:50px;">
    
    
      <h2 class="ico_mug">
      	<table style="width:100%;">
      		<tr>
      			<td><?php echo $capacitacion['nombre_plan']." &gt; ".$capacitacion['nombre_modalidad']." &gt; ".$capacitacion['nombre_capacitacion'];?></td>
      			<td style="text-align:right;"><button onClick="nuevo_registro(<?php echo $capacitacion['id_capacitacion']?>);">Nuevo</button></td>
      		</tr>
      	</table>
      </h2>
      <div class="bot_atras">
    	<?php
        echo anchor('pl_capacitaciones/index/'.$capacitacion['id_plan_modalidad'],'<- Regresar');
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
      	<th>Nombre del Modulo</th>
        <th width="90">Fecha Inicio</th>
        <th width="90">Fecha Fin</th>
        <th width="50">Total</th>
         <th>Ver Presupuesto</th>
        <th>Asignar Costos</th>
        <th>Editar</th>
        <th>Eliminar</th>
      </tr>
    </thead>
    <tbody>
      <?php
		foreach($listado as $valor)
		{
			?>
      <tr class="gradeA">
      	<td><?php echo $valor['nombre_modulo'];?></td>
        
        <td><?php echo date('d-m-Y',strtotime($valor['fecha_prevista']));?></td>
        <td><?php echo date('d-m-Y',strtotime($valor['fecha_prevista_fin']));?></td>
        <td>$ <?php echo $valor['sum_total'];?></td>
        <td align="center"	class="">
        <?php
        if($valor['sum_total']>0)
		{
		?>
        <a target="_blank" href="<?php echo site_url('pl_modulos/ver_presupuesto/'.$valor[$this->$model->id_tabla]);?>" ><?php echo img('public/img/ico_chart_bar.png');?></a>
        
        <?php
		}
		?>
        </td>
        <td align="center"	class="datatable_icono"><a href="<?php echo site_url('pl_rubro/index/'.$valor[$this->$model->id_tabla]);?>" ><?php echo img('public/img/ico_settings.png');?></a></td>
        <td align="center" class="datatable_icono"><a onClick="editar_registro(<?php echo $valor[$this->$model->id_tabla]; ?>);"><?php echo img('public/img/edit.png');?></a></td>
        <td align="center" class="datatable_icono">
        
          <a onClick="eliminar_registro(<?php echo $valor[$this->$model->id_tabla]; ?>);" title="Clic para Eliminar"><?php echo img('public/img/cancel.png');?></a>
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

