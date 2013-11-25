<div id="content_main" class="clearfix">
  <div id="main_panel_container" class="left" style="width:900px;">
    <div id="dashboard" style="width:100%;padding-bottom:50px;">
      <h2 class="ico_mug">
      	<table style="width:100%;">
      		<tr>
      			<td>Usuarios Externos</td>
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
      	<th>Nombre Completo</th>
      	<th>Usuario</th>
      	<th>Rol</th>
      	<th>Email</th>
        
        <th>Editar</th>
        <th>Estado</th>
      </tr>
    </thead>
    <tbody>
      <?php
		foreach($listado as $valor)
		{
			?>
      <tr class="gradeA">
      	<td><?php echo $valor['nombre_completo'];?></td>
      	<td><?php echo $valor['usuario'];?></td>
      	<td><?php echo $valor['nombre_subrol'];?></td>
      	<td><?php echo $valor['correo'] ;?></td>
        
        <td align="center" class="datatable_icono"><a onClick="editar_registro(<?php echo $valor['id_usuario']; ?>);"><?php echo img('public/img/edit.png');?></a></td>
        <td align="center" class="datatable_icono">
          <?php
						if($valor['estado']==0)
						{
							?>
          <a onClick="eliminar_registro(<?php echo $valor['id_usuario']; ?>,1);" title="Clic para Activar"><?php echo img('public/img/cancel.png');?></a>
          <?php
						} else{
							?>
          <a onClick="eliminar_registro(<?php echo $valor['id_usuario']; ?>,0);" title="Clic para Desactivar"><?php echo img('public/img/accept.png');?></a>
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
		  url: "<?php echo site_url($this->nombre_controlador.'/nuevo');?>",
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

function eliminar_registro(id,estado)
{
	if(!confirm('¿Seguro de desea cambiar el estado del usuario?'))
	{
		return false;
	}

	$.ajax({
		  url: "<?php echo site_url($this->nombre_controlador.'/eliminar');?>/"+id,
		  type:"POST",
		  data:{estado:estado},
		  success:function(data){

		  	/*$.fancybox({
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

