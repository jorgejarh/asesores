<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title><?php echo "Presupuesto";?></title>
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
.div_imprimir {
	position:absolute;
	right:0px;
	top:0px;
}
.div_imprimir .opciones_ {
	background: #FFF;
	position:absolute;
	right:0px;
	top:0px;
	list-style:none;
	text-align:center;
	padding:0px;
	margin:0px;
	width:150px;
}
.div_imprimir .opciones_ li {
	border:1px solid #CCC;
	padding:5px;
}
.div_imprimir .opciones_ li:hover {
	background:#CCC;
}
.div_imprimir .opciones_ li a {
	text-decoration:none;
	color:#333;
}
.cuadro td {
	border:#000 solid 1px;
	padding:5px;
}
p {
	margin:5px;
}

.borde_all
{
	border:1px #000000 solid;
}

.borde_
{
	border-right:1px #000000 solid;
	border-top:1px #000000 solid;
	border-left:1px #000000 solid;
	
}

.borde_tema
{
	border-right:1px #000000 solid;
	border-top:1px #000000 solid;
}

.borde_modulo
{
	border-top:1px #000000 solid;
}
.borde_fecha
{
	border-left:1px #000000 solid;
	border-top:1px #000000 solid;
}
table
{
	margin:0;
	padding:0;
}
h1,h2,h3,h4
{
	margin:5px;
}
.t td
{
	border:#666 1px solid;
}
</style>
</head>

<body>
<div style="width:900px; margin:auto;" align="center">
  <div style="position:relative; " align="right">
    <div class="div_imprimir"><?php echo img(array('src'=>'public/img/icono-impresora.jpg','width'=>50));?> 
      <ul class="opciones_">
        <li ><a href="<?php echo site_url('pl_planes/ver_plan/'.$datos['id_plan']."/web");?>" target="_blank">Desde la web</a></li>
        <!--<li><a  href="<?php echo site_url('pl_planes/ver_plan/'.$datos['id_plan']."/pdf");?>" target="_blank">Exportar a pdf</a></li>-->
        <li><a href="<?php echo site_url('pl_planes/ver_plan/'.$datos['id_plan']."/excel");?>" target="_blank">Exportar a Excel</a></li>
      </ul> 
    </div>
  </div>
  <h2 align="center"><?php echo $datos['nombre_plan'];?> ($ <?php

	echo number_format(obtener_costo_plan($datos['id_plan']),2);
  
  ?>)</h2>
<p>&nbsp;</p>  	
    <table align="center" cellpadding="0" cellspacing="0" class="t">
    	<tr>
        	<td align="center" valign="middle"><b>Modalidad</b></td>
            <td align="center" valign="middle"><b>Costo Modalidad</b></td>
            <td align="center" valign="middle"><b>Tema</b></td>
            <td align="center" valign="middle"><b>Costo Tema</b></td>
            <td align="center" valign="middle"><b>Modulo</b></td>
            <td align="center" valign="middle"><b>Costo Modulo</b></td>
            <td align="center" valign="middle" width="120"><b>Fecha inicio</b></td>
            <td align="center" valign="middle" width="120"><b>Fecha Fin</b></td>
        </tr>
    	<?php
        foreach($datos['modalidades'] as $modalidad)
		{
			?>
            <tr>
                <td align="left" valign="middle">
                	<h3 align="center"><?php echo $modalidad['nombre_modalidad'];?></h3>
                </td>
                <td align="center" valign="middle">
                	<?php
					echo number_format(obtener_costo_plan_modalidad($modalidad['id_plan_modalidad']),2)
					?>
                </td>
                    <?php
                    if($modalidad['temas'])
					{
						$count_tema=count($modalidad['temas']);
						$van_tema=0;
                            foreach($modalidad['temas'] as $tema)
                            {
								$van_tema++;
                                ?>
                                	<td align="left" valign="middle" > <h4><?php echo $tema['nombre_capacitacion'];?></h4></td>
                                    <td align="center" valign="middle"><?php echo number_format(obtener_costo_capacitacion($tema['id_capacitacion']),2);?></td>
                                    	
										<?php
                                        if($tema['modulos'])
										{
											$count_modulo=count($tema['modulos']);
											$van_modulo=0;
                                                foreach($tema['modulos'] as $modulo)
												{
													$van_modulo++;
													?>
                                                		<td align="left" valign="middle" ><p><?php echo $modulo['nombre_modulo'];?></p></td>
                                                        <td align="center" valign="middle"><?php echo number_format(obtener_costo_modulo($modulo['id_modulo']),2); ?></td>
                                                        <td align="center" valign="middle"><?php echo date(date('d/m/Y'),strtotime($modulo['fecha_prevista']));?></td>
                                                        <td align="center" valign="middle"><?php echo date(date('d/m/Y'),strtotime($modulo['fecha_prevista_fin']));?></td>
                                                    </tr>
                                                    
                                                    <?php
                                                    if($van_modulo!=$count_modulo)
													{
													?>
                                                    <tr>
                                                    	<td>&nbsp;</td>
                                                        <td>&nbsp;</td>
                                                        <td>&nbsp;</td>
                                                        <td>&nbsp;</td>
                                                    <?php
													}
													
												}
										}
								
								if($count_tema!=$van_tema)
								{
								?>
                                <tr>
                                    <td>&nbsp;</td>
                                    <td>&nbsp;</td>

                                
                                <?php
								}
                            }

					}

		}
		?>
    	
    </table>
   
</div>
</body>
</html>