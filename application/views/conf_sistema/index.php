<div id="content_main" class="clearfix">
  <div id="main_panel_container" class="left" style="width:900px;">
    <div id="dashboard" style="width:100%;padding-bottom:50px;">
      <h2 class="ico_mug">
      	<table style="width:100%;">
      		<tr>
      			<td>Respaldo de la base de datos</td>
      			
      		</tr>
      	</table>
      </h2>
      	<p>
      		Descarge un respaldo de la base de datos
      	</p>
<!--<button onClick="descargar_respaldo();"><a href="<?php echo site_url('respaldo_datos');?>">Respaldo de datos</a></button>-->
<button ><a style="color:#FFF;" target="_blank" href="<?php echo site_url('respaldo_datos');?>">Respaldo de datos</a></button>


<script type="text/javascript">
	function descargar_respaldo()
	{
		window.location="<?php echo site_url('respaldo_datos');?>";
	}
</script>
  	</div>
  </div>
</div>


  		
