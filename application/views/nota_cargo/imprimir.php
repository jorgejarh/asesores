<?php
$meses = array("Enero","Febrero","Marzo","Abril","Mayo","Junio","Julio","Agosto","Septiembre","Octubre","Noviembre","Diciembre");
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title><?php echo "Imprimir";?></title>
<script type="text/javascript" language="javascript" src="<?php echo base_url();?>public/js/datatable/media/js/jquery.js"></script>
<script>
$(document).ready(function(event){
	//alert('ss');
	//$('.copia2').html($('.copia1').html());
	window.print() ;
});
</script>
<style type="text/css">
body {
	font-family: Calibri, Arial;
}
.cuadro td {
	border: #000 solid 1px;
	padding: 5px;
}
p {
	margin: 5px;
}
</style>
</head>
<body>
<div class="copia1">
  <div style="width:900px; margin:auto;" align="left">
    <h2 align="center">Nota de Cargo N. <?php echo $datos['id_nota_cargo'];?></h2>
    <p align="right">Por $ <b><?php echo $datos['cantidad_por'];?></b> M&aacute;s IVA</p>
    <p align="left"> <?php echo ($datos['tipo_persona']=="C")?'Cooperativa':'Persona Natural';?>: <b><?php echo $persona;?></b></p>
    <p>Hemos cargado a su cuenta por Cobrar en la Fundacion Asesores para el Desarrollo, la suma de :</p>
    <p><b><?php echo $datos['cantidad_letras'];?></b></p>
    <p align="center"><b>Participantes:</b></p>
    <div>
      <table align="center" width="80%">
        <tr>
          <?php
	$contador=0;
    foreach($personas as $valor)
	{
		$contador++;
		?>
          <td align="left"><?php echo $contador."- ".$valor['apellidos'].", ".$valor['nombres'];?></td>
          <?php
		if(($contador%2)==0)
		{
			?>
        </tr>
        <tr>
          <?php
		}
	}
	?>
        </tr>
      </table>
    </div>
    <br />
    <table align="center" width="100%">
      <tr>
        <td align="center">Inversion Individual: $ <b><?php echo $datos['inversion_individual'];?></b></td>
        <td align="center">Inversion Total: $ <b><?php echo $datos['inversion_total'];?></b></td>
      </tr>
    </table>
    <br />
    <p>San Salvador, <?php echo date("d",strtotime($datos['fecha_creacion']));?> de <?php echo $meses[date("n",strtotime($datos['fecha_creacion']))-1];?> de <?php echo date("Y",strtotime($datos['fecha_creacion']));?></p>
    <br />
    <table align="center" width="100%">
      <tr>
        <td align="center">___________________</td>
        <td align="center">___________________</td>
      </tr>
      <tr>
        <td align="center">Elaborado</td>
        <td align="center">Autorizado</td>
      </tr>
    </table>
  </div>
</div>
<div class="copia2"></div>
</body>
</html>