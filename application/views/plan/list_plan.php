<div id="content_main" class="clearfix">
  <div id="main_panel_container" class="left">
    <div id="dashboard">
      <h2 class="ico_mug">Planes de Capacitación</h2>
      <div class="clearfix">
      
        <?php
if($listado)
{
	?>
  <table id="example" class="display" >
    <thead>
      <tr>
        <th>Nombre de Plan</th>
        <th>Fecha de Creacion</th>
        <th>Estado</th>
      </tr>
    </thead>
    <tbody>
      <?php
		foreach($listado as $valor)
		{
			?>
      <tr class="gradeA">
        <td><?php echo $valor['pl_plan'];?></td>
        <td><?php echo $valor['pl_fecha'];?></td>
        <td align="center"><a onClick="editar_registro(<?php echo $valor['id_plan']; ?>);"><?php echo img('public/img/edit.png');?></a></td>
        <td align="center">
          <?php
						if($valor['pl_estado']==1)
						{
							?>
          <a onClick="eliminar_registro(<?php echo $valor['id_plan']; ?>,0);" title="Clic para Desactivar"><?php echo img('public/img/cancel.png');?></a>
          <?php
						} else{
							?>
          <a onClick="eliminar_registro(<?php echo $valor['id_plan']; ?>,1);" title="Clic para Activar"><?php echo img('public/img/accept.png');?></a>
          <?php
						}
					;?></td>
      </tr>
      <?php
		}
		?>
    </tbody>
  </table>
  <?php
}
?>
          <button onClick="nuevo_registro();">Nuevo</button>
      </div>
    </div>
    <!-- end #dashboard --> 
  </div>
  <div id="sidebar" class="right">
    <h2 class="ico_mug">Planes</h2>
    <ul id="menu">
      <?php $this->load->view('plan/lateral_derecho_plan');?>
    </ul>
  </div>
  <!-- end #sidebar --> 
  
</div>
<script type="text/javascript">
	$(document).ready(function() {
	    $('#example').dataTable( {
	        <?php echo config_lenguaje_tabla(); ?>
	    } );
	} );

function nuevo_registro()
{
	$.ajax({
		  url: "<?php echo site_url('users/nuevo');?>",
		  type:"POST",
		  success:function(data){

		  	$.fancybox(data);
		  }
		  
		});
}

function editar_registro(id)
{
	$.ajax({
		  url: "<?php echo site_url('users/editar');?>/"+id,
		  type:"POST",
		  success:function(data){

		  	$.fancybox(data);
		  }
		  
		});
}

function eliminar_registro(id,estado)
{
	if(!confirm('¿Seguro de desea cambiar el estado del usuario?'))
	{
		return false;
	}

	$.ajax({
		  url: "<?php echo site_url('users/eliminar');?>/"+id,
		  type:"POST",
		  data:{activo:estado},
		  success:function(data){

		  	$.fancybox({
		  		content:data,
		  		afterClose:function()
		  		{
		  			location.reload();
		  		}
		  	});
		  }
		  
		});
}

</script>

