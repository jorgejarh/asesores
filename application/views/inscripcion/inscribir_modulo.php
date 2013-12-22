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
      <div class="" style="width:90%; margin:auto;" align="center">
      
      		<?php
            if($nombres_personas)
			{
			?>
            <?php
            echo form_open('');
			?>
            <table align="center" width="80%">
            	<tr>
                	<td align="center" valign="middle"><b>Nombre de la persona</b></td>
                    <td align="center" valign="middle"><b>Preinscrito</b></td>
                    <td align="center" valign="middle"><b>Inscribir</b></td>
                    <!--<td align="center" valign="middle"><b>Nota</b></td>-->
                </tr>
                <?php
				$son=count($nombres_personas);
				$van=0;
                foreach($nombres_personas as $valor)
				{
					
				?>
                <tr class="tr_table">
                	<td align="center" valign="middle"><?php echo $valor['apellidos'].", ".$valor['nombres'];?> <input type="hidden" name="id_asistencia[<?php echo $van;?>]" value="<?php  echo $valor['id_asistencia'];?>" /></td>
                    <!--<td align="center" valign="middle"><input type="hidden" name="asistio[<?php echo $van;?>]" value="0" /><input  <?php if($valor['asistio']==1){ echo 'checked="checked"'; } ?> type="checkbox" value="1" name="asistio[<?php echo $van;?>]" /></td>-->
                    
                    <td align="center" valign="middle"><input type="hidden" name="asistio[<?php echo $van;?>]" value="0" /><input  <?php if($valor['asistio']==1){ echo 'checked="checked"'; } ?> type="checkbox" value="1" name="asistio[<?php echo $van;?>]" /></td>
                    
                    <td align="center" valign="middle"><input type="hidden" name="aprobado[<?php echo $van;?>]" value="0" /><input  <?php if($valor['aprobado']==1){ echo 'checked="checked"'; } ?> type="checkbox" value="1" name="aprobado[<?php echo $van;?>]" />
                    <input type="hidden" name="nota[<?php echo $van;?>]" value="0" />
                    </td>
                    
                   <!--<td align="center" valign="middle"><input class="texto_nota" type="text" name="nota[<?php echo $van;?>]" value="<?php echo $valor['nota'];?>" /></td>-->
                </tr>
                <?php
					$van++;
				}
				?>
            </table>
            <div align="center"><input type="submit" value="Enviar Inscripcion" /></div>
            
			<?php
			
			echo form_close();
			
			}else{
				?>
                <h1>No hay Personas inscritas a este modulo</h1>
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
$(document).ready(function(e) {
    
	
	<?php
	if($mensaje)
	{
		?>
		alert('<?php echo $mensaje;?>');
		<?php
	}
	?>
	
	$('.texto_nota').mask("99.99");
	
});


</script> 
<style>
.tr_table:hover
{
	background:#CCC;
	
}
.tr_table
{
	height:35px;
}
.texto_nota
{
	width:50px!important;
}
</style>