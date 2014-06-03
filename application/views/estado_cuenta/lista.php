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
        <th>Ver</th>
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
        <td align="center" class="datatable_icono"><a onclick="ver_estado(<?php echo $valor['id_cooperativa'];?>);" ><?php echo img('public/img/ico_page.png');?></a></td>
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


function ver_estado(id)
{
	var f = new Date();
	
	f_inicio=prompt('Fecha Inicio formato (dd/mm/yyyy): ',f.getDate() + "/" + (f.getMonth() +1) + "/" + f.getFullYear());
	f_fin=prompt('Fecha Fin formato (dd/mm/yyyy): ',f.getDate() + "/" + (f.getMonth() +1) + "/" + f.getFullYear());
	window.open("<?php echo site_url('estado_cuenta/ver_total'); ?>/"+id+"?f_i="+f_inicio+"&f_fin="+f_fin);
}


</script>

