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
      	<th>Nombre</th>
        <th>Email</th>
        <th>Agregar Documentos</th>
        <th>Asigar Profesión</th>
        <th>Asigar Especialidad</th>
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
      	<td><?php echo $valor['apellidos'].", ".$valor['nombres'];?></td>
       <td><?php echo $valor['correo'];?></td>
       <td align="center" class="datatable_icono"><a href="<?php echo site_url('mante_facilitadores_docs/index/'.$valor[$this->$model->id_tabla]);?>" ><?php echo img('public/img/ico_posts.png');?></a></td>
        <td align="center" class="datatable_icono"><a onClick="profesiones(<?php echo $valor[$this->$model->id_tabla]; ?>);"><?php echo img('public/img/ico_page.png');?></a></td>
        <td align="center" class="datatable_icono"><a onClick="especialidades(<?php echo $valor[$this->$model->id_tabla]; ?>);"><?php echo img('public/img/ico_settings.png');?></a></td>
        <td align="center" class="datatable_icono"><a title="Editar" onClick="editar_registro(<?php echo $valor[$this->$model->id_tabla]; ?>);"><?php echo img('public/img/edit.png');?></a></td>
        <td align="center" class="datatable_icono">
        
          <a title="Eliminar" onClick="eliminar_registro(<?php echo $valor[$this->$model->id_tabla]; ?>);" title="Clic para Eliminar"><?php echo img('public/img/cancel.png');?></a>
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
	if(!confirm('¿Seguro que desea eliminar?'))
	{
		return false;
	}

	$.ajax({
		  url: "<?php echo site_url($this->nombre_controlador.'/eliminar');?>",
		  type:"POST",
		  data:{'id':id},
		  success:function(data){
		  	
		  		location.reload();
		
		  }
		  
		});
}

function profesiones(id)
{
	$.ajax({
		  url: "<?php echo site_url($this->nombre_controlador.'/profesiones');?>/"+id,
		  type:"POST",
		  success:function(data){

		  	$.fancybox({
				content:data,
				autoHeight:true
				});
		  }
		  
		});
}

function especialidades(id)
{
	$.ajax({
		  url: "<?php echo site_url($this->nombre_controlador.'/especialidades');?>/"+id,
		  type:"POST",
		  success:function(data){

		  	$.fancybox({
				content:data,
				autoHeight:true
				});
		  }
		  
		});
}



</script>

