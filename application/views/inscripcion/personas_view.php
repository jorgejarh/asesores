 <div class="" style="width:800px; margin:auto;">
      
        <?php
if($listado)
{
	?>
  <table id="lista_b" class="display" >
    <thead>
      <tr>
      	<th>DUI</th>
       	<th>Nombre</th>
        <th>Cooperativa</th>
        <th>Sucursal</th>
        <th>Cargo</th>
      </tr>
    </thead>
    <tbody>
      <?php
		foreach($listado as $valor)
		{
			
			?>
      <tr class="gradeA">
      	<td><a title="Seleccionar" onClick="seleccionar_dui('<?php echo $valor['dui'];?>');"><?php echo $valor['dui'];?></a></td>
        <td><?php echo $valor['apellidos'].", ".$valor['nombres'];?></td>
        <td><?php echo $valor['nombre_cooperativa'];?></td>
        
        <td><?php echo $valor['nombre_sucursal'];?></td>
        <td><?php echo $valor['nombre_cargo'];?></td>
        
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
      
<script type="text/javascript">
	$(document).ready(function() {
	    $('#lista_b').dataTable( {
	        <?php echo config_lenguaje_tabla(); ?>
	    } );
	} );


</script>