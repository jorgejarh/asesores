<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title><?php echo "Presupuesto";?></title>
<style>
.cuadro td {
	border:#000 solid 1px;
	padding:5px;
}
p{
	margin:5px;
}
</style>
</head>

<body>
<?php 
    $fecha_i     = fecha_es($datos['fecha_prevista']); 
    $fecha_f     = fecha_es($datos['fecha_prevista_fin']);
    $costo_total = 0.00;
    foreach($datos['rubros'] as $rubros)
    {
      $total_rubro=0.00;
      if($rubros['sub'])
      {
        foreach($rubros['sub'] as $subrubro)
        {
          $total_rubro+=($subrubro['unidades']*$subrubro['costo']);
        }
      }
      $costo_total+=$total_rubro;
    } 
 ?>
<div style="width:900px; margin:auto;" align="center" style="font-size:12px;">
  
  <p><b>Presupuesto de eventos de Capacitacion</b></p>
  <p><b><?php echo $datos['data_modalidad_plan']['nombre_plan'];?></b></p>
  <table align="center" width="100%" style="font-size:10px;">
    <tr>
      <td align="left" valign="middle"><p><b>Modalidad: </b></p></td>
      <td align="left" valign="middle"><p><?php echo $datos['data_modalidad_plan']['nombre_modalidad'];?></p></td>
    </tr>
    <tr>
      <td align="left" valign="middle"><p><b>Tema: </b></p></td>
      <td align="left" valign="middle"><p><?php echo $datos['data_capacitacion']['nombre_capacitacion'];?></p></td>
    </tr>
    <tr>
      <td align="left" valign="middle"><p><b>Modulo: </b></p></td>
      <td align="left" valign="middle"><p><?php echo $datos['nombre_modulo'];?></p></td>
    </tr>
    <tr>
      <td align="left" valign="middle"><p><b>Lugar: </b></p></td>
      <td align="left" valign="middle"><p><?php echo $datos['lugar']['nombre_lugar'];?></p></td>
    </tr>
    <tr>
      <td align="left" valign="middle"><p><b># Partic. Estimados: </b></p></td>
      <td align="left" valign="middle"><p><?php echo $datos['data_capacitacion']['n_participantes'];?></p></td>
    </tr>
    <tr>
      <td align="left" valign="middle"><p><b>Fecha Prevista: </b></p></td>
      <td align="left" valign="middle"><p><?php echo "Del ".$fecha_i['dia']." - ".$fecha_i['mes_nombre']." - ".$fecha_i['anio']." Al ".$fecha_f['dia']." - ".$fecha_f['mes_nombre']." - ".$fecha_f['anio']; ?></p></td>
    </tr>
    <tr>
      <td align="left" valign="top"><p><b>Facilitador(es): </b></p></td>
      <td align="left" valign="top"><?php if($datos['facilitadores']){ foreach($datos['facilitadores'] as $valor){?>- <?php echo $valor['nombres']." ".$valor['apellidos'];?><br><?php } } ?></td>
    </tr>
    <tr>
      <td align="left" valign="middle"><p><b>Costo Total: </b></p></td>
      <td align="left" valign="middle"><p><?php echo "$ ".number_format($costo_total,2); ?></p></td>
    </tr>
    <tr>
      <td align="left" valign="middle"><p><b>Costo Unitario: </b></p></td>
      <td align="left" valign="middle"><p><?php echo "$ ".number_format($costo_total/$datos['data_capacitacion']['n_participantes'],2);?></p></td>
    </tr>
  </table>
  <p><b><?php echo "PRESUPUESTO";?></b></p>  
  <table  class="cuadro" cellpadding="0" cellspacing="0" width="100%" style="font-size:10px;">
    <tr>
      <td align="center" valign="middle"><b>Rubros</b></td>
      <td align="center" valign="middle"><b>Unidades</b></td>
      <td align="center" valign="middle"><b>Costo Unit.</b></td>
      <td align="center" valign="middle"><b>Total</b></td>
    </tr>
    <?php
  if($datos['rubros'])
	{
		foreach($datos['rubros'] as $rubros)
		{
			$total_rubro=0.00;
			if($rubros['sub'])
			{
				foreach($rubros['sub'] as $subrubro)
				{
					$total_rubro+=($subrubro['unidades']*$subrubro['costo']);
				}
			}
			?>
    <tr>
      <td align="left" valign="middle"><br><br><b>
        <?php
                echo $rubros['nombre'];
				?>
        </b><br></td>
      <td align="center" valign="middle">&nbsp;</td>
      <td align="center" valign="middle">&nbsp;</td>
      <td align="right" valign="middle"><span style="float:left;margin-left:5px;"><br>$</span><b><?php echo number_format($total_rubro,2);?>&nbsp;&nbsp;&nbsp;</b><br></td>
    </tr>
    <?php
			$total_rubro=0.00;
			if($rubros['sub'])
			{
				foreach($rubros['sub'] as $subrubro)
				{
					$total_subrubro=($subrubro['unidades']*$subrubro['costo']);
					?>
    <tr>
      <td align="left" valign="middle"><br><br>&nbsp;&nbsp;&nbsp;
        <?php
                echo $subrubro['nombre'];
                        ?><br></td>
      <td align="center" valign="middle"><br><br><?php echo $subrubro['unidades'];?><br></td>
      <td align="right" valign="middle"><span style="float:left;margin-left:5px;"><br>$</span><?php echo number_format($subrubro['costo'],2);?>&nbsp;&nbsp;&nbsp;<br></td>
      <td align="right" valign="middle"><span style="float:left;margin-left:5px;"><br>$</span><?php echo number_format($total_subrubro,2);?>&nbsp;&nbsp;&nbsp;<br></td>
    </tr>
    <?php
				}
			}
			
			
			
			
		}
	}
	?>
  </table>
</div>
</div>
</body>
</html>