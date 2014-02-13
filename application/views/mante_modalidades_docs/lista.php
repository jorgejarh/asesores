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
      <div class="bot_atras">
      	<?php
        echo anchor('mante_modalidades','&lt;- Regresar');
		?>
    	
      </div>
      <?php
      if($error)
		{
			?>
            <div style="color:#900; text-align:center;">
            <?php
			foreach($error as $e)
			{
				echo $e;
			}
			?>
            </div>
            <?php
		}
		?>
      <div class="form_nuevo_archivo" align="center">
      <h4 align="center">Nuevo Documento</h4>
      	<?php
        echo form_open_multipart();
		?>
        <table>
        	<tr>
            	<td>Nombre:</td>
                <td><?php echo form_input(array('name'=>'nombre_doc'));?></td>
                <td>Archivo:</td>
                <td><?php echo form_upload(array('name'=>'archivo_doc'));?></td>
                <td><button>Enviar</button></td>
            </tr>
            <tr>
            	<td colspan="5">Tamaño maximo del archivo: 7 MB</td>
                
            </tr>
        </table>
        <?php
		echo form_close();
		?>
      </div>
      <div class="" style="width:90%; margin:auto;">
      
        <?php
if($listado)
{
	?>
  <table id="example" class="display" >
    <thead>
      <tr>
      	<th>Nombre</th>
        <th>Documento</th>
        <th>Fecha de creacion</th>
        <th>&nbsp;</th>
      </tr>
    </thead>
    <tbody>
      <?php
		foreach($listado as $valor)
		{
			?>
      <tr class="gradeA">
      	<td align="center"><?php echo $valor['nombre_doc'];?></td>
        <td align="center"><?php echo anchor( base_url('public/archivos_modalidades/'.$valor['archivo']),$valor['archivo'],array('target'=>'_blank'));?></td>
        <td align="center"><?php echo date('d/m/Y',strtotime($valor['f_creacion']));?></td>
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
	$('.form_nuevo_archivo').toggle('slow');
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

</script>
<style type="text/css">
.form_nuevo_archivo
{
	margin-top:20px;
	margin-bottom:20px;
	display:none;
	border:#666 solid 1px;
	padding:10px;
}
</style>
