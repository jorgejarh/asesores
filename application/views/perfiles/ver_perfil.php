<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title><?php echo $perfil['perfil'];?></title>
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
.div_imprimir
{
	position:absolute; right:0px; top:0px;
}

.div_imprimir .opciones_
{
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

.div_imprimir .opciones_ li
{
	border:1px solid #CCC;
	padding:5px;
}
.div_imprimir .opciones_ li:hover
{
	background:#CCC;
}
.div_imprimir .opciones_ li a
{
	text-decoration:none;
	color:#333;
}

</style>
</head>

<body>
<div style="width:900px; margin:auto;" align="center">
  <div style="position:relative; " align="right">
    <div class="div_imprimir"><?php echo img(array('src'=>'public/img/icono-impresora.jpg','width'=>50));?>
      <ul class="opciones_">
        <li ><a href="<?php echo site_url('perfiles/ver_perfil/'.$perfil['id_perfil']."/web");?>" target="_blank">Desde la web</a></li>
        <li><a  href="<?php echo site_url('perfiles/ver_perfil/'.$perfil['id_perfil']."/pdf");?>" target="_blank">Exportar a pdf</a></li>
        <li><a href="<?php echo site_url('perfiles/ver_perfil/'.$perfil['id_perfil']."/docx");?>" target="_blank">Exportar a word</a></li>
      </ul>
    </div>
  </div>
  <h2 align="center">SISTEMA CURRICULAR FEDECACES</h2>
  <h3 align="center"><?php echo $curricula['curricula'];?></h3>
  <table align="center" width="80%">
    <tr>
      <td align="left" valign="middle"><b>Perfil: </b> <?php echo $perfil['perfil'];?></td>
      <td align="right" valign="middle"><b>Fecha: </b> <?php echo $perfil['fecha'];?></td>
    </tr>
  </table>
  <div style=" border-top:#333 solid 1px; border-left:#333 solid 1px; border-right:#333 solid 1px;" align="left">
    <?php
		$contador=0;
        foreach($tipos_contenido as $valor)
		{
			if($valor['lista_contenido'])
			{
				$contador++;
				?>
    <div style="padding:10px;">
      <p><b><?php echo $contador.".- ".$valor['nombre_contenido'];?></b></p>
      <ul style="list-style: none; padding:0px; padding-left:10px;">
        <?php
				foreach($valor['lista_contenido'] as $valor2)
				{
					?>
        <li><?php echo "- ".$valor2['nombre'];?></li>
        <?php
				}
				?>
      </ul>
    </div>
    <div style=" border-bottom:#333 solid 1px;"> </div>
    <?php
			}
			
		}
		?>
  </div>
</div>
</body>
</html>