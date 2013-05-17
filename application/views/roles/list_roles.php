<div id="content_main" class="clearfix">
  <div id="main_panel_container" class="left">
    <div id="dashboard">
      <h2 class="ico_mug">Roles</h2>
      <div class="clearfix">
      
        <?php
if($listado)
{
	?>
  <table id="example" class="display" >
    <thead>
      <tr>
        <th>Rol</th>
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
        <td><?php echo $valor['rol'];?></td>
        <td align="center"><a onClick="editar_registro(<?php echo $valor['id_rol']; ?>);"><?php echo img('public/img/edit.png');?></a></td>
        <td align="center"><a onClick="eliminar_registro(<?php echo $valor['id_rol']; ?>);" title="Clic para Desactivar"><?php echo img('public/img/cancel.png');?></a></td>
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
    <h2 class="ico_mug">Configuracion</h2>
    <ul id="menu">
      <?php $this->load->view('users/lateral_derecho_conf');?>
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
		  url: "<?php echo site_url('roles/nuevo');?>",
		  type:"POST",
		  success:function(data){

		  	$.fancybox(data);
		  }
		  
		});
}

function editar_registro(id)
{
	$.ajax({
		  url: "<?php echo site_url('roles/editar');?>/"+id,
		  type:"POST",
		  success:function(data){

		  	$.fancybox(data);
		  }
		  
		});
}

function eliminar_registro(id)
{
	if(!confirm('¿Seguro de desea el registro?'))
	{
		return false;
	}

	$.ajax({
		  url: "<?php echo site_url('roles/eliminar');?>/"+id,
		  type:"POST",
		  success:function(data){
/*
		  	$.fancybox({
		  		content:data,
		  		afterClose:function()
		  		{*/
		  			location.reload();
		  		/*}
		  	});*/
		  }
		  
		});
}

</script>

