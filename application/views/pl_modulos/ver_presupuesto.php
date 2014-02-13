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
</style>
</head>

<body>
<div style="width:900px; margin:auto;" align="center">
  <div style="position:relative; " align="right">
    <div class="div_imprimir"><?php echo img(array('src'=>'public/img/icono-impresora.jpg','width'=>50));?>
      <ul class="opciones_">
        <li ><a href="<?php echo site_url('pl_modulos/ver_presupuesto/'.$datos['id_modulo']."/web");?>" target="_blank">Desde la web</a></li>
        <li><a  href="<?php echo site_url('pl_modulos/ver_presupuesto/'.$datos['id_modulo']."/pdf");?>" target="_blank">Exportar a pdf</a></li>
        <li><a href="<?php echo site_url('pl_modulos/ver_presupuesto/'.$datos['id_modulo']."/docx");?>" target="_blank">Exportar a word</a></li>
      </ul>
    </div>
  </div>
  <h2 align="center">Presupuesto de eventos de Capacitacion</h2>
  <h3 align="center"><?php echo $datos['data_modalidad_plan']['nombre_plan'];?></h3>
  <table align="center" width="80%" >
    <tr>
      <td align="left" valign="middle"><p><b>Modalidad: </b></p></td>
      <td align="left" valign="middle"><p><?php echo $datos['data_modalidad_plan']['nombre_modalidad'];?></p></td>
    </tr>
    <tr>
      <td align="left" valign="middle"><p><b>Nombre: </b></p></td>
      <td align="left" valign="middle"><p><?php echo $datos['data_capacitacion']['nombre_capacitacion'];?></p></td>
    </tr>
    <tr>
      <td align="left" valign="middle"><p><b>Modulo: </b></p></td>
      <td align="left" valign="middle"><p><?php echo $datos['nombre_modulo'];?></p></td>
    </tr>
    <tr>
      <td align="left" valign="middle"><p><b>Lugar: </b></p></td>
      <td align="left" valign="middle"><p><?php echo $datos['lugar']['nombre_lugar'];?></p></td>
    </tr>
    <tr>
      <td align="left" valign="middle"><p><b># Partic. Estimados: </b></p></td>
      <td align="left" valign="middle"><p>
          <?php $participantes=$datos['data_capacitacion']['n_participantes']+$datos['data_capacitacion']['n_participantes_no']+$datos['data_capacitacion']['n_participantes_ex']; echo $participantes;?>
        </p></td>
    </tr>
    <tr>
      <td align="left" valign="middle"><p><b>Fecha Prevista: </b></p></td>
      <td align="left" valign="middle"><p>
          <?php 
	  $fecha_i=fecha_es($datos['fecha_prevista']);
	  $fecha_f=fecha_es($datos['fecha_prevista_fin']);
	  echo "Del ".$fecha_i['dia']." - ".$fecha_i['mes_nombre']." - ".$fecha_i['anio']." Al ".$fecha_f['dia']." - ".$fecha_f['mes_nombre']." - ".$fecha_f['anio'];?>
        </p></td>
    </tr>
    <tr>
      <td align="left" valign="top"><p><b>Facilitador(es): </b></p></td>
      <td align="left" valign="top"><?php
      	if($datos['facilitadores'])
	  	{
			foreach($datos['facilitadores'] as $valor)
			{
				?>
        <p>- <?php echo $valor['nombres']." ".$valor['apellidos'];?></p>
        <?php
			}
		}
	  
	  ?></td>
    </tr>
    <tr>
      <td align="left" valign="middle"><p><b>Costo Total: </b></p></td>
      <td align="left" valign="middle"><p>
          <?php 
	  $costo_total=0.00;
	 	foreach($datos['rubros'] as $rubros)
		{
			$total_rubro=0.00;
			if($rubros['sub'])
			{
				foreach($rubros['sub'] as $subrubro)
				{
					$total_rubro+=($subrubro['unidades']*$subrubro['costo']);
				}
			}
			$costo_total+=$total_rubro;
		}
		echo "$ ".number_format($costo_total,2);
	  ?>
        </p></td>
    </tr>
    <tr>
      <td align="left" valign="middle"><p><b>Costo Unitario: </b></p></td>
      <td align="left" valign="middle"><p><?php echo "$ ".number_format($costo_total/$datos['data_capacitacion']['n_participantes'],2);?></p></td>
    </tr>
  </table>
  <h3 align="center"><?php echo "PRESUPUESTO";?></h3>
  <table width="80%" class="cuadro" cellpadding="0" cellspacing="0" >
    <tr class="gris_l">
      <td align="center" valign="middle"><b>Rubros</b></td>
      <td align="center" valign="middle"><b>Unidades</b></td>
      <td align="center" valign="middle"><b>Costo Unit.</b></td>
      <td align="center" valign="middle"><b>Total</b></td>
    </tr>
    <?php
    if($datos['rubros'])
	{
		foreach($datos['rubros'] as $rubros)
		{
			$total_rubro=0.00;
			if($rubros['sub'])
			{
				foreach($rubros['sub'] as $subrubro)
				{
					$total_rubro+=($subrubro['unidades']*$subrubro['costo']);
				}
			}
			?>
    <tr class="gris_l_2" >
      <td align="left" valign="middle"><b>
        <?php
                echo $rubros['nombre'];
				?>
        </b></td>
      <td align="center" valign="middle">&nbsp;</td>
      <td align="center" valign="middle">&nbsp;</td>
      <td align="right" valign="middle"><span style="float:left; margin-left:5px;">$</span> <b><?php echo number_format($total_rubro,2);?></b></td>
    </tr>
    <?php
			$total_rubro=0.00;
			if($rubros['sub'])
			{
				foreach($rubros['sub'] as $subrubro)
				{
					$total_subrubro=($subrubro['unidades']*$subrubro['costo']);
					?>
    <tr>
      <td align="left" valign="middle">&nbsp;&nbsp;
        <?php
                        echo $subrubro['nombre'];
                        ?></td>
      <td align="center" valign="middle"><?php echo $subrubro['unidades'];?></td>
      <td align="right" valign="middle"><span style="float:left;margin-left:5px;">$</span> <?php echo number_format($subrubro['costo'],2);?></td>
      <td align="right" valign="middle"><span style="float:left; margin-left:5px;">$</span> <?php echo number_format($total_subrubro,2);?></td>
    </tr>
    <?php
				}
			}
		}
	}
	?>
  </table>
  <div style="margin-top:40px;">
  	 <h2 align="center">RESULTADOS FINANCIEROS ESTIMADOS</h2>
     <table width="80%" class="cuadro">
     	 <tr class="gris_l">
        	<td align="center"><b>Detalle</b></td>
            <td align="center"><b>Valor</b></td>
        </tr>
     	<tr>
        	<td align="left"><p>Número estimado de Participantes de Cooperativas Afiliadas</p></td>
            <td align="center"><p><?php echo $datos['data_capacitacion']['n_participantes'];?></p></td>
        </tr>
        <tr>
        	<td align="left"><p>Número de participantes de cooperativas no afiliadas  </p></td>
            <td align="center"><p><?php echo $datos['data_capacitacion']['n_participantes_no'];?></p></td>
        </tr>
        <tr>
        	<td align="left"><p>Número de participantes extyranjeros  confirmados al evento  </p></td>
            <td align="center"><p><?php echo $datos['data_capacitacion']['n_participantes_ex'];?></p></td>
        </tr>
        <tr>
        	<td align="left"><p>Costo del Evento a cooperativas afiliadas  </p></td>
            <td align="center"><p>$ <?php echo $datos['precio_venta'];?></p></td>
        </tr>
        <tr>
        	<td align="left"><p>Costo del Evento a cooperativas no afiliadas </p></td>
            <td align="center"><p>$ <?php echo $datos['precio_venta_no'];?></p></td>
        </tr>
        <tr>
        	<td align="left"><p>Costo del Evento a Internacionales  </p></td>
            <td align="center"><p>$ <?php echo $datos['precio_venta_ex'];?></p></td>
        </tr>
        <tr class="gris_l">
        	<td align="left" colspan="2"><b>RESULTADOS ESTIMADOS DEL EVENTO</b></td>
           
        </tr>
        <tr>
        	<td align="left"><p>Ingreso Proyectado de participantes de cooperativas afiliadas </p></td>
            <td align="center"><p>$ <?php $total_afiliados=$datos['data_capacitacion']['n_participantes']*$datos['precio_venta']; echo formato_dinero($total_afiliados);?></p></td>
        </tr>
        <tr>
        	<td align="left"><p>Ingreso Proyectado de participantes de cooperativas no afiliadas </p></td>
            <td align="center"><p>$ <?php $total_no_afiliados=$datos['data_capacitacion']['n_participantes_no']*$datos['precio_venta_no']; echo formato_dinero($total_no_afiliados);?></p></td>
        </tr>
        <tr>
        	<td align="left"><p>Ingreso Proyectado de Extranjeros  </p></td>
            <td align="center"><p>$ <?php $total_extranjeros=$datos['data_capacitacion']['n_participantes_ex']*$datos['precio_venta_ex']; echo formato_dinero($total_extranjeros);?></p></td>
        </tr>
        <tr>
        	<td align="left"><p>Total ingresos Proyectados </p></td>
            <td align="center"><p>$ <?php $total_proyectado=$total_afiliados+$total_no_afiliados+$total_extranjeros; echo formato_dinero($total_proyectado);?></p></td>
        </tr>
         <tr>
        	<td align="left"><p>Menos Costos del Evento</p></td>
            <td align="center"><p>$ <?php echo formato_dinero($costo_total);?></p></td>
        </tr>
         <tr>
        	<td align="left"><p>Resultado Economico del Evento </p></td>
            <td align="center"><p>$ <?php echo formato_dinero($total_proyectado-$costo_total);?></p></td>
        </tr>
     </table>
  </div>
  <div style="margin-top:10px; padding-top:30px;" align="center">
  	<table width="60%">
    	<tr>
        	<td align="center"><p style="border-top:#000 solid 1px;; padding-top:5px;">Elabora</p></td>
            <td align="center"><p style="border-top:#000 solid 1px;; padding-top:5px;">Autoriza</p></td>
        </tr>
    </table>
  </div>
  
</div>
</body>
</html>