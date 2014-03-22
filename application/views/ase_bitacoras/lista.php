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
  			<p>Seleccione el Solicitante:</p>
            <div>
            	<?php echo form_dropdown('id_solicitante',$solicitantes);?>
            </div>
            <p>Seleccione el Proyecto:</p>
            <div class="proyectos">
            	
            </div>
            <p>Seleccione Actividad:</p>
            <div class="actividades">
            	
            </div>
            <br />
            <div>
            	<button onclick="">Ver Bitacora</button>
                <button onclick="">Ver Recomendaciones</button>
            </div>
      </div>
    </div>
    <!-- end #dashboard --> 
  </div>
  
  <!-- end #sidebar --> 
  
</div>
<script type="text/javascript">

$(document).ready(function(e) {
    
	$('select[name=id_solicitante]').change(function(e) {
        var id=$(this).val();
		$.ajax({
		  url: "<?php echo site_url($this->nombre_controlador.'/obtener_proyectos');?>",
		  data:{'id_servicio':id},
		  type:"POST",
		  success:function(data){

		  	$('.proyectos').html(data);
			$('select[name=id_proyecto]').change();
		  }
		  
		});
    });
	
	$('select[name=id_proyecto]').live('change',function(e){
		
			var id=$(this).val();
			$.ajax({
			  url: "<?php echo site_url($this->nombre_controlador.'/obtener_actividades');?>",
			  data:{'id_proyecto':id},
			  type:"POST",
			  success:function(data){
	
				$('.actividades').html(data);
			  }
			  
			});
		
		});
	
	
	$('select[name=id_actividad]').live('change',function(e){
			
			
			
	});
	
	$('select[name=id_solicitante]').change();
});

</script>

