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
        
        <th># de Modulos</th>
        <th># Par. Estimados</th>
        <th>Pre. Total</th>
        <th>Costo Individual</th>
        <th>Asignar Evaluaciones</th>
        <th>Asignar Modulos</th>
        <th>Estado</th>
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
      	<td><?php echo $valor['nombre_capacitacion'];?></td>
        <td><?php echo $valor['num_modulos'];?></td>
        <td><?php echo $valor['n_participantes'];?></td>
        <td>$ <?php $total=obtener_costo_capacitacion($valor[$this->$model->id_tabla]); echo number_format($total,2);?></td>
        <td>$ <?php echo number_format($total/$valor['n_participantes'],2);?></td>
        <td align="center"	class="datatable_icono"><a href="<?php echo site_url('pl_capacitaciones_eval/index/'.$valor[$this->$model->id_tabla]);?>" ><?php echo img('public/img/ico_settings.png');?></a></td>
        <td align="center"	class="datatable_icono"><a href="<?php echo site_url('pl_modulos/index/'.$valor[$this->$model->id_tabla]);?>" ><?php echo img('public/img/ico_settings.png');?></a></td>
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

