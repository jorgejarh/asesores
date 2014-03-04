<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title><?php echo "Imprimir";?></title>
<script type="text/javascript" language="javascript" src="<?php echo base_url();?>public/js/datatable/media/js/jquery.js"></script>
<script>
$(document).ready(function(event){
	//alert('ss');
	
	//window.print() ;
});
</script>
<style type="text/css">
body
{
	font-family:Calibri,Arial;
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
<div style="width:900px; margin:auto;" align="left">
  
  <h2 align="center">Nota de Cargo N. <?php echo $datos['id_nota_cargo'];?></h2>
  <p align="right">Por $ <?php echo $datos['cantidad_por'];?> M&aacute;s IVA</p>
  <p align="left"> <?php echo ($datos['cantidad_por']=="C")?'Cooperativa':'Persona Natural';?></p>
  <p>Hemos cargado a su cuenta por Cobrar en la Fundacion Asesores para el Desarrollo, la suma de :</p>  
  <p><?php echo $datos['cantidad_letras'];?></p>
  <table align="center" width="100%">
  	<tr>
    	<td align="center">Inversion Individual: $ <?php echo $datos['inversion_individual'];?></td>
        <td align="center">Inversion Total: $ <?php echo $datos['inversion_total'];?></td>
    </tr>
  </table>
  
 
  
  <p>San Salvador, <?php echo date("d",strtotime($datos['fecha_creacion']));?> de <?php echo date("F",strtotime($datos['fecha_creacion']));?> de <?php echo date("Y",strtotime($datos['fecha_creacion']));?></p>
  
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
</body>
</html>