<div id="content_main" class="clearfix">
  <div id="main_panel_container" class="left">
    <div id="dashboard" style="width:100%;padding-bottom:50px;">
      <h2 class="ico_mug">
        <table style="width:100%;">
          <tr>
            <td><?php echo $title;?></td>
            <td style="text-align:right;"><button onClick="nuevo_registro();">Nuevo</button></td>
          </tr>
        </table>
      </h2>
      <div align="right">
	<?php
    	echo anchor(uri_string().'/index/descargar',img(array('src'=>'public/img/excel_icon.png','title'=>'Descargar en Excel')));
	?>
		</div>
      <div class="" style="width:95%; margin:auto; font-size:8px; overflow:auto;">
        <?php
if($listado)
{
	?>
        <table id="example" class="display" >
          <thead>
            <tr>
              <th>N° OFERTA</th>
              <th>SERVICIO</th>
              <th>TÍTULO</th>
              <th>COOPERATIVA</th>
              <th>FECHA DE ENVÍO AL SOLICITANTE</th>
              <th>RESOLUCIÓN</th>
              <th>Vigencia de la Oferta</th>
              <th>Fecha de Aceptada</th>
              <th>Días efectivos de resolución</th>
              <th>INICIA</th>
              <th>FINALIZA</th>
              <th>Dias Habiles</th>
              <th>ESTADO</th>
              <th>FECHA DE ENTREGA</th>
              <th>Días efectivos</th>
              <th>MONTO</th>
              <th>OBSERVACIÓN</th>
              <th>MONTOS</th>
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
              <td><?php echo $valor['codigo_oferta'];?></td>
              <td><?php echo $valor['nombre_servicio'];?></td>
              <td><?php echo $valor['nombre_capacitacion'];?></td>
              <td><?php echo $valor['cooperativa'];?></td>
              <td><?php echo $valor['fecha_envio_solicitante'];?></td>
              <td><?php echo $valor['nombre_resolucion'];?></td>
              <?php  
	 $vigencia= contar_dias($valor['fecha_envio_solicitante'],date("Y-m-d"));
	  ?>
              <td style="color:<?php if($vigencia>=30){ echo "red;";}else{echo "black;";}?>"><?php 
	  echo $vigencia;
	  ?></td>
              <td><?php echo validar_fecha($valor['fecha_aceptada']);?></td>
              <td><?php echo contar_dias($valor['fecha_envio_solicitante'],$valor['fecha_aceptada']);?></td>
              <td><?php echo validar_fecha($valor['fecha_inicio']);?></td>
              <td><?php echo validar_fecha($valor['fecha_fin']);?></td>
              <td><?php echo eva_dias_f(DiasHabiles($valor['fecha_inicio'],$valor['fecha_fin'] ));?></td>
              <td><?php echo $valor['nombre_estado'];?></td>
              <td><?php echo validar_fecha($valor['fecha_entrega']);?></td>
              <td><?php echo eva_dias_f(DiasHabiles($valor['fecha_inicio'],$valor['fecha_entrega'] ));?></td>
              <td><?php echo $valor['monto'];?></td>
              <td><?php echo $valor['observacion'];?></td>
              <td><?php echo $valor['montos'];?></td>
              <td align="center" class="datatable_icono"><a title="Editar" onClick="editar_registro(<?php echo $valor[$this->$model->id_tabla]; ?>);"><?php echo img('public/img/edit.png');?></a></td>
              <td align="center" class="datatable_icono"><a onClick="eliminar_registro(<?php echo $valor[$this->$model->id_tabla]; ?>);" title="Clic para Eliminar"><?php echo img('public/img/cancel.png');?></a></td>
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




</script> 
