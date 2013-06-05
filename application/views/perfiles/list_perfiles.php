<div id="content_main" class="clearfix">
  <div id="main_panel_container" class="left">
    <div id="dashboard" style="width:900px;padding-bottom:50px;">
      <h2 class="ico_mug">
      	<table style="width:100%;">
      		<tr>
      			<td>Perfiles</td>
      			<td style="text-align:right;"><button onClick="nuevo_registro(<?php echo $id_curricula; ?>);">Nuevo</button></td>
      		</tr>
      	</table>
      </h2>
      <div class="bot_atras">
      <?php
        echo anchor('curriculas','<- Regresar');
    ?>
    </div>
      <div style="width:90%; margin:auto;">
      
        <?php
if($listado)
{
	?>
  <table id="example" class="display" align="center" >
    <thead>
      <tr>
        <th>Perfil</th>
        <th>Curricula</th>
        <th>Ver Perfil</th>
        <th>Asignar Contenido</th>
        
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
      	<td><?php echo $valor['perfil'];?></td>
        <td><?php echo $valor['curricula'];?></td>
        <td align="center"	class="datatable_icono"><a target="_blank" href="<?php echo site_url('perfiles/ver_perfil/'.$valor['id_perfil']);?>" ><?php echo img('public/img/ico_settings.png');?></a></td>
        <td align="center"	class="datatable_icono"><a href="<?php echo site_url('perfiles/asignar/'.$valor['id_perfil']);?>" ><?php echo img('public/img/ico_settings.png');?></a></td>
        <td align="center"	class="datatable_icono"><a onClick="editar_registro(<?php echo $valor['id_perfil']; ?>);"><?php echo img('public/img/edit.png');?></a></td>
        <td align="center"	class="datatable_icono"><a onClick="eliminar_registro(<?php echo $valor['id_perfil']; ?>);" ><?php echo img('public/img/cancel.png');?></a></td>
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
  <!--<div id="sidebar" class="right">
    <h2 class="ico_mug">Configuracion</h2>
    <ul id="menu">
      <?php $this->load->view('users/lateral_derecho_conf');?>
    </ul>
  </div>-->
  <!-- end #sidebar --> 
  
</div>
<script type="text/javascript">
	$(document).ready(function() {
	    $('#example').dataTable( {
	        <?php echo config_lenguaje_tabla(); ?>
	    } );
	} );

function nuevo_registro(id_curricula)
{
	$.ajax({
		  url: "<?php echo site_url('perfiles/nuevo');?>/"+id_curricula,
		  type:"POST",
		  success:function(data){

		  	$.fancybox(data);
		  }
		  
		});
}

function editar_registro(id)
{
	$.ajax({
		  url: "<?php echo site_url('perfiles/editar');?>/"+id,
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
		  url: "<?php echo site_url('perfiles/eliminar');?>/"+id,
		  type:"POST",
		  success:function(data){
			location.reload();
		  	/*$.fancybox({
		  		content:data,
		  		afterClose:function()
		  		{
		  			location.reload();
		  		}
		  	});*/
		  }
		  
		});
}

</script>

