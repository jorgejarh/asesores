<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Resultados de Evaluación</title>
<script type="text/javascript" language="javascript" src="<?php echo base_url();?>public/js/datatable/media/js/jquery.js"></script>
<script type="text/javascript" language="javascript" src="<?php echo base_url();?>public/js/graficos/highcharts.js"></script>
<script type="text/javascript" language="javascript" src="<?php echo base_url();?>public/js/graficos/modules/data.js"></script>
<script type="text/javascript" language="javascript" src="<?php echo base_url();?>public/js/graficos/modules/exporting.js"></script>
<style type="text/css">

table
{
	border-collapse:collapse;}
p{
	margin:2px;}
table td
{
	vertical-align:top;
	padding:5px;
	margin:0px;
}
table tr
{
	border:none;
	padding:0px;
	margin:0px;
}
.tabla_uno td
{
	padding:2px;}

.tabla_uno
{
	width:400px;
}
.borde
{
	border:1px #000000 solid;
}
.borde_left
{
	border-left:1px #000000 solid;
}
.ocultar
{
	display:none;
}

.div_grafico
{
	width:400px;
	margin:auto;
	
}
</style>
</head>
<body>
<div style="width:900px; margin:auto;" align="center"> 
	<h3 align="center">Resultados de Evaluación</h3>
    <div align="left">
    	<table>
        	<tr>
            	<td><p>Evento:</p></td>
                <td><p><b><?php echo $modulo['nombre_modulo'];?></b></p></td>
            </tr>
            <tr>
            	<td><p>Fecha:</p></td>
                <td><p><b><?php echo date('d/m/Y',strtotime($modulo['fecha_prevista']));?></b></p></td>
            </tr>
            <tr>
            	<td><p>Facilitador(es):</p></td>
                <td><?php
                foreach($modulo['nombres_facilitadores'] as $valor)
				{
					?>
                    <p><b>- <?php echo $valor['nombres']." ".$valor['apellidos'];?></b></p>
                    <?php
				}
				?></td>
            </tr>
            <tr>
            	<td><p>Exelente: </p><p>Muy Bueno: </p><p>Bueno: </p><p>Regular: </p><p>Malo: </p></td>
                <td><?php for($i=1;$i<=5;$i++){ ?><p><?php echo $i;?></p><?php }?></td>
            </tr>
        </table>
        <div style="height:15px;"></div>
        <?php
		$contador=0;
		$suma_resultados=0;
        foreach($resultados as $valor)
		{
			if($valor['aspectos'])
			{
				$contador++;
				?>
                <p><b><?php echo $contador;?></b> - <b class="nombre_cat"><?php echo $valor['nombre'];?></b></p>
                <table width="100%">
                	<tr>
                    	<td>
                        	<table class="tabla_uno" cellpadding="0" cellspacing="0">
                                <tr>
                                    <td align="center" class="borde"><p>ASPECTOS A CONSIDERAR</p></td>
                                    <td align="center" class="borde"><p>PUNTOS</p></td>
                                </tr>
                                <?php
                                $sum_aspecto=0;
                                foreach($valor['aspectos'] as $valor2)
                                {
                                    $sum_aspecto=$sum_aspecto+$valor2['nota'];
                                    ?>
                                <tr>
                                    <td align="left" class="borde_left"><p><?php echo $valor2['nombre'];?></p></td>
                                    <td align="right" class="borde"><p><?php echo $valor2['nota'];?></p></td>
                                </tr>
                                    <?php
                                }
                                ?>
                                <tr>
                                    <td align="right" class="borde"><p>PROMEDIO</p></td>
                                    <td align="right" class="borde"><p class="prom_cat"><?php echo number_format($sum_aspecto/count($valor['aspectos']),2);?></p></td>
                                </tr>
                            </table>
                        </td>
                        <td>
                        <table class="ocultar" id="tabla_<?php echo $contador;?>">
                            <thead>
                                <tr>
                                    <th></th>
                                    <th>PUNTOS</th>
                                </tr>
                            </thead>
                            <tbody>
                            <?php
                            	foreach($valor['aspectos'] as $valor2)
                                {
                                    
                                    ?>
                                <tr>
                                    <th><?php echo $valor2['nombre'];?></th>
                                    <td><?php echo $valor2['nota'];?></td>
                                </tr>
                                    <?php
                                }
                                ?>
                            </tbody>
                        </table>
                        <div id="grafico_<?php echo $contador;?>" class="div_grafico"></div>
                        <script type="text/javascript">
						$(function () {
							$('#grafico_<?php echo $contador;?>').highcharts({
								data: {
									table: document.getElementById('tabla_<?php echo $contador;?>')
								},
								chart: {
									type: 'line',
									height: 200
								},
								legend:{
									enabled:false
								},
								title: {
									text: ''
								},
								yAxis: {
									allowDecimals: false,
									title: {
										text: 'Puntos'
									},
									min:1
								},
								xAxis: {
									labels: {
										rotation: -90,
										align: 'right',
										style: {
											fontSize: '10px',
											fontFamily: 'Verdana, sans-serif',
											width:'70px'
										},
										useHTML:true
									}
								},
								tooltip: {
									formatter: function() {
										return '<b>'+ this.series.name +'</b><br/>'+
                    							this.point.y;// +' '+ this.point.name.toLowerCase();
									}
								}
							});
						});
						</script>
                        </td>
                    </tr>
                </table>
                
                <div style="height:15px;"></div>
                <?php
				$suma_resultados=$suma_resultados+($sum_aspecto/count($valor['aspectos']));
			}
			
		}
		?>
        <table class="tabla_uno" cellpadding="0" cellspacing="0">
            <tr>
                <td align="right" class="borde"><p><b>Promedio General</b></p></td>
                <td align="center" class="borde"><p><?php echo number_format($suma_resultados/$contador,2);?></p></td>
            </tr>
        </table>
        
         <table class="ocultar" id="tabla_general">
            <thead>
                <tr>
                    <th></th>
                    <th>PUNTOS</th>
                </tr>
            </thead>
            <tbody>
            
            </tbody>
        </table>
        <script type="text/javascript">
		$(document).ready(function(e) {
            $('.nombre_cat').each(function(index, element) {
				$('.prom_cat').each(function(index2, element2) 
				{
					if(index==index2)
					{
						$('#tabla_general tbody').append('<tr><th>'+$(element).html()+'</th><td>'+$(element2).html()+'</td></tr>');
					}
				});
                
            });
        });
		</script>
         <div style="height:25px;"></div>
        <div id="grafico_general" style="width:500px; margin:auto;">
        
        </div>
        <script type="text/javascript">
		$(function () {
			$('#grafico_general').highcharts({
				data: {
					table: document.getElementById('tabla_general')
				},
				chart: {
					type: 'line',
					height: 200
				},
				legend:{
					enabled:false
				},
				title: {
					text: ''
				},
				yAxis: {
					allowDecimals: false,
					title: {
						text: 'Puntos'
					},
					min:1
				},
				xAxis: {
					labels: {
						rotation: -45,
						align: 'right',
						style: {
							fontSize: '10px',
							fontFamily: 'Verdana, sans-serif',
							width:'70px'
						},
						useHTML:true
					}
				},
				tooltip: {
					formatter: function() {
						return '<b>'+ this.series.name +'</b><br/>'+
								this.point.y;// +' '+ this.point.name.toLowerCase();
					}
				}
			});
		});
		</script>
        <div style="height:25px;"></div>
        <p align="center"><a onclick="window.print();" href="#">Imprimir</a></p>
    </div>
</div>
</body>
</html>