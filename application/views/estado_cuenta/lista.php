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
        <div>
        <?php
			echo form_open('',array(
								'id'=>'form_nuevo'
									),
								array(
								
									)
							);
			?>
        	<table>
            	<tr>
                	<td>Cooperativa:</td>
                	<td><?php echo form_dropdown('id_cooperativa',$lista);?></td>
                    <td>Fecha Inicio:</td>
                	<td><?php echo form_input(array('name'=>'f_ini','class'=>'date_','value'=>date('Y-m-d')));?></td>
                     <td>Fecha Fin:</td>
                	<td><?php echo form_input(array('name'=>'f_fin','class'=>'date_','value'=>date('Y-m-d')));?></td>
                    <td><input type="submit" value="Generar" /></td>
                </tr>
            </table>
            <?php
            echo form_close();
			?>
        </div>
        <div class="cargando_">

</div>
        <div style="width:90%; margin:auto;" id="resultado" >
        	
        </div>
        <?php
        /*
		?>
      		<div class="" style="width:90%; margin:auto;">
      	         <?php
if($listado)
{
	?>
  <table id="example" class="display" >
    <thead>
      <tr>
        <th>Cooperativa</th>
        <th>Telefono</th>
        <th>Email</th>
        <th>Ver</th>
      </tr>
    </thead>
    <tbody>
      <?php
		foreach($listado as $valor)
		{
			?>
      <tr class="gradeA">
       <td><?php echo $valor['cooperativa'];?></td>
       <td><?php echo $valor['telefono'];?></td>
      <td><?php echo $valor['email'];?></td>
        <td align="center" class="datatable_icono"><a onclick="ver_estado(<?php echo $valor['id_cooperativa'];?>);" ><?php echo img('public/img/ico_page.png');?></a></td>
      </tr>
      <?php
		}
		?>
    </tbody>
  </table>
  <?php
}
?>
		        
    		</div>
             <?php
        */
		?>
    	</div>
    	<!-- end #dashboard --> 
  	</div>
  	
  	<!-- end #sidebar --> 
  
</div>
<script type="text/javascript">
	$(document).ready(function() {
	    $('#example').dataTable( {
	        <?php echo config_lenguaje_tabla(); ?>
	    } );
		
		
		$( ".date_" ).datepicker({
			dateFormat: "yy-mm-dd",
			changeMonth: true,
			changeYear: true
		});
		
		
		
		
		
	$('#form_nuevo').submit(function(){

			form=$(this);

			$('.cargando_').fadeIn('fast');
			$('#resultado').fadeOut('fast');
			$.ajax({
				  url: "<?php echo site_url('estado_cuenta/generar_resultado');?>",
				  type:"POST",
				  //dataType:"json",
				  data:$(this).serialize(),
				  success:function(data){
							$('#resultado').hide('fast');
				  			$('#resultado').html(data);
							$('#resultado').fadeIn();
				  			$('.cargando_').fadeOut('fast');
				  		
				  		
				  },
				   error:function()
				  {
					 alert("Error al procesar, Intente de nuevo"); 
					// location.reload();
				  }
			});
			
			return false;
		});

		
		
		
		
	} );


function ver_estado(id)
{
	var f = new Date();
	
	f_inicio=$('input[name=f_ini]').val();
	f_fin=$('input[name=f_fin]').val();
	window.open("<?php echo site_url('estado_cuenta/ver_total'); ?>/"+id+"?f_i="+f_inicio+"&f_fin="+f_fin);
}


</script>

