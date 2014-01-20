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
            <table align="center" width="80%" class="lista_personas">
            	<tr>
                	<td align="center" valign="middle"><b>Nombre de la persona</b></td>
                    <td align="center" valign="middle"><b>Preinscrito</b></td>
                    <td align="center" valign="middle"><b>Inscribir</b></td>
                   
                </tr>
                <?php
				$son=count($nombres_personas);
				$van=0;
                foreach($nombres_personas as $valor)
				{
					
				?>
                <tr class="tr_table">
                	<td align="center" valign="middle"><?php echo $valor['apellidos'].", ".$valor['nombres'];?> <input type="hidden" name="id_asistencia[<?php echo $van;?>]" value="<?php  echo $valor['id_asistencia'];?>" /></td>
                    
                    
                    <td align="center" valign="middle"><input type="hidden" name="asistio[<?php echo $van;?>]" value="0" /><input  <?php if($valor['asistio']==1){ echo 'checked="checked"'; } ?> type="checkbox" value="1" name="asistio[<?php echo $van;?>]" /></td>
                    
                    <td align="center" valign="middle"><input type="hidden" name="aprobado[<?php echo $van;?>]" value="0" /><input  <?php if($valor['aprobado']==1){ echo 'checked="checked"'; } ?> type="checkbox" value="1" name="aprobado[<?php echo $van;?>]" />
                   
                    </td>
                </tr>
                <?php
					$van++;
				}
				?>
            </table>
            <div align="center"><input type="submit" value="Enviar Inscripcion" /></div>
            
			<?php
			
			echo form_close();
			?>
            
            <button onClick="nueva_persona();">Inscribir Persona</button> <button onClick="imprimir_asistencia();">Imprimir Asistencia</button> 
            <button onClick="opinion();">Opinion de Participantes</button> 
            
            
            <div class="form_user" style="display:none;"></div>
            
            <div id="lista_asistencia" style="display:none;">
            	<div align="center" class="a_">
                	<h2>FUNDACIÓN ASESORES PARA EL DESARROLLO</h2>
                    <p align="left"><b>Fecha:</b></p>
                    <p align="left"><b>Nombre del Evento:</b> <?php echo $modulo['nombre_modulo'];?></p>
                    <p align="left"><b>Dirigido a:</b></p>
                    <p align="left"><b>Lugar:</b></p>
                    
                    <table width="100%" class="l_tabla">
                    	<tr>
                        	<td align="center"><h3>#</h3></td>
                            <td align="center"><h3>Nombres</h3></td>
                            <td align="center"><h3>Cooperativa</h3></td>
                            <td align="center"><h3>Sucursal</h3></td>
                            <td align="center"><h3>Cargo</h3></td>
                            <td align="center"><h3>Firma</h3></td>
                            <td align="center"><h3>e-mail</h3></td>
                        </tr>
                    	<?php
						$contador_persona=1;
                        foreach($nombres_personas as $valor)
						{
							?>
                            <tr>
                            	<td><p align="center"><?php echo $contador_persona;?></p></td>
                                <td><p><?php echo $valor['apellidos'].", ".$valor['nombres'];?></p></td>
                                <td><p><?php echo $valor['nombre_cooperativa'];?></p></td>
                                <td><p><?php echo $valor['nombre_sucursal'];?></p></td>
                                <td><p><?php echo $valor['nombre_cargo'];?></p></td>
                                <td width="100">&nbsp;</td>
                                <td width="100">&nbsp;</td>
                            	
                            </tr>
                            <?php
							$contador_persona++;
						}
						?>
                    </table>
                </div>
                <style type="text/css">
				.a_ h3
				{
					margin:0px;
				}
				.a_ table
				{
					border-spacing:0;
					border-collapse:collapse;
				}
				.a_ tr td
				{
					border:1px #000000 solid;
					padding:5px;
					margin:0px;
					vertical-align:middle;
				}
				</style>
            </div>
            
            <?php
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

function opinion()
{
	window.location="<?php echo site_url("opinion/index/".$modulo['id_modulo']);?>";
}

function imprimir_asistencia()
{
	imprimir_select("lista_asistencia");
}

function crear_tr(apellidos,nombres,id_asistencia,cooperativa,sucursal,cargo)
{
	total_filas=$('.lista_personas tr').size();
	total_filas=total_filas-1;
	tr= '<tr class="tr_table">'+
                	'<td align="center" valign="middle">'+apellidos+', '+nombres+'<input type="hidden" name="id_asistencia['+total_filas+']" value='+id_asistencia+'" /></td>'+
                    '<td align="center" valign="middle"><input type="hidden" name="asistio['+total_filas+']" value="0" /><input checked="checked" type="checkbox" value="1" name="asistio['+total_filas+']" /></td>'+
                    '<td align="center" valign="middle"><input type="hidden" name="aprobado['+total_filas+']" value="0" /><input  checked="checked" type="checkbox" value="1" name="aprobado['+total_filas+']" />'+
                    '</td>'+
                '</tr>';
	$('.lista_personas').append(tr);
	
	tr2='<tr>'+
                            	'<td><p align="center">'+(total_filas+1)+'</p></td>'+
                                '<td><p>'+apellidos+', '+nombres+'</p></td>'+
                                '<td><p>'+cooperativa+'</p></td>'+
                                '<td><p>'+sucursal+'</p></td>'+
                                '<td><p>'+cargo+'</p></td>'+
                                '<td width="100">&nbsp;</td>'+
                                '<td width="100">&nbsp;</td>'+
                            '</tr>';
	$('.l_tabla').append(tr2);
}

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

function nueva_persona()
{
	$.ajax({
		  url: "<?php echo site_url($this->nombre_controlador.'/nueva_persona/'.$modulo['id_capacitacion'].'/'.$modulo['id_modulo']);?>",
		  type:"POST",
		  success:function(data){
			  
			  	$('.form_user').html(data);
		  		$('.form_user').toggle();
		  }
		  
		});
}
</script> 

<script type="text/javascript">
function imprimir_select(muestra)
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
</style>