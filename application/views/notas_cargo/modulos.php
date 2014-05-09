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
         <div class="bot_atras">
    	<?php
        echo anchor($this->nombre_controlador."/capacitaciones/".$cooperativa['id_cooperativa'],'<- Regresar');
		?>
    </div>
      		<div class="" style="width:90%; margin:auto;">
           <pre>
      	         <?php
				 //print_r($modulos);
				 ?>
                 </pre>
                 <?php
				 
if($modulos)
{
	?>
  <table id="example" class="display" >
    <thead>
      <tr>
        <th>Modulo</th>
        <th>Inscritos</th>
        <th>Pers. que asistieron</th>
        <th>Precio</th>
        <th>Total</th>
        <th>Ver Nota de Cargo</th>
      </tr>
    </thead>
    <tbody>
      <?php
		foreach($modulos as $valor)
		{
			$precio_mod=obtener_precio_modulo($valor['id_modulo']);
			?>
      <tr class="gradeA">
       <td><?php echo $valor['nombre_modulo'];?></td>
       <td><?php echo $valor['pre_inscritos'];?></td>
       <td><?php echo $valor['asistencia'];?></td>
       <td>$<?php echo number_format($precio_mod,2);?></td>
       <td>$<?php echo number_format($valor['asistencia']*$precio_mod,2);?></td>
        <td width="150" align="center">
        <?php
        if($valor['asistencia']!=0)
		{
		?>
        <a title="Ver Nota de Cargo" target="_blank" href="<?php echo site_url($this->nombre_controlador.'/ver_nota_cargo_modulo/'.$cooperativa['id_cooperativa'].'/'.$valor['id_modulo'].'/'.$inscripcion['id_inscripcion_tema']);?>" ><?php echo img('public/img/ico_page.png');?></a>
        <?php
		}
		?>
        </td>
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
	} );

function nuevo_registro()
{
	window.location.href="<?php echo site_url("nota_cargo/nuevo");?>";
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

