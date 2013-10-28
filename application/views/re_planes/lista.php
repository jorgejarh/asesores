<div id="content_main" class="clearfix">
  <div id="main_panel_container" class="left" style="width:900px;">
    <div id="dashboard" style="width:100%;padding-bottom:50px;">
      <h2 class="ico_mug">
      	<table style="width:100%;">
      		<tr>
      			<td><?php echo $title;?></td>
      			
      		</tr>
      	</table>
      </h2>
      <div class="" style="width:90%; margin:auto;">
      <table width="100%">
        	<tr>
            	<td width="40%">&nbsp;</td>
                <td width="20%" align="center"><b>Inversion total</b></td>
                <td width="20%" align="center"><b>Monto Pagado</b></td>
                <td width="20%" align="center"><b>Deuda Neta</b></td>
            </tr>
        </table>
      <?php
      foreach($cooperativas as $cooperativa)
	  {
	  ?>
      <div class="nombre_cooperaiva">
      	
      	<div class="padre_" style="margin-bottom:5px;">
        <table width="100%">
        	<tr>
            	<td width="40%"><h3><?php echo $cooperativa['cooperativa'];?></h3></td>
                <?php
                  $total_por_cooperativa        = obtener_total_por_cooperativa($cooperativa['id_cooperativa']);
                  $monto_pagado_por_cooperativa = obtener_monto_pagado_por_cooperativa( $cooperativa['id_cooperativa'] );
                  $deuda_neta                   = ( $total_por_cooperativa - $monto_pagado_por_cooperativa );
                ?>
                <td width="20%" align="center"><b>$ <?php echo $total_por_cooperativa;?></b></td>
                <td width="20%" align="center"><b>$ <?php echo $monto_pagado_por_cooperativa;?></b></td>
                <td width="20%" align="center"><b>$ <?php echo $deuda_neta; ?></b></td>
            </tr>
        </table>
        </div>
        <div class="hijo_">
        	<?php
            foreach($cooperativa['planes'] as $planes)
			{
				?>
                <div class="padre_" style="margin-left:10px;" >
                	<table width="100%">
                        <tr>
                            <td width="40%"><h4 ><?php echo $planes['nombre_plan'];?></h4></td>
                            <td width="20%" align="center"><b>$ <?php echo obtener_total_por_plan($planes['id_plan'],$cooperativa['id_cooperativa']);?></b></td>
                            <td width="20%" align="center"><!--<b>0.00</b>--></td>
                            <td width="20%" align="center"><!--<b>0.00</b>--></td>
                        </tr>
                    </table>
				
                </div>
                <div   class="hijo_">
					<?php
                    foreach($planes['modalidades'] as $modalidad)
					{
					?>
                    <div class="padre_" style="margin-left:20px;">
                    <table width="100%">
                        <tr>
                            <td width="40%"><h4 ><?php echo $modalidad['nombre_modalidad'];?></h4></td>
                            <td width="20%" align="center"><b>$ <?php echo obtener_total_por_modalidad($modalidad['id_plan_modalidad'],$cooperativa['id_cooperativa']);?></b></td>
                            <td width="20%" align="center"><!--<b>0.00</b>--></td>
                            <td width="20%" align="center"><!--<b>0.00</b>--></td>
                        </tr>
                    </table>
					
                    </div>
                    <div  class="hijo_" > 
                    	<?php
						foreach($modalidad['temas'] as $tema)
						{
						?>
                        	<div class="padre_" style="margin-left:30px;">
                            	<table width="100%">
                                    <tr>
                                        <td width="40%"><h4 ><?php echo $tema['nombre_capacitacion'];?></h4></td>
                                        <td width="20%" align="center"><b>$ <?php echo obtener_total_por_capacitacion($tema['id_capacitacion'],$cooperativa['id_cooperativa']);?></b></td>
                                        <td width="20%" align="center"><!--<b>0.00</b>--></td>
                                        <td width="20%" align="center"><!--<b>0.00</b>--></td>
                                    </tr>
                                </table>
							
                            </div>
                            <div class="hijo_" > 
                            	<?php
								foreach($tema['modulos'] as $modulo)
								{
								?>
                                <div class="padre_" style="margin-left:40px; ">
                                <table width="100%">
                                    <tr>
                                        <td width="40%"><b style="display:block;"><?php echo $modulo['nombre_modulo'];?></b></td>
                                        <td width="20%" align="center"><b>$ <?php echo obtener_total_por_modulo($tema['id_capacitacion'],$modulo['id_modulo'],$cooperativa['id_cooperativa']);?></b></td>
                                        <td width="20%" align="center"><!--<b>0.00</b>--></td>
                                        <td width="20%" align="center"><!--<b>0.00</b>--></td>
                                    </tr>
                                </table>
									
                                </div>
                                 <?php
								}
								?>
                            </div>
                        <?php
						}
						?>
                    </div>
                    <?php
					}
					?>
                </div>
                <?php
			}
			?>
            
        </div>
      </div>
      <?php
      }
	  ?>
      
      <pre>
	  <?php
      //print_r($cooperativas);
          ?>
      </pre>
      
      
      </div>
    </div>
    <!-- end #dashboard --> 
  </div>
  
  <!-- end #sidebar --> 
  
</div>
<style>
.padre_
{
	padding:0px;
	cursor:pointer;
	padding-left:15px;
	background-image:url(<?php echo base_url();?>public/img/flecha_acordeon_normal.fw.png);
	background-position:left;
	background-repeat:no-repeat;
} 
.padre_:hover
{
	background-color:#CCC;
}
.hijo_
{
	display:none;
}

.padre_.active
{
		background-image:url(<?php echo base_url();?>public/img/flecha_acordeon_activo.fw.png);

}

</style>
<script type="text/javascript">
$(document).ready(function(e) {
    
	$('.padre_').click(function(e) {
		
		if($(this).hasClass('active'))
		{
			$(this).removeClass('active');
		}else{
			$(this).addClass('active');
			}
		
        //alert('ss');
		$(this).next('.hijo_').toggle('fast');
    });
	
});
</script>
