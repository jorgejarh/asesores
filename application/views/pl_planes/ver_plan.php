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
  <h2 align="center"><?php echo $datos['nombre_plan'];?></h2>
    <table align="center" cellpadding="0" cellspacing="0" class="borde_all">
    	<?php
        foreach($datos['modalidades'] as $modalidad)
		{
			?>
            <tr>
                <td align="left" valign="middle" class="borde_">
                	<h3 align="center"><?php echo $modalidad['nombre_modalidad'];?></h3>
                    <?php
                    if($modalidad['temas'])
					{
						?>
                        <table align="center" cellpadding="0" cellspacing="0" width="100%">
                        	
							<?php
                            foreach($modalidad['temas'] as $tema)
                            {
                                ?>
                                <tr>
                                	<td align="center" valign="middle" class="borde_tema" width="280"> <h4><?php echo $tema['nombre_capacitacion'];?> ($ <?php
                                    $total_tema=0.00;
									if($tema['modulos'])
									{
										foreach($tema['modulos'] as $modulo)
										{
											if($modulo['rubros'])
											{
												foreach($modulo['rubros'] as $rubro)
												{
													if($rubro['detalle'])
													{
														foreach($rubro['detalle'] as $detalle)
														{
															$total_tema+=($detalle['unidades']*$detalle['costo']);
														}
													}
												}
											}
										}
									}
									echo number_format($total_tema,2);
									?>)</h4></td>
                                    <td align="left" valign="middle">
                                    	<?php
                                        if($tema['modulos'])
										{
											?>
                                            <table cellpadding="0" cellspacing="0" width="100%">
                                            	<?php
                                                foreach($tema['modulos'] as $modulo)
												{
													?>
                                                    <tr>
                                                		<td align="left" valign="middle" class="borde_modulo" ><p><?php echo $modulo['nombre_modulo'];?> ($ <?php
                                                        $total_modulo=00.00;
														if($modulo['rubros'])
														{
															foreach($modulo['rubros'] as $rubro)
															{
																if($rubro['detalle'])
																{
																	foreach($rubro['detalle'] as $detalle)
																	{
																		$total_modulo+=($detalle['unidades']*$detalle['costo']);
																	}
																}
															}
														}
														echo number_format($total_modulo,2);
														?>)</p></td>
                                                        <td align="right" valign="middle" class="borde_fecha" width="100" ><p><b><?php echo $modulo['fecha_prevista'];?></b></p></td>
                                                	</tr>
                                                    <?php
												}
												?>
                                            </table>
                                            <?php
										}
										?>
                                    </td>
                                </tr>
                                <?php
                            }
							?>
                        </table>
                        <?php
					}
					?>
                </td>
            </tr>    
            <?php
		}
		?>
    	
    </table>
</div>
</body>
</html>