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
      <div class="combo_largos" style="width:90%; margin:auto;">
        <div>
          <p>Seleccione un plan</p>
          <?php
		  $listado[0]=".: Seleccione:.";
		  ksort($listado);
		  echo form_dropdown('',$listado,0,'id="id_plan"');
		  ?>
        </div>
        <div id="div_modalidad">	
        	
        </div>
        <div id="div_capacitaciones">	
        	
        </div>
        <div id="div_modulos">	
        	
        </div>
      </div>
    </div>
    <!-- end #dashboard --> 
  </div>
  
  <!-- end #sidebar --> 
  
</div>
<script type="text/javascript">
$(document).ready(function(e) {
    
	$('#id_plan').change(function(e) {
        $.ajax({
			url:"<?php echo site_url('cal_modulo/obtener_modalidades');?>",
			type:"POST",
			data:{'id_plan':$('#id_plan').val()},
			success: function(data)
					{
						$('#div_modalidad').html(data);
					}
		});
		
		
    });
	
	$('#id_plan_modalidad').live('change',function(e) {
        $.ajax({
			url:"<?php echo site_url('cal_modulo/obtener_capacitaciones');?>",
			type:"POST",
			data:{'id_plan_modalidad':$('#id_plan_modalidad').val()},
			success: function(data)
					{
						$('#div_capacitaciones').html(data);
					}
		});
		
		
    });
	
	
	
	$('#id_capacitacion').live('change',function(e) {
        $.ajax({
			url:"<?php echo site_url('cal_modulo/obtener_modulos');?>",
			type:"POST",
			data:{'id_capacitacion':$('#id_capacitacion').val()},
			success: function(data)
					{
						$('#div_modulos').html(data);
					}
		});
		
		
    });
	
	
	
	//$('#id_plan').change();
	
});

function inscribir_modulo()
{
	window.location="<?php echo site_url('cal_modulo/inscribir_modulo');?>/"+$('#id_modulo').val();
}

</script> 
