<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
</head>
<body>
        <?php
if($listado)
{
	?>
        <table id="example" class="display" >
          <thead>
            <tr>
              <th>N° OFERTA</th>
              <th>SERVICIO</th>
              <th>TÍTULO</th>
              <th>COOPERATIVA</th>
              <th>FECHA DE ENVÍO AL SOLICITANTE</th>
              <th>RESOLUCIÓN</th>
              <th>Vigencia de la Oferta</th>
              <th>Fecha de Aceptada</th>
              <th>Días efectivos de resolución</th>
              <th>INICIA</th>
              <th>FINALIZA</th>
              <th>Dias Habiles</th>
              <th>ESTADO</th>
              <th>FECHA DE ENTREGA</th>
              <th>Días efectivos</th>
              <th>MONTO</th>
              <th>OBSERVACIÓN</th>
              <th>MONTOS</th>
              
            </tr>
          </thead>
          <tbody>
            <?php
		foreach($listado as $valor)
		{
			?>
            <tr class="gradeA">
              <td><?php echo $valor['codigo_oferta'];?></td>
              <td><?php echo $valor['nombre_servicio'];?></td>
              <td><?php echo $valor['nombre_capacitacion'];?></td>
              <td><?php echo $valor['cooperativa'];?></td>
              <td><?php echo $valor['fecha_envio_solicitante'];?></td>
              <td><?php echo $valor['nombre_resolucion'];?></td>
              <?php  
	 $vigencia= contar_dias($valor['fecha_envio_solicitante'],date("Y-m-d"));
	  ?>
              <td style="color:<?php if($vigencia>=30){ echo "red;";}else{echo "black;";}?>"><?php 
	  echo $vigencia;
	  ?></td>
              <td><?php echo validar_fecha($valor['fecha_aceptada']);?></td>
              <td><?php echo contar_dias($valor['fecha_envio_solicitante'],$valor['fecha_aceptada']);?></td>
              <td><?php echo validar_fecha($valor['fecha_inicio']);?></td>
              <td><?php echo validar_fecha($valor['fecha_fin']);?></td>
              <td><?php echo eva_dias_f(DiasHabiles($valor['fecha_inicio'],$valor['fecha_fin'] ));?></td>
              <td><?php echo $valor['nombre_estado'];?></td>
              <td><?php echo validar_fecha($valor['fecha_entrega']);?></td>
              <td><?php echo eva_dias_f(DiasHabiles($valor['fecha_inicio'],$valor['fecha_entrega'] ));?></td>
              <td><?php echo $valor['monto'];?></td>
              <td><?php echo $valor['observacion'];?></td>
              <td><?php echo $valor['montos'];?></td>
             
            </tr>
            <?php
		}
		?>
          </tbody>
        </table>
        <?php
}
?>
</body>
</html>