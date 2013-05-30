<div id="content_main" class="clearfix">
  <div id="main_panel_container" class="left" style="width:900px;">
    <div id="dashboard" style="width:100%;padding-bottom:50px;">
      	<h2 class="ico_mug">
      		<table style="width:100%;">
      		<tr>
      			<td>Gestion de Menu</td>
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
					      	<th>Nombre Menu</th>
					        <th>Url</th>
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
		      					<td><?php echo $valor['nombre_menu'];?></td>
						        <td><?php echo $valor['url'];?></td> 
						        <td align="center" class="datatable_icono"><a onClick="editar_registro(<?php echo $valor['id_menu']; ?>);"><?php echo img('public/img/edit.png');?></a></td>
						        <td align="center" class="datatable_icono"><a onClick="eliminar_registro(<?php echo $valor['id_menu']; ?>);" title="Clic para Desactivar"><?php echo img('public/img/cancel.png');?></a></td>
						    </tr>
		  				<?php
								if($valor['submenu'])
								{
									foreach($valor['submenu'] as $valor2)
									{
										?>
                                        <tr class="gradeA">
                                            <td>&nbsp; &nbsp; &nbsp; &nbsp; &nbsp;  |- <?php echo $valor2['nombre_menu'];?></td>
                                            <td><?php echo $valor2['url'];?></td> 
                                            <td align="center" class="datatable_icono"><a onClick="editar_registro(<?php echo $valor2['id_menu']; ?>);"><?php echo img('public/img/edit.png');?></a></td>
                                            <td align="center" class="datatable_icono"><a onClick="eliminar_registro(<?php echo $valor2['id_menu']; ?>);" title="Clic para Desactivar"><?php echo img('public/img/cancel.png');?></a></td>
                                        </tr>
                                        <?php
										if($valor2['submenu'])
										{
											foreach($valor2['submenu'] as $valor3)
											{
												?>
												<tr class="gradeA">
													<td>&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;  |- <?php echo $valor3['nombre_menu'];?></td>
													<td><?php echo $valor3['url'];?></td> 
													<td align="center" class="datatable_icono"><a onClick="editar_registro(<?php echo $valor3['id_menu']; ?>);"><?php echo img('public/img/edit.png');?></a></td>
													<td align="center" class="datatable_icono"><a onClick="eliminar_registro(<?php echo $valor3['id_menu']; ?>);" title="Clic para Desactivar"><?php echo img('public/img/cancel.png');?></a></td>
												</tr>
												<?php
											}
										}
									}
								}
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
	    /*$('#example').dataTable( {
	        <?php echo config_lenguaje_tabla(); ?>
	    } );*/
	} );

function nuevo_registro()
{
	$.ajax({
		  url: "<?php echo site_url('conf_menu/nuevo');?>",
		  type:"POST",
		  success:function(data){

		  	$.fancybox(data);
		  }
		  
		});
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

