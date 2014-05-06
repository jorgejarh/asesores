<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<script type="text/javascript" language="javascript" src="<?php echo base_url();?>public/js/datatable/media/js/jquery.js"></script>
<style type="text/css">
body
{
	font-family:Calibri,Arial;
}
.page_
{
	border:1px #999999 solid;
	padding:5px;
	width:700px;
	margin:auto;
}

.letra_verde
{
	color: #090;
	font-weight:bold;
}
</style>
</head>
<body>
<?php
$precio_indi=obtener_precio_capacitacion($capacitacion['id_capacitacion']);
$cantidad_personas=count($personas);
$total_pagar=$precio_indi*$cantidad_personas;
?>
	<div class="page_">
    	<table width="100%">
        	<tr>
            	<td align="left"><?php echo img("public/images/asesores-png-trans.png");?></td>
                <td align="left"><p class="letra_verde">NOTA DE CARGO</p></td>
                <td align="right">&nbsp;</td>
            </tr>
        </table>
        <div>
        	<table width="100%">
            	<tr>
                	<td align="left"><p>Cooperativa: <b><?php echo $cooperativa['cooperativa'];?></b></p></td>
                    <td align="right"><p>Por $: <b><?php echo $total_pagar;?></b></p></td>
                </tr>
            </table>
        </div>
        <div>
        	<p>Hemos cargado a su cuenta por Cobrar en la Fundacion Asesores para el Desarrollo, la suma de : <b><?php
			 $letra= new EnLetras();
			echo $letra->ValorEnLetras($total_pagar,"Dolares");?></b></p>
        </div>
        <div>
        	<p>Por Participación en jornada de capacitación: <b><?php echo ($capacitacion['nombre_capacitacion']);?></b></p>
        </div>
        <div>
        	<p>Participantes: </p>
            <ol>
            	<?php
                foreach($personas as $valor)
				{
					?>
                    <li><?php echo ($valor['nombres']." ".$valor['apellidos']);?></li>
                    <?php
				}
				?>
            </ol>
        </div>
        <div>
        	<table width="100%">
            	<tr>
                	<td align="center"><p>Inversión Individual: <b>$ <?php echo $precio_indi;?></b></p> </td>
                    <td align="center"><p>Inversión Total: <b>$ <?php echo $total_pagar;?></b></p> </td>
            	</tr>
            </table>
        </div>
        <div>
        	<p>San Salvador, <?php echo date('d');?> de <?php echo date('m');?> de <?php echo date('Y');?></p>
        </div>
         <div>
        	<table width="100%">
            	<tr>
                	<td align="center"><p>Elaborado</p> </td>
                    <td align="center"><p>Autorizado</p> </td>
            	</tr>
            </table>
        </div>
    </div>
</body>
</html>