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
	//window.print() ;
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
    <h3 align="center">Fundacion Asesores para el desarrollo</h3>
    <h3 align="center">Control de Cobros de servicios por cooperativa</h3>
    <div>
    	<p>Cooperativa: <b><?php echo $cooperativa['cooperativa'];?></b></p>
        
        <table width="100%">
        	<tr>
            	<td align="center"><p><b>Fecha</b></p></td>
                <td align="center"><p><b>Concepto</b></p></td>
                <td align="center"><p><b>Cargo</b></p></td>
                <td align="center"><p><b>Abono</b></p></td>
                <td align="center"><p><b>Saldo</b></p></td>
            </tr>
            <?php
            foreach($inscripciones as $valor)
			{
				
				?>
                <tr>
                	<td align="center"><p><?php echo date('d/m/Y',strtotime( $valor['f_creacion']));?></p></td>
                    <td align="center"><p>Inscripcion de <?php echo $valor['cantidad_inscritos'];?> persona(s) en <?php echo $valor['nombre_capacitacion'];?></p></td>
                    <td align="center"><p>$ <?php $debe=$valor['cantidad_inscritos']*$valor['precio_capacitacion'];$debe=$debe-($debe*($valor['descuento']/100)); echo number_format($debe,2);?></p></td>
                    <td align="center"><p>$ <?php echo number_format($valor['cantidad_pagada'],2);?></p></td>
                    <td align="center"><p>$ <?php echo number_format($debe-$valor['cantidad_pagada'],2);?></p></td>
                </tr>
                <?php
			}
			?>
        </table>
    </div>
  </div>
</div>
<div class="copia2"></div>
</body>
</html>