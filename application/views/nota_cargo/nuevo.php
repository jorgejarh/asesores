<div id="content_main" class="clearfix">
  <div id="main_panel_container" class="left" style="width:900px;">
    <div id="dashboard" style="width:100%;padding-bottom:50px;">
      <h2 class="ico_mug"> <?php echo $title;?> </h2>
      <div>
      	<?php echo anchor('nota_cargo/index','Atras');?>
      </div>
      <br />
      <div>
      	<?php
        echo form_open();
		?>
        <table>
        	<tr>
                <td><?php echo form_dropdown('tipo_persona',array('C'=>"Cooperativa",'PN'=>"Persona Natural"),set_value('tipo_persona'));?> <?php echo form_dropdown('cooperativa',array());?></td>
                
            </tr>
            <tr>
            	<td>Por $ <?php echo form_input('cantidad_por', set_value('cantidad_por'));?></td>
            </tr>
        </table>
        <?php
		echo form_close();
		?>
      </div>
    </div>
    <!-- end #dashboard --> 
  </div>
  
  <!-- end #sidebar --> 
  
</div>
<script type="text/javascript">
$(document).ready(function() {
   
   $('select[name=tipo_persona]').change(function(e) {
		$.ajax({
		  url: "<?php echo site_url('nota_cargo/ajax_listado_personas');?>/"+$(this).val(),
		  type:"POST",
		  success:function(data){

		  	 $('select[name=cooperativa]').html(data);
		  }
		  
		});
	});
	
	$('select[name=tipo_persona]').change();
});

function nuevo_registro()
{
	$.ajax({
		  url: "<?php echo site_url('conf_menu/nuevo');?>",
		  type:"POST",
		  success:function(data){

		  	$.fancybox(data);
		  }
		  
		});
}

function editar_registro(id)
{
	$.ajax({
		  url: "<?php echo site_url('conf_menu/editar');?>/"+id,
		  type:"POST",
		  success:function(data){

		  	$.fancybox(data);
		  }
		  
		});
}

function eliminar_registro(id)
{
	if(!confirm('¿Todos los submenus tambien se eliminaran, Seguro de desea el registro,?'))
	{
		return false;
	}

	$.ajax({
		  url: "<?php echo site_url('conf_menu/eliminar');?>/"+id,
		  type:"POST",
		  success:function(data){
			  
			  	if(data=="ok")
			  	{
					alert("Registro Eliminado");
					location.reload();
				}
			/*  
		  	$.fancybox({
		  		content:data,
		  		afterClose:function()
		  		{
		  			location.reload();
		  		}
		  	});*/
		  }
		  
		});
}

</script> 
