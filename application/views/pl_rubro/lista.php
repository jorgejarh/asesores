<div id="content_main" class="clearfix">
  <div id="main_panel_container" class="left" style="width:900px;">
    <div id="dashboard" style="width:100%;padding-bottom:50px;">
    
    
      <h2 class="ico_mug">
      	<table style="width:100%;">
      		<tr>
      			<td><?php echo $modulo['nombre_modulo'];?></td>
      			<td style="text-align:right;"><button onClick="nuevo_registro(<?php echo $modulo['id_modulo']?>);">Nuevo</button></td>
      		</tr>
      	</table>
      </h2>
      <div class="bot_atras">
    	<?php
        echo anchor('pl_modulos/index/'.$modulo['id_capacitacion'],'<- Regresar');
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
      	<th>Nº</th>
      	<th>Nombre del Rubro</th>
        <th>Sub Rubros</th>
        <th>Total</th>
        <th>Asignar Detalle</th>
        <th>&nbsp;</th>
        <th>&nbsp;</th>
      </tr>
    </thead>
    <tbody>
      <?php
	  $conta=0;
		foreach($listado as $valor)
		{
			$conta++;
			$total_rubro=0.00;
			?>
      <tr class="gradeA">
      	<td><?php echo $conta;?></td>
      	<td><?php echo $valor['nombre_rubro'];?></td>
        <td><?php
			if($valor['sub'])
			{
				foreach($valor['sub'] as $sub)
				{
					$subtotal=$sub['costo']*$sub['unidades']*$sub['dias'];
					echo '<div><a title="Total: $ '.number_format($subtotal,2).'">- '.$sub['nombre'].'</a></div>';
					$total_rubro+=$subtotal;
				}
			}else{
				echo "-";
				}
				
		?></td>
       <td>$ <?php echo number_format($total_rubro,2);?></td>
        <td align="center"	class=""><a href="<?php echo site_url('pl_subrubro/index/'.$valor[$this->$model->id_tabla]);?>" ><?php echo img('public/img/ico_settings.png');?></a></td>
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

function nuevo_registro(id)
{
	$.ajax({
		  url: "<?php echo site_url($this->nombre_controlador.'/nuevo');?>/"+id,
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

