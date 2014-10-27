<?php
/*
?>
<pre>
<?php
print_r($info);

?>
</pre>
<?php

exit;*/
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title><?php echo "Resultado Financiero";?></title>
<script type="text/javascript" language="javascript" src="<?php echo base_url();?>public/js/datatable/media/js/jquery.js"></script>
<script>
$(document).ready(function(event){
	//alert('ss');
	
	$('.div_imprimir .opciones_').hide();
	
	
	$('.div_imprimir').hover(function(){
		
			$(this).children('.opciones_').toggle('slow');
		
		},function(){
			$(this).children('.opciones_').toggle('slow');
			});
	
	});


</script>
<style>
body
{
	font-family:Calibri,Arial;
}
.gris_l
{
	background:#DDDDDD;
}
.gris_l_2
{
	background:#EEEEEE;
}


.div_imprimir {
	position: absolute;
	right: 0px;
	top: 0px;
}
.div_imprimir .opciones_ {
	background: #FFF;
	position: absolute;
	right: 0px;
	top: 0px;
	list-style: none;
	text-align: center;
	padding: 0px;
	margin: 0px;
	width: 150px;
}
.div_imprimir .opciones_ li {
	border: 1px solid #CCC;
	padding: 5px;
}
.div_imprimir .opciones_ li:hover {
	background: #CCC;
}
.div_imprimir .opciones_ li a {
	text-decoration: none;
	color: #333;
}
.cuadro td {
	border: #000 solid 1px;
	padding: 5px;
}
p {
	margin: 5px;
}

.texto_dinero
{
	text-align:right;
}
</style>
</head>

<body>

<div style="width:900px; margin:auto;" align="center">
<?php
/*
?>
  <div style="position:relative; " align="right">
    <div class="div_imprimir" style="display:none;"><?php echo img(array('src'=>'public/img/icono-impresora.jpg','width'=>50));?>
      <ul class="opciones_">
        <li ><a href="<?php echo site_url('pl_capacitaciones/ver_presupuesto/'.$datos['id_capacitacion']."/web");?>" target="_blank">Desde la web</a></li>
        <li><a  href="<?php echo site_url('pl_capacitaciones/ver_presupuesto/'.$datos['id_capacitacion']."/pdf");?>" target="_blank">Exportar a pdf</a></li>
        <li><a href="<?php echo site_url('pl_capacitaciones/ver_presupuesto/'.$datos['id_capacitacion']."/docx");?>" target="_blank">Exportar a word</a></li>
      </ul>
    </div>
  </div>
  <?php
*/
?>

  <h2 align="center">FUNDACION ASESORES PARA EL DESARROLLO</h2>
    <h2 align="center">RESLTADOS FINANCIEROS DEL EVENTO</h2>
  <table align="center" width="100%" >
    <tr>
      <td align="left" valign="middle"><p>EVENTO: <?php echo $info['nombre_capacitacion'];?></p></td>
      
    </tr>
    <tr>
      <td align="left" valign="middle"><p>DIRIGIDO A: <?php echo $info['dirigido'];?></p></td>
      
    </tr>
    <tr>
      <td align="left" valign="middle"><p>CUOTA AFILIADAS: $<?php echo $info['cuota_1'];?></p></td>
      
    </tr>
     <tr>
      <td align="left" valign="middle"><p>CUOTA NO AFILIADAS: $<?php echo $info['cuota_2'];?></p></td>
      
    </tr>
  </table>
  
  <table width="100%" class="cuadro" cellpadding="0" cellspacing="0" >
    <tr class="">
    	<td>Nº</td>
       	<td>COOPERATIVAS</td>
        <td>NUMERO PARTICIPANTES</td>
        <td>VALOR</td>
        <td>TOTAL POR COOPERATIVA</td>
        <td>DESCUENTO</td>
    </tr>
    <?php
	$conta=0;
	foreach($datos as $dato)
	{
	$conta++;
    ?>
    <tr class="" >
    	<td><?php echo $conta;?></td>
        <td><?php echo $dato['nombre_cooperativa'];?></td>
        <td align="center"><?php echo $dato['numero_participantes'];?></td>
        <td class="texto_dinero ">$<?php echo $dato['valor'];?></td>
        <td class="texto_dinero ">$<?php echo $dato['total'];?></td>
        <td><?php echo $dato['descuento'];?></td>
       
    </tr>
    <?php
	}
    ?>
  </table>
  
  
  
</div>
</body>
</html>