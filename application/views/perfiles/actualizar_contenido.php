
  <button onClick="nuevo_contenido(<?php echo $tipo_contenido['id_tabla_contenido'].",".$id_perfil;?>);">Nuevo</button>

<div align="center" id="contDiv">
  <?php
    if($listado)
	{
		$con=0;
		?>
  <table id="example<?php echo $tipo_contenido['nombre_tabla'];  ?>" class="display" align="center">
    <thead>
    <tr>
      <th><b>No. </b></th>
      <th><b>Descripcion</b></th>
      <th><b>Editar</b></th>
      <th><b>Eliminar </b></th>
    </tr>
    </thead>
    <tbody>
    <?php
		foreach($listado as $valor)
		{
			$con++;
			?>
    <tr class="gradeA">
      <td><?php echo $con;?></td>
      <td align="left" style="text-align:left;"><?php echo $valor['nombre'];?></td>
      <td class="datatable_icono"><a style="cursor:pointer;" onClick="editar(<?php echo $tipo_contenido['id_tabla_contenido'];?>,<?php echo $id_perfil;?>,<?php echo $valor['id'];?>);"><?php echo img('public/img/edit.png');?></a></td>
      <td class="datatable_icono"><a style="cursor:pointer;"  onClick="del(<?php echo $tipo_contenido['id_tabla_contenido'];?>,<?php echo $id_perfil;?>,<?php echo $valor['id'];?>,'<?php echo $tipo_contenido['nombre_tabla'];?>');"><?php echo img('public/img/cancel.png');?></a></td>
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
<style>
#contDiv{
  padding-bottom: 40px;
}
.tabla_con td
{
	padding:5px;
	text-align:center;
}
</style>
<script>
  $(document).ready(function() {
     $("#example<?php echo $tipo_contenido['nombre_tabla']; ?>").dataTable( {
          <?php echo config_lenguaje_tabla(); ?>,
          "aLengthMenu": [[5, 10, 15, -1], [5, 10, 15, "All"  ]],
          
      } );
  });
</script>


