<div align="center">
  <?php
    if($listado)
	{
		$con=0;
		?>
  <table align="center"  class="tabla_con">
    <tr>
      <td><b>No. </b></td>
      <td><b>Descripcion</b></td>
      <td><b>Editar</b></td>
      <td><b>Eliminar </b></td>
    </tr>
    <?php
		foreach($listado as $valor)
		{
			$con++;
			?>
    <tr>
      <td><?php echo $con;?></td>
      <td align="left" style="text-align:left;"><?php echo $valor['nombre'];?></td>
      <td><a style="cursor:pointer;" onClick="editar(<?php echo $tipo_contenido['id_tabla_contenido'];?>,<?php echo $id_perfil;?>,<?php echo $valor['id'];?>);"><?php echo img('public/img/edit.png');?></a></td>
      <td><a style="cursor:pointer;"  onClick="del(<?php echo $tipo_contenido['id_tabla_contenido'];?>,<?php echo $id_perfil;?>,<?php echo $valor['id'];?>,'<?php echo $tipo_contenido['nombre_tabla'];?>');"><?php echo img('public/img/cancel.png');?></a></td>
    </tr>
    <?php
		}
		?>
  </table>
  <?php
	}
	?>
</div>
<div align="center">
  <button onClick="nuevo_contenido(<?php echo $tipo_contenido['id_tabla_contenido'].",".$id_perfil;?>);">Nuevo</button>
</div>
<style>
.tabla_con td
{
	padding:5px;
	text-align:center;
}
</style>
