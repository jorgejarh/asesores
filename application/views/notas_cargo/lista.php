<div id="content_main" class="clearfix">
  <div id="main_panel_container" class="left" style="width:900px;">
    <div id="dashboard" style="width:100%;padding-bottom:50px;">
      	<h2 class="ico_mug">
      		<table style="width:100%;">
      		<tr>
      			<td><?php echo $title;?></td>
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
        <th>Cooperativa</th>
        <th>Telefono</th>
        <th>Email</th>
        <th>Capacitaciones</th>
      </tr>
    </thead>
    <tbody>
      <?php
		foreach($listado as $valor)
		{
			?>
      <tr class="gradeA">
       <td><?php echo $valor['cooperativa'];?></td>
       <td><?php echo $valor['telefono'];?></td>
      <td><?php echo $valor['email'];?></td>
        <td align="center" class=""><a title="Ver Capacitaciones" href="<?php echo site_url($this->nombre_controlador.'/capacitaciones/'.$valor['id_cooperativa']);?>" ><?php echo img('public/img/ico_page.png');?></a></td>
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
	window.location.href="<?php echo site_url("nota_cargo/nuevo");?>";
}

function editar_registro(id)
{
	$.ajax({
		  url: "<?php echo site_url('conf_menu/editar');?>/"+id,
		  type:"POST",
		  success:function(data){

		  	$.fancybox(data);
		  }
		  
		});
}

function eliminar_registro(id)
{
	if(!confirm('¿Todos los submenus tambien se eliminaran, Seguro de desea el registro,?'))
	{
		return false;
	}

	$.ajax({
		  url: "<?php echo site_url('conf_menu/eliminar');?>/"+id,
		  type:"POST",
		  success:function(data){
			  
			  	if(data=="ok")
			  	{
					alert("Registro Eliminado");
					location.reload();
				}
			/*  
		  	$.fancybox({
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

