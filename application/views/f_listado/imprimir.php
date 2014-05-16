<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />

<style type="text/css">
body {
	font-family: Calibri, Arial;
}
.a_ h3 {
	margin: 0px;
}
.a_ table {
	border-spacing: 0;
	border-collapse: collapse;
}
.a_ tr td {
	border: 1px #000000 solid;
	padding: 5px;
	margin: 0px;
	vertical-align: middle;
}
</style>
</head>
<body>
<div align="center" class="a_">
<h2>FUNDACIÓN ASESORES PARA EL DESARROLLO</h2>
<p align="left"><b>Fecha:</b> <?php echo date('d/m/Y');?></p>
<p align="left"><b>Modalidad:</b> <?php echo $capacitacion['nombre_modalidad'];?></p>
<p align="left"><b>Capacitacion:</b> <?php echo $capacitacion['nombre_capacitacion'];?></p>
<p align="left"><b>Nombre del Evento:</b> <?php echo $modulo['nombre_modulo'];?></p>
<p align="left"><b>Dirigido a:</b> <?php echo $capacitacion['dirigido'];?></p>
<p align="left"><b>Lugar:</b> <?php echo $modulo['nombre_lugar'];?></p>
<p align="left"><b>Facilitadores:</b>
  <?php 
					$conta=count($modulo['facilitadores_nombres[]']); 
					$van=0; 
					foreach ($modulo['facilitadores_nombres[]'] as $valor)
					{
						$van++;
						echo $valor;
						if($conta!=$van)
						{
							echo ", ";
							}
					} 
					?>
</p>
<table width="100%" class="l_tabla">
  <tr>
    <td align="center"><h3>#</h3></td>
    <td align="center"><h3>DUI</h3></td>
    <td align="center"><h3>Nombres</h3></td>
    <td align="center"><h3>Cooperativa</h3></td>
    <td align="center"><h3>Sucursal</h3></td>
    <td align="center"><h3>Cargo</h3></td>
    <td align="center"><h3>Firma</h3></td>
    <td align="center"><h3>e-mail</h3></td>
  </tr>
  <?php
						$contador_persona=1;
                        foreach($nombres_personas as $valor)
						{
							?>
  <tr>
    <td><p align="center"><?php echo $contador_persona;?></p></td>
    <td><p><?php echo $valor['dui'];?></p></td>
    <td><p><?php echo $valor['apellidos'].", ".$valor['nombres'];?></p></td>
    <td><p><?php echo $valor['nombre_cooperativa'];?></p></td>
    <td><p><?php echo $valor['nombre_sucursal'];?></p></td>
    <td><p><?php echo $valor['nombre_cargo'];?></p></td>
    <td width="100">&nbsp;</td>
    <td><p><?php echo $valor['correo'];?></p></td>
  </tr>
  <?php
							$contador_persona++;
						}
						?>
</table>
</div>
</body>
</html>