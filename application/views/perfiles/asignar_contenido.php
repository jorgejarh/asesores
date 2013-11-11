<div id="content_main" class="clearfix">
  <div id="main_panel_container" class="left">
    <div id="dashboard" style="width:900px;">
      <h2 class="ico_mug"><?php echo $perfil['perfil'];?></h2>
      <div class="clearfix" style="width:100%;">
      <div class="bot_atras">
      <?php echo anchor('perfiles/index/'.$perfil['id_curricula'],'&lt; - Regresar a Perfiles');?>
      </div>
      <br />
            
      <div class="accordion"><!--contenido-->
      		<?php
			if($tipos_contenido)
			{
				foreach($tipos_contenido as $valor)
				{
					?>
					<h3 class="cada_tab" id="tab_num_<?php echo $valor['id_tabla_contenido'];?>"><?php echo $valor['nombre_contenido'];?></h3>
                    <div class="des_tab" id="tabs-<?php echo $valor['id_tabla_contenido'];?>">
                            
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

             
      </div><!--contenido-->
      
      <br />
      

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
		
		function archivos(id_contenido,id_perfil,id)
		{
			$.fancybox({
				href: "<?php echo site_url('perfiles/editar_archivos');?>/"+id_contenido+"/"+id_perfil+"/"+id,
				type:'iframe',
				width		: '30%',
				height		: '70%',
				});
		}
		
	   </script>
      </div>
    </div>
    <!-- end #dashboard --> 
  </div>
  
  
  
</div>
<script type="text/javascript">

$(document).ready(function(){
  $(".accordion h3:first").addClass("active");
  $(".accordion div:not(:first)").hide();
  $(".accordion h3").click(function(){
    $(this).next("div").slideToggle("slow")
    .siblings("div:visible").slideUp("slow");
    $(this).toggleClass("active");
    $(this).siblings("h3").removeClass("active");
  });

/* IDEM PERO EL PRIMERO DESPLEGADO
  $(".acordeon h3:first").addClass("active");
  $(".acordeon div:not(:first)").hide();
  $(".acordeon h3").click(function(){
    $(this).next("div").slideToggle("slow")
    .siblings("div:visible").slideUp("slow");
    $(this).toggleClass("active");
    $(this).siblings("h3").removeClass("active");
  });*/


});


</script>
<style type="text/css">
.accordion h3
{
	border:1px #CCC solid;
	text-align:center;
	cursor:pointer;
	margin:5px;
}
</style>
