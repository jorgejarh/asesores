<div id="content_main" class="clearfix">
  <div id="main_panel_container" class="left">
    <div id="dashboard" style="width:900px;">
      <h2 class="ico_mug"><?php echo $perfil['perfil'];?></h2>
      <div class="clearfix" style="width:100%;">
      <div id="tabs">
				<ul>
                	<?php
                    if($tipos_contenido)
					{
						foreach($tipos_contenido as $valor)
						{
							?>
                            <li><a href="#tabs-<?php echo $valor['id_tabla_contenido'];?>"><?php echo $valor['nombre_contenido'];?></a></li>
                            <?php
						}
					}
					?>
				</ul>
                <?php
                    if($tipos_contenido)
					{
						foreach($tipos_contenido as $valor)
						{
							?>
                            <div id="tabs-<?php echo $valor['id_tabla_contenido'];?>">
                            
                            </div>
                            <script type="text/javascript">
							
							$(document).ready(function(){
								
								actualizar(<?php echo $valor['id_tabla_contenido'];?>,<?php echo $perfil['id_perfil'];?>);
								
								});
							
							</script>
                            <?php
						}
					}
					?>
				
	  </div>
      <br />
      <?php echo anchor('perfiles','Regresar a Perfiles');?>

       <script>
	   function nuevo_contenido(id_contenido,id_perfil)
		{
			$.ajax({
			  url: "<?php echo site_url('perfiles/nuevo_contenido');?>/"+id_contenido+"/"+id_perfil,
			  type:"POST",
			  success:function(data){
					
					$.fancybox(data);
				
			  }
			  
			});
		}
		
		function actualizar(id_contenido,id_perfil)
		{
			$.ajax({
			  url: "<?php echo site_url('perfiles/actualizar_contenido');?>/"+id_contenido+"/"+id_perfil,
			  type:"POST",
			  success:function(data){
	
				$('#tabs-'+id_contenido).html(data);
			  }
			  
			});
		}
		
		function editar(id_contenido,id_perfil,id)
		{
			$.ajax({
			  url: "<?php echo site_url('perfiles/editar_contenido');?>/"+id_contenido+"/"+id_perfil,
			  type:"POST",
			  data:{"id":id},
			  success:function(data){
	
				$.fancybox(data);
			  }
			  
			});
		}
		function del(id_contenido,id_perfil,id,nombre_tabla)
		{
			if(confirm('¿Esta seguro de eliminar el registro?'))
			{
				$.ajax({
				  url: "<?php echo site_url('perfiles/eliminar_contenido');?>/"+id_contenido+"/"+id_perfil,
				  type:"POST",
				  data:{"id":id,"tabla":nombre_tabla},
				  success:function(data){
							if(data=="ok")
							{
								actualizar(id_contenido,id_perfil);
							}
					//$.fancybox(data);
				  }
				  
				});
			}
			
		}
	   </script>
      </div>
    </div>
    <!-- end #dashboard --> 
  </div>
  <!--<div id="sidebar" class="right">
    <h2 class="ico_mug">Configuracion</h2>
    <ul id="menu">
      <?php $this->load->view('users/lateral_derecho_conf');?>
    </ul>
  </div>-->
  <!-- end #sidebar --> 
  
</div>
<script type="text/javascript">
	/*$(document).ready(function() {
	    $('#example').dataTable( {
	        <?php echo config_lenguaje_tabla(); ?>
	    } );
	} );

function nuevo_registro()
{
	$.ajax({
		  url: "<?php echo site_url('perfiles/nuevo');?>",
		  type:"POST",
		  success:function(data){

		  	$.fancybox(data);
		  }
		  
		});
}

function editar_registro(id)
{
	$.ajax({
		  url: "<?php echo site_url('perfiles/editar');?>/"+id,
		  type:"POST",
		  success:function(data){

		  	$.fancybox(data);
		  }
		  
		});
}

function eliminar_registro(id)
{
	if(!confirm('¿Seguro de desea el registro?'))
	{
		return false;
	}

	$.ajax({
		  url: "<?php echo site_url('perfiles/eliminar');?>/"+id,
		  type:"POST",
		  success:function(data){
			location.reload();
		  	/*$.fancybox({
		  		content:data,
		  		afterClose:function()
		  		{
		  			location.reload();
		  		}
		  	});
		  }
		  
		});
}*/

</script>

