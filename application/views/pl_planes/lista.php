  <div id="content_main" class="clearfix">
  <div id="main_panel_container" class="left" style="width:900px;">
    <div id="dashboard" style="width:100%;padding-bottom:50px;">
      <h2 class="ico_mug">
      	<table style="width:100%;">
      		<tr>
      			<td><?php echo $title;?></td>
      			<td style="text-align:right;"><button onClick="nuevo_registro();">Nuevo</button></td>
      		</tr>
      	</table>
      </h2>
      <div class="" style="width:90%; margin:auto;">
      
        <?php
if($listado)
{
	?>
  <table id="example" class="display" >
    <thead>
      <tr>
      	<th>Nombre del Plan</th>
        <th>Total</th>
        <th>Ver plan</th>
        <th>Asignar Modalidades</th>
        <th>Agregar Documentos</th>
       	<th>&nbsp;</th>
        <th>&nbsp;</th>
        <th>&nbsp;</th>
      </tr>
    </thead>
    <tbody>
      <?php
		foreach($listado as $valor)
		{
			?>
      <tr class="gradeA">
      	<td><?php echo $valor['nombre_plan'];?></td>
        <td class="texto_dinero">$<?php echo number_format(obtener_costo_plan($valor[$this->$model->id_tabla]),2);?></td>
        <td align="center"	class="datatable_icono"><a target="_blank" href="<?php echo site_url('pl_planes/ver_plan/'.$valor[$this->$model->id_tabla]);?>" ><?php echo img('public/img/ico_page.png');?></a></td>
        <td align="center"	class="datatable_icono"><a href="<?php echo site_url('pl_modalidades/index/'.$valor[$this->$model->id_tabla]);?>" ><?php echo img('public/img/ico_settings.png');?></a></td>
        <td align="center" class="datatable_icono"><a href="<?php echo site_url('mante_modalidades_docs/index/'.$valor[$this->$model->id_tabla]);?>" ><?php echo img('public/img/ico_posts.png');?></a></td>
        <td align="center">
        <?php
        if($valor['id_estado_plan']==2)
		{
			?>
            <a title="Abierto" onClick="cambiar_estado(<?php echo $valor[$this->$model->id_tabla]; ?>,3);"><?php echo img('public/img/accept.png');?></a>
            <?php
		}else{
			?>
            <a title="Cerrado" onClick="cambiar_estado(<?php echo $valor[$this->$model->id_tabla]; ?>,2);"><?php echo img('public/img/cancel.png');?></a>
            <?php
			}
		?>
		
        
		</td>
        <td align="center" class="datatable_icono"><a title="Editar" onClick="editar_registro(<?php echo $valor[$this->$model->id_tabla]; ?>);"><?php echo img('public/img/edit.png');?></a></td>
        <td align="center" class="datatable_icono">
        
          <a onClick="eliminar_registro(<?php echo $valor[$this->$model->id_tabla]; ?>);" title="Clic para Eliminar"><?php echo img('public/img/cancel.png');?></a>
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
	$.ajax({
		  url: "<?php echo site_url($this->nombre_controlador.'/nuevo');?>",
		  type:"POST",
		  success:function(data){

		  	$.fancybox(data);
		  }
		  
		});
}

function editar_registro(id)
{
	$.ajax({
		  url: "<?php echo site_url($this->nombre_controlador.'/editar');?>/"+id,
		  type:"POST",
		  success:function(data){

		  	$.fancybox(data);
		  }
		  
		});
}

function eliminar_registro(id)
{
	$.ajax({
		  url: "<?php echo site_url($this->nombre_controlador.'/eliminar');?>/"+id,
		  type:"POST",
		  success:function(data){

		  	$.fancybox(data);
		  }
		  
		});
}


function cambiar_estado(id,valor)
{
	if(!confirm('¿Seguro que desea cambiar estado?'))
	{
		return false;
	}

	$.ajax({
		  url: "<?php echo site_url($this->nombre_controlador.'/estado');?>",
		  type:"POST",
		  data:{'id':id,'id_estado_plan':valor},
		  success:function(data){
		  	
		  		location.reload();
		
		  }
		  
		});
}

</script>

