<script type="text/javascript" language="javascript" src="<?php echo base_url();?>public/js/graficos/highcharts.js"></script>
<script type="text/javascript" language="javascript" src="<?php echo base_url();?>public/js/graficos/modules/data.js"></script>
<script type="text/javascript" language="javascript" src="<?php echo base_url();?>public/js/graficos/modules/exporting.js"></script>
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
		  $listado[0]="Todas";
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
        <div><button onclick="inscribir_modulo();">Ver Grafico</button></div>
        
        <div id="grafico">
        	
        </div>
        <div>
        	<table id="tabla_genero" style="display:none;">
            	<thead>
                <tr>
                	<th>Genero</th>
                    <th>Cantidad</th>
                </tr>
                </thead>
                <tbody>
                	<tr>
                    	<td>Masculino</td>
                        <td id="numero_m">5</td>
                    </tr>
                    <tr>
                    	<td>Femenino</td>
                        <td id="numero_f">60</td>
                    </tr>
                </tbody>
            </table>
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
			url:"<?php echo site_url('reporte_genero/obtener_modalidades');?>",
			type:"POST",
			data:{'id_plan':$('#id_plan').val()},
			success: function(data)
					{
						$('#div_modalidad').html(data);
						
						$('#id_plan_modalidad').change();
						
					}
		});
		
		
    });
	
	$('#id_plan_modalidad').live('change',function(e) {
        $.ajax({
			url:"<?php echo site_url('reporte_genero/obtener_capacitaciones');?>",
			type:"POST",
			data:{'id_plan_modalidad':$('#id_plan_modalidad').val()},
			success: function(data)
					{
						$('#div_capacitaciones').html(data);
						$('#id_capacitacion').change();
					}
		});
		
		
    });
	
	
	
	$('#id_capacitacion').live('change',function(e) {
        $.ajax({
			url:"<?php echo site_url('reporte_genero/obtener_modulos');?>",
			type:"POST",
			data:{'id_capacitacion':$('#id_capacitacion').val()},
			success: function(data)
					{
						$('#div_modulos').html(data);
					}
		});
		
		
    });
	
	
	
	$('#id_plan').change();
	
});

function inscribir_modulo()
{
	
	$.ajax({
		url:"<?php echo site_url('reporte_genero/obtener_grafico');?>",
		type:"POST",
		data:{'id_plan':$('#id_plan').val(),'id_capacitacion':$('#id_capacitacion').val(),'id_plan_modalidad':$('#id_plan_modalidad').val(),'id_modulo':$('#id_modulo').val()},
		dataType:"json",
		success: function(data)
				{
					$('#numero_m').html(data.m);
					$('#numero_f').html(data.f);
					crear_grafico();
				}
	});
	
						
		
}

function crear_grafico()
{
	$('#grafico').highcharts({
			credits: {
				  enabled: false
			  },
			data: {
				table: document.getElementById('tabla_genero')
			},
			chart: {
				type: 'pie',
				height: 500
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
}

</script> 
