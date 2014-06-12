 <?php
$meses = array("Enero","Febrero","Marzo","Abril","Mayo","Junio","Julio","Agosto","Septiembre","Octubre","Noviembre","Diciembre");

if(!($this->input->post('f_ini') && $this->input->post('f_fin')))
{
	die("Fechas Requeridas");
}


$f_ini=strtotime($this->input->post('f_ini'));
$f_fin=strtotime($this->input->post('f_fin')." 23:59:59");
/*
echo "<pre>";
 print_r($modulos);
 echo "</pre>";*/
if($modulos)
{
	?>
  <table id="example" class="display" >
    <thead>
      <tr>
        <th>Fecha</th>
        <th>Concepto</th>
        <th>Cargo</th>
        <th>Abono</th>
        <th>Saldo</th>
      </tr>
    </thead>
    <tbody>
    <?php
     $contador=0;
			$saldo=0;
            foreach($modulos as $valor)
			{
				$f_act=strtotime($valor['fecha_creacion']);
				if($f_act>=$f_ini && $f_act<=$f_fin )
				{//if
				$contador++;
				$saldo+=$valor['saldo'];
				?>
                <tr class="gradeA">
                	<td align="center"><?php echo date('d/m/Y',strtotime( $valor['fecha_creacion']));?></td>
                    <td align="left">Inscripcion de <?php echo $valor['num_personas'];?> persona(s) en <?php echo $valor['nombre_modulo'];?></td>
                    <td align="center">$ <?php echo number_format($valor['saldo'],2);?></td>
                    <td align="center">$ <?php echo number_format(0,2);?></td>
                    <td align="center">$ <?php  echo number_format($saldo,2);?></td>
                </tr>
                <?php
						foreach($valor['descuentos'] as $valor_des)
						{
							$canti=($valor_des['descuento']/100)*$valor['saldo'];
							$contador++;
							$saldo-=$canti;
							?>
							<tr class="gradeA">
								<td align="center"><?php echo date('d/m/Y',strtotime( $valor_des['f_creacion']));?></td>
								<td align="left">Descuento (<?php echo $valor_des['descuento']."%"; ?>) de $ <?php echo $canti;?> a <?php echo $valor['nombre_modulo'];?></td>
								<td align="center">$ <?php echo number_format(0,2);?></td>
								<td align="center">$ <?php echo number_format($canti,2);?></td>
								<td align="center">$ <?php  echo number_format($saldo,2);?></td>
							</tr>
							<?php
							
						}
					
						foreach($valor['abonos'] as $valor_2)
						{
							$f_act1=strtotime($valor_2['fecha_creacion']);
							if($f_act1>=$f_ini && $f_act1<=$f_fin )
							{//if
							$contador++;
							$saldo-=$valor_2['cantidad'];
							?>
							<tr class="gradeA">
								<td align="center"><?php echo date('d/m/Y',strtotime( $valor_2['fecha_creacion']));?></td>
								<td align="left">Abono de $ <?php echo $valor_2['cantidad'];?> a <?php echo $valor['nombre_modulo'];?></td>
								<td align="center">$ <?php echo number_format(0,2);?></td>
								<td align="center">$ <?php echo number_format($valor_2['cantidad'],2);?></td>
								<td align="center">$ <?php  echo number_format($saldo,2);?></td>
							</tr>
							<?php
							}//if
						}
					
				}//if
				
			}
			?>
    </tbody>
  </table>
  <?php
}
?>
<p align="center" onClick="ver_estado(<?php echo $cooperativa['id_cooperativa'];?>);" style="cursor:pointer;">Imprimir</p>