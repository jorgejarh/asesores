<div id="content_main" class="clearfix">
  <div id="main_panel_container" class="left" style="width:900px;">
    <div id="dashboard" style="width:100%;padding-bottom:50px;">
      <h2 class="ico_mug" style="font-size:15px;">
        <table style="width:100%;">
          <tr>
            <td><?php echo $title; ?></td>
          </tr>
        </table>
      </h2>
      <div class="" style="width:90%; margin:auto;" align="center" >
      		<div id="notas">
            <div class="info_">
            	<p align="left"><b>Plan:</b> <?php echo $modalidad['nombre_plan'];?></p>
            	<p align="left"><b>Modalidad:</b> <?php echo $modalidad['nombre_modalidad'];?></p>
            	<p align="left"><b>Capacitación:</b> <?php echo $capacitacion['nombre_capacitacion'];?></p>
                <p align="left"><b>Modulo:</b> <?php echo $modulo['nombre_modulo'];?></p>
                <p align="left"><b>Registro de notas</b></p>
            </div>
      		<?php
            if($nombres_personas)
			{
			?>
            <?php
            echo form_open('',array('id'=>'form_notas'));
			?>
            <table align="center" width="95%">
            	<tr>
                	<td align="left" valign="middle"><b>Nombre de la persona</b></td>
                    <?php
                    foreach($evaluaciones as $una_evaluacion)
					{
						?>
						<td align="center" valign="middle"><b><?php echo $una_evaluacion['nombre_tipo_evaluacion']." (".$una_evaluacion['porcentaje']."%) ";?></b></td>
                        <?php
					}
					if($modulo['puede_evaluar']==0)
					{
						?>
                        <td align="center" valign="middle"><b>Nota Final</b></td>
                        <?php
					}
					?>
                </tr>
                <?php
				$son=count($nombres_personas);
				$van=0;
                foreach($nombres_personas as $valor)
				{
					
				?>
                <tr class="tr_table">
                	<td align="left" valign="middle"><?php echo $valor['apellidos'].", ".$valor['nombres'];?> <input type="hidden" name="id_asistencia[<?php echo $van;?>]" value="<?php  echo $valor['id_asistencia'];?>" /></td>
                    
                    <?php
					$final=0;
                    foreach($valor['notas'] as $nota)
					{
						?>
						<td align="center" valign="middle"><?php
						$final+=$nota['nota']*($nota['porcentaje']/100);
						if($modulo['puede_evaluar']==1)
						{
							echo form_input(array('class'=>"caja_nota texto_nota",'name'=>'notas['.$nota['id_nota_x_modulo'].']','value'=>$nota['nota']));
						}else{
							echo "".$nota['nota']."";
							} 
						
                        ?>
                        </td>
                        <?php
					}
					
                   if($modulo['puede_evaluar']==0)
					{
						?>
                        <td align="center" valign="middle"><b><?php echo number_format($final,2);?></b></td>
                        <?php
					}
					?>
                </tr>
                <?php
					$van++;
				}
				?>
            </table>
            <br />
            
            <?php
			echo form_close();
			?>
            </div>
            <?php
            if($modulo['puede_evaluar']==1)
			{
				if($evaluaciones)
				{
					?>
                 <div align="center"><input type="submit" value="Guardar" onclick="return validar_enviar();" /></div>
                <?php
				}else{
					?>
                    <div align="center"><p>No hay evaluaciones asignadas a este modulo</p></div>
                    <?php
					}
				
			}else{
				?>
                <div align="center"><button onClick="imprimir_slect('notas');">Imprimir</button></div>
                <?php
				}
				
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

function validar_enviar()
{
	if(confirm('¿Seguro que desea enviar notas? No podra modificar despues del envio.'))
	{
		return true;
	}else{
		return false;
		}
}

jQuery(function($){
   $(".texto_nota").mask("99.99");
});




</script> 

<script type="text/javascript">
function imprimir_slect(muestra)
{var ficha=document.getElementById(muestra);var ventimp=window.open(' ','popimpr');ventimp.document.write(ficha.innerHTML);ventimp.document.close();ventimp.print();ventimp.close();}
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

.info_
{
	display:none;
}
</style>