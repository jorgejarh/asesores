<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title><?php echo $perfil['perfil'];?></title>
</head>

<body>
<div style="width:900px; margin:auto;" align="center">
  <h2 align="center">SISTEMA CURRICULAR FEDECACES</h2>
  <h3 align="center"><?php echo $curricula['curricula'];?></h3>
  <table align="center" width="80%">
    <tr>
      <td align="left" valign="middle"><b>Perfil: </b> <?php echo $perfil['perfil'];?></td>
      <td align="right" valign="middle"><b>Fecha: </b> <?php echo $perfil['fecha'];?></td>
    </tr>
  </table>
  <div style=" border-top:#333 solid 1px; border-left:#333 solid 1px; border-right:#333 solid 1px;" align="left">
    <?php
		$contador=0;
        foreach($tipos_contenido as $valor)
		{
			if($valor['lista_contenido'])
			{
				$contador++;
				?>
    <div style="padding:10px;">
      <p><b><?php echo $contador.".- ".$valor['nombre_contenido'];?></b></p>
      <ul style="list-style: none; padding:0px; padding-left:10px;">
        <?php
				foreach($valor['lista_contenido'] as $valor2)
				{
					?>
        <li><?php echo "- ".$valor2['nombre'];?></li>
        <?php
				}
				?>
      </ul>
    </div>
    <div style=" border-bottom:#333 solid 1px;"> </div>
    <?php
			}
			
		}
		?>
  </div>
</div>
</body>
</html>