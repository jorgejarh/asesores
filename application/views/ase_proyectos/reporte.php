
<h2>Proyecto <?php echo $proyecto['nombre_proyecto']; ?></h2>
<h3><?php echo $servicio['nombre_solicitante']; ?></h3>
  <?php
	$conta_actividad=0;
    foreach($proyecto['actividades'] as $valor)
	{
		$conta_actividad++;
		?>
  <p align="left"><?php echo $conta_actividad." - ".$valor['nombre_actividad'];?></p>
  <p align="left"><b>Bitacoras</b></p>
    <table align="center" width="100%" cellpadding="5" cellspacing="0">
      <tr>
        <td><b>Nº</b></td>
        <td><b>Fecha Inicio</b></td>
        <td><b>Fecha Fin</b></td>
        <td><b>Observación</b></td>
      </tr>
      <?php
		$conta_bitacora=0;
        foreach($valor['bitacoras'] as $bitacora)
		{
			$conta_bitacora++;
			?>
      <tr>
        <td align="center"><?php echo $conta_bitacora;?></td>
        <td align="center"><?php echo $bitacora['fecha_inicio']?></td>
        <td align="center"><?php echo $bitacora['fecha_fin']?></td>
        <td align="left"><?php echo $bitacora['observaciones']?></td>
      </tr>
      <?php
		}
		?>
    </table>
  <p align="left"><b>Recomendaciones</b></p>
    <table align="center" width="100%" cellpadding="5" cellspacing="0">
      <tr>
        <td><b>Nº</b></td>
        <td><b>Fecha</b></td>
        <td><b>Nombre</b></td>
        <td><b>Descripción</b></td>
      </tr>
      <?php
		$conta_recomendaciones=0;
        foreach($valor['recomendaciones'] as $recomendacion)
		{
			$conta_recomendaciones++;
			?>
      <tr>
        <td align="center"><?php echo $conta_recomendaciones;?></td>
        <td align="center"><?php echo $recomendacion['fecha_recomendacion']?></td>
        <td align="left"><?php echo $recomendacion['nombre_recomendacion']?></td>
        <td align="left"><?php echo $recomendacion['descripcion_recomendacion']?></td>
      </tr>
      <?php
		}
		?>
    </table>
  <?php
	}
	?>
<?php
//echo print_r($proyecto);
?>
<style type="text/css">
table {
	/*border-collapse: collapse;*/
	margin: 0px;
	padding: 0px;
}
table tr td {
	border: #000 solid 1px;
	margin: 5px;
	padding: 5px;
}
p {
	padding: 2px;
	margin: 2px;
}
</style>