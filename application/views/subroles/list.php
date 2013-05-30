<div id="content_main" class="clearfix">
  <div id="main_panel_container" class="left" style="width:900px;">
    <div id="dashboard" style="width:100%;padding-bottom:50px;">
      <h2 class="ico_mug">
      	<table style="width:100%;">
      		<tr>
      			<td>Sub Roles</td>
      			<td style="text-align:right;"><button onClick="nuevo_registro();">Nuevo</button></td>
      		</tr>
      	</table>
      </h2>
      <div class="" style="width:90%; margin:auto;">
      
        <?php
if($listado)
{
	?>
  <table id="example" class="display" >
    <thead>
      <tr>
      	<th>Rol</th>
        <th>Sub Rol</th>
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
        <td><?php echo $valor['subrol'];?></td>
        <td align="center" class="datatable_icono"><a onClick="editar_registro(<?php echo $valor['id_subrol']; ?>);"><?php echo img('public/img/edit.png');?></a></td>
        <td align="center" class="datatable_icono"><a onClick="eliminar_registro(<?php echo $valor['id_subrol']; ?>);" title="Clic para Desactivar"><?php echo img('public/img/cancel.png');?></a></td>
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

function nuevo_registro()
{
	$.ajax({
		  url: "<?php echo site_url('subroles/nuevo');?>",
		  type:"POST",
		  success:function(data){

		  	$.fancybox(data);
		  }
		  
		});
}

function editar_registro(id)
{
	$.ajax({
		  url: "<?php echo site_url('subroles/editar');?>/"+id,
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
		  url: "<?php echo site_url('subroles/eliminar');?>/"+id,
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

