<div id="content_main" class="clearfix">
  <div id="main_panel_container" class="left" style="width:900px;">
    <div id="dashboard" style="width:100%;">
      	<h2 class="ico_mug">Cooperativas</h2>
      		<div class="" style="width:90%; margin:auto;">
      	        <?php
					if($listado)
					{
						?>
					<table id="example" class="display" >
					    <thead>
					      <tr>
					      	<th>Logo</th>
					        <th>Cooperativa</th>
					        <th>Ubicaci&oacute;n</th>
					        <th>Tel&eacute;fono</th>
					        <th>Fax</th>
					        <!--<th>Correo Electr&oacute;nico</th>-->
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
		      					<td><?php 
		      							//echo img('public/img/'.$valor['logotipo']);
		      							if($valor['logotipo']==null){
		      								$valor['logotipo'] = 'logos/logo_null.png';
		      							}
		      							$image_properties = array(
		          							'src' => 'public/img/'.$valor['logotipo'],
		          							'alt' => 'logo',
		          							'width' => '50',
		          							'height' => '50',
		          							'title' => 'Cooperativa',
											);

										echo img($image_properties);
		      						?>
		      					</td>
						        <td><?php echo $valor['cooperativa'];?></td>
						        <td><?php echo $valor['ubicacion'];?></td>
						        <td><?php echo $valor['telefono'];?></td>
						        <td><?php echo $valor['fax'];?></td>
						        <!--<td><?php echo $valor['email'];?></td>-->
						        <td align="center" class="datatable_icono"><a onClick="editar_registro(<?php echo $valor['id_cooperativa']; ?>);"><?php echo img('public/img/edit.png');?></a></td>
						        <td align="center" class="datatable_icono"><a onClick="eliminar_registro(<?php echo $valor['id_cooperativa']; ?>);" title="Clic para Desactivar"><?php echo img('public/img/cancel.png');?></a></td>
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
		  url: "<?php echo site_url('cooperativas/nuevo');?>",
		  type:"POST",
		  success:function(data){

		  	$.fancybox(data);
		  }
		  
		});
}

function editar_registro(id)
{
	$.ajax({
		  url: "<?php echo site_url('cooperativas/editar');?>/"+id,
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
		  url: "<?php echo site_url('cooperativas/eliminar');?>/"+id,
		  type:"POST",
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

