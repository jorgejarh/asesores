<div id="content_main" class="clearfix">
  <div id="main_panel_container" class="left" style="width:900px;">
    <div id="dashboard" style="width:100%;padding-bottom:50px;">
      	<h2 class="ico_mug">
      		<table style="width:100%;">
      		<tr>
      			<td>Cooperativas</td>
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
					      	<th>Logo</th>
					        <th>Cooperativa</th>
					        <th>Gerente</th>
					        <th>Tel&eacute;fono</th>
					        <th>Fax</th>
					        <th>Email</th>
					        <th>Credito Fiscal</th>
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
		      							$image_icon_properties = array(
		          							'src' => 'public/img/edit.png',
		          							'alt' => 'cambiar',
		          							'title' => 'cambiar imagen',
		          							'width' => '10px',
		          							'height' => '10px'
											);

										//echo img($image_properties);
		      						?>
		      					<div class="logo_img" style="background:url(<?php echo base_url(); ?>public/img/<?php echo $valor['logotipo'] ?>);background-size:50px 50px;width:50px; height:50px">
		      						<div class="cambiar_icono">
		      							<?php echo img($image_icon_properties); ?>Cambiar
		      							<input type="hidden" value="<?php echo $valor['id_cooperativa']; ?>">
		      						</div>
		      					</div>
		      					</td>
						        <td><?php echo $valor['cooperativa'];?></td>
						        <td><?php echo $valor['gerente'];?></td>
						        <td><?php echo $valor['telefono'];?></td>
						        <td><?php echo $valor['fax'];?></td>
						        <td><?php echo $valor['email'];?></td>
						        <td><?php echo $valor['credito_fiscal'];?></td>
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



	 $('.cambiar_icono').click(function(){
	 	var id_cooperativa = $(this).children("input").val();
	 	$.ajax({
		  url: "<?php echo site_url('cooperativas/cambiar_imagen/"+id_cooperativa+"');?>",
		  type:"POST",
		  success:function(data){
		  	$.fancybox(
		  		{
		  			content:data,
		  			afterClose:function()
		  			{
		  				location.reload();
		  			}
		  		}
		  		);
		  }
		  
		});
	 });



	});

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
	if(!confirm('¿Esta seguro de Elminar esta Cooperativa?'))
	{
		return false;
	}

	$.ajax({
		  url: "<?php echo site_url('cooperativas/eliminar');?>/"+id,
		  type:"POST",
		  success:function(data){
		  		alert(data);
		  		location.reload();
		  }
		  
		});
}

</script>

<style>
	.cambiar_icono{
		background-color: #000000;
		color: #FFFFFF;
		font-size: 9px;
		display: none;
		width: 50px;
		opacity:0.8;
	}

	.logo_img:hover div{
		display: block;
		position: absolute;
	}
</style>
