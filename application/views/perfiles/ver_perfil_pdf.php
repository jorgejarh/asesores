<h1 align="center">SISTEMA CURRICULAR FEDECACES</h1>
<h3 align="center"><?php echo $curricula['curricula'];?></h3>
<table align="center" width="100%">
  <tr>
    <td align="left" valign="middle"><p><b>Perfil: </b> <?php echo $perfil['perfil'];?></p></td>
    <td align="right" valign="middle"><p><b>Fecha: </b> <?php echo $perfil['fecha'];?></p></td>
  </tr>
</table>
<div style="font-size:12px;">
<?php
$contador=0;
foreach($tipos_contenido as $valor)
{
	if($valor['lista_contenido'])
	{
		$contador++;
		?>

  		<p><b><?php echo $contador.".- ".$valor['nombre_contenido'];?></b></p>
		<?php
        foreach($valor['lista_contenido'] as $valor2)
        {
            ?>
            <p style="margin-left:10px;"><?php echo "- ".$valor2['nombre'];?></p>
            <?php
        }
	}
	
}
?>
</div>