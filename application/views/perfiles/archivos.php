<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Iframe</title>
<meta name="description" content="" />
<meta name="keywords" content="" />
<meta name="robots" content="index,follow" />
<link rel="stylesheet" type="text/css" media="all" href="<?php echo base_url();?>public/css/style.css" />
<link rel="Stylesheet" type="text/css" href="<?php echo base_url();?>public/css/smoothness/jquery-ui-1.7.1.custom.css"  />
<!--[if IE 7]><link rel="stylesheet" href="<?php echo base_url();?>public/css/ie.css" type="text/css" media="screen, projection" /><![endif]-->
<!--[if IE 6]><link rel="stylesheet" href="<?php echo base_url();?>public/css/ie6.css" type="text/css" media="screen, projection" /><![endif]-->
<link rel="stylesheet" type="text/css" href="<?php echo base_url();?>public/markitup/skins/markitup/style.css" />
<link rel="stylesheet" type="text/css" href="<?php echo base_url();?>public/markitup/sets/default/style.css" />
<link rel="stylesheet" type="text/css" href="<?php echo base_url();?>public/css/superfish.css" media="screen">
<!--[if IE]>
		<style type="text/css">
		  .clearfix {
		    zoom: 1;     /* triggers hasLayout */
		    display: block;     /* resets display for IE/Win */
		    }  /* Only IE can see inside the conditional comment
		    and read this CSS rule. Don't ever use a normal HTML
		    comment inside the CC or it will close prematurely. */
		</style>
	<![endif]-->
<!-- JavaScript -->

<script type="text/javascript" language="javascript" src="<?php echo base_url();?>public/js/datatable/media/js/jquery.js"></script>
<!--<script type="text/javascript" src="<?php echo base_url();?>public/js/jquery-1.3.2.min.js"></script>-->
<script type="text/javascript" src="<?php echo base_url();?>public/js/jquery-ui-1.7.1.custom.min.js"></script>
<!--[if IE]><script language="javascript" type="text/javascript" src="<?php echo base_url();?>public/js/excanvas.pack.js"></script><![endif]-->

<!--Datatable-->
<style type="text/css" title="currentStyle">
@import "<?php echo base_url();?>public/js/datatable/media/css/demo_table.css";

p img
{
	vertical-align:middle;
}
p
{
	margin:2px;
	padding:5px;
}
</style>
<script type="text/javascript" language="javascript" src="<?php echo base_url();?>public/js/datatable/media/js/jquery.dataTables.js"></script>

<!-- Add fancyBox main JS and CSS files -->
<script type="text/javascript" src="<?php echo base_url();?>public/js/fancybox/source/jquery.fancybox.js?v=2.1.4"></script>
<link rel="stylesheet" type="text/css" href="<?php echo base_url();?>public/js/fancybox/source/jquery.fancybox.css?v=2.1.4" media="screen" />
</head>
<body style="background:none;">
<div align="center">

<div>
	<?php
	if(isset($documentos))
	{
		if($documentos)
		{
			echo "<p><b>Archivos subidos correctamente:</b></p>";
		}
		foreach($documentos as $doc)
		{
			echo $doc['file_name'];
		}
	}
    ?>
     <?php
	if(isset($errores))
	{
		if($errores)
		{
			echo "<p><b>Error en los archivos:</b></p>";
		}
		foreach($errores as $error)
		{
			echo "<p>Error del archivo <b>".$error['archivo'].": </b> </p>".$error['error'];
		}
	}
	?>
</div>
<br />
 <?php
//print_r($dato);
$archivos=json_decode($dato['archivos']);
?>
  <h3>Archivos para <?php echo $dato['nombre']?></h3>
  <hr>
  <?php
echo form_open_multipart('',array(
							'id'=>'form_nuevo'
								),
					array('id'=>$dato['id'])
				);
?>
  <table align="center" style="margin:auto;  width:400px;">
    <tr>
      <td align="center" colspan="2"><a onclick="agregar_tem();" style="cursor:pointer;">+ Agregar Archivo</a>
        <div class="temas_textos" style="min-height:200px;">
          <?php
            if($archivos)
			{
				foreach($archivos as $val)
				{
					if($val)
					{
					?>
				  <p>
					<a href="<?php echo base_url('public/archivos_perfiles/'.$val);?>" target="_blank"><?php echo $val;?></a>
					<input type="hidden" name="archi_normal[]" value="<?php echo $val;?>" />
					<?php echo img(array(
									'src'=>'public/img/cancel.png',
									'class'=>'elim_tema',
									'archi'=>$val
									));?></p>
				  <?php
					}
				}
			}
		   ?>
        </div></td>
    </tr>
    <tr>
      <td colspan="2"><hr></td>
    </tr>
    <tr>
      <td colspan="2" align="center"><div id="div_error" ></div></td>
    </tr>
    <tr>
      <td colspan="2" align="center"><input type="submit" id="save" value="Guardar" /></td>
    </tr>
  </table>
  <div class="eliminar_ar">
  	
  </div>
  <?php
echo form_close();
?>
  <div style="display:none;" class="tem_nuevo">
    <p>
      <input type="file" name="archivos_per_arch_" />
      <input type="hidden" class="nombre_archivo" value="0" />
      <?php echo img(array(
					'src'=>'public/img/cancel.png',
					'class'=>'elim_tema',
					'archi'=>'0'
					));?></p>
  </div>
  <div class="cargando_"> </div>
</div>
<script type="text/javascript">
$(document).ready(function(e){
	
	$('#form_nuevo').submit(function(){

		form=$(this);

		form.fadeOut('fast',function(){

			$('.cargando_').fadeIn('fast');

			
		});

		return true;
	});
	
	
	$('.elim_tema').live('click',function(){
		var el=$(this);
		
		if(el.attr('archi')!="0")
		{
			var nuevo_eli='<input type="hidden" name="eli_ar[]" value="'+el.attr('archi')+'" />';
			//alert(nuevo_eli);
			$('.eliminar_ar').append(nuevo_eli);
		}
		
		$(this).parent('p').remove();
	});

	
});

function agregar_tem()
{
	var text_tem=$('.tem_nuevo').html();
	var contar=$('.temas_textos input[type=file]').size();
	contar++;
	text_n=text_tem.replace('arch_',contar);
	
	$('.temas_textos').append(text_n);
	
	$('.temas_textos').find('input:last').focus();
}
</script>
</body>
</html>