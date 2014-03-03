<pre>
<?php
//print_r($datos);
?>
</pre>
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
    <div class="div_imprimir" style="display:none;"><?php echo img(array('src'=>'public/img/icono-impresora.jpg','width'=>50));?>
      <ul class="opciones_">
        <li ><a href="<?php echo site_url('pl_capacitaciones/ver_presupuesto/'.$datos['id_capacitacion']."/web");?>" target="_blank">Desde la web</a></li>
        <li><a  href="<?php echo site_url('pl_capacitaciones/ver_presupuesto/'.$datos['id_capacitacion']."/pdf");?>" target="_blank">Exportar a pdf</a></li>
        <li><a href="<?php echo site_url('pl_capacitaciones/ver_presupuesto/'.$datos['id_capacitacion']."/docx");?>" target="_blank">Exportar a word</a></li>
      </ul>
    </div>
  </div>
  <h2 align="center">Presupuesto de eventos de Capacitacion</h2>
  <h3 align="center"><?php echo $datos['modalidad']['nombre_plan'];?></h3>
  <table align="center" width="80%" >
    <tr>
      <td align="left" valign="middle"><p><b>Modalidad: </b></p></td>
      <td align="left" valign="middle"><p><?php echo $datos['modalidad']['nombre_modalidad'];?></p></td>
    </tr>
    <tr>
      <td align="left" valign="middle"><p><b>Nombre: </b></p></td>
      <td align="left" valign="middle"><p><?php echo $datos['nombre_capacitacion'];?></p></td>
    </tr>
    <tr>
      <td align="left" valign="middle"><p><b># Partic. Estimados: </b></p></td>
      <td align="left" valign="middle"><p>
          <?php $participantes=$datos['n_participantes']+$datos['n_participantes_no']+$datos['n_participantes_ex']; echo $participantes;?>
        </p></td>
    </tr>
    
    <tr>
      <td align="left" valign="middle"><p><b>Costo Total: </b></p></td>
      <td align="left" valign="middle"><p>
          <?php 
	  	$costo_total=0.00;
		$rubros_total=array();
		
		foreach($datos['modulos'] as $val_modulo)
		{
			foreach($val_modulo['rubros'] as $rubros)
			{
				$total_rubro=0.00;
				if($rubros['sub'])
				{
					foreach($rubros['sub'] as $subrubro)
					{
						
						$total_rubro+=($subrubro['unidades']*$subrubro['costo']*$subrubro['dias'] );
					}
				}
				$costo_total+=$total_rubro;
			}
		}
		
		echo "$ ".number_format($costo_total,2);
	  ?>
        </p></td>
    </tr>
    <tr>
      <td align="left" valign="middle"><p><b>Costo Unitario: </b></p></td>
      <td align="left" valign="middle"><p><?php echo "$ ".number_format($costo_total/$participantes,2);?></p></td>
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
	$rubros=$this->$model->obtener_rubros_x_capacitacion($datos['id_capacitacion']);
    if($rubros)
	{
		foreach($rubros as $key_ru=>$valrubros)
		{
			$rubros[$key_ru]['sub']=$this->$model->obtener_sub_rubros_x_capacitacion($datos['id_capacitacion'],$valrubros['id_rubro_name']);
			?>
    <tr class="gris_l_2" >
      <td align="left" valign="middle"><b>
        <?php
                echo $valrubros['nombre'];
				?>
        </b></td>
      <td align="center" valign="middle">&nbsp;</td>
      <td align="center" valign="middle">&nbsp;</td>
      <td align="right" valign="middle"><span style="float:left; margin-left:5px;">$</span> <b><?php echo number_format($valrubros['total'],2);?></b></td>
    </tr>
    <?php
			
			if($rubros[$key_ru]['sub'])
			{
				foreach($rubros[$key_ru]['sub'] as $subrubro)
				{
					?>
    <tr>
      <td align="left" valign="middle">&nbsp;&nbsp;
        <?php
                        echo $subrubro['nombre_sub'];
                        ?></td>
      <td align="center" valign="middle"><?php echo $subrubro['unidades'];?></td>
      <td align="right" valign="middle"><span style="float:left;margin-left:5px;">$</span> <?php echo number_format($subrubro['costo'],2);?></td>
      <td align="right" valign="middle"><span style="float:left; margin-left:5px;">$</span> <?php echo number_format($subrubro['total'],2);?></td>
    </tr>
    <?php
				}
			}
		}
	}
	?>
  </table>
   <?php
		$total_mod_afiliados=0.00;
		$total_mod_afiliados_no=0.00;
		$total_mod_afiliados_ex=0.00;
        if($datos['modulos'])
		{
			foreach($datos['modulos'] as $mod)
			{
				$total_mod_afiliados+=$mod['precio_venta'];
				$total_mod_afiliados_no+=$mod['precio_venta_no'];
				$total_mod_afiliados_ex+=$mod['precio_venta_ex'];
				
			}
		}
		?>
  <div style="margin-top:40px;">
  	 <h2 align="center">RESULTADOS FINANCIEROS ESTIMADOS</h2>
     <table width="80%" class="cuadro">
     	 <tr class="gris_l">
        	<td align="center"><b>Detalle</b></td>
            <td align="center"><b>Valor</b></td>
        </tr>
     	<tr>
        	<td align="left"><p>Número estimado de Participantes de Cooperativas Afiliadas</p></td>
            <td align="center"><p><?php echo $datos['n_participantes'];?></p></td>
        </tr>
        <tr>
        	<td align="left"><p>Número de participantes de cooperativas no afiliadas  </p></td>
            <td align="center"><p><?php echo $datos['n_participantes_no'];?></p></td>
        </tr>
        <tr>
        	<td align="left"><p>Número de participantes extranjeros  confirmados al evento  </p></td>
            <td align="center"><p><?php echo $datos['n_participantes_ex'];?></p></td>
        </tr>
        <tr>
        	<td align="left"><p>Costo del Evento a cooperativas afiliadas  </p></td>
            <td align="center"><p>$ <?php echo $total_mod_afiliados;?></p></td>
        </tr>
        <tr>
        	<td align="left"><p>Costo del Evento a cooperativas no afiliadas </p></td>
            <td align="center"><p>$ <?php echo $total_mod_afiliados_no;?></p></td>
        </tr>
        <tr>
        	<td align="left"><p>Costo del Evento a Internacionales  </p></td>
            <td align="center"><p>$ <?php echo $total_mod_afiliados_ex;?></p></td>
        </tr>
        <tr class="gris_l">
        	<td align="left" colspan="2"><b>RESULTADOS ESTIMADOS DEL EVENTO</b></td>
        </tr>
       
        <tr>
        	<td align="left"><p>Ingreso Proyectado de participantes de cooperativas afiliadas </p></td>
            <td align="center"><p>$ <?php $total_afiliados=$datos['n_participantes']*$total_mod_afiliados; echo formato_dinero($total_afiliados);?></p></td>
        </tr>
        <tr>
        	<td align="left"><p>Ingreso Proyectado de participantes de cooperativas no afiliadas </p></td>
            <td align="center"><p>$ <?php $total_no_afiliados=$datos['n_participantes_no']*$total_mod_afiliados_no; echo formato_dinero($total_no_afiliados);?></p></td>
        </tr>
        <tr>
        	<td align="left"><p>Ingreso Proyectado de Extranjeros  </p></td>
            <td align="center"><p>$ <?php $total_extranjeros=$datos['n_participantes_ex']*$total_mod_afiliados_ex; echo formato_dinero($total_extranjeros);?></p></td>
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