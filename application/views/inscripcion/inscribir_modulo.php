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
      
      	<button onClick="nueva_persona();">Inscribir Persona</button>
            <button onClick="registrar_persona();">Registrar Persona</button>
            <button ><a target="_blank" href="<?php echo site_url('f_listado/listado/'.$modulo['id_modulo']);?>">Imprimir Lista</a></button>
      	<div class="form_user" style="display:none;"></div>
      		<?php
            if($nombres_personas)
			{
			?>
            <?php
            echo form_open('');
			?>
            <table id="example" class="display" >
            <thead>
              <tr>
              	<th>Nº</th>
                <th>DUI</th>
                <th>Nombres</th>
                <th>Apellidos</th>
                <th>PreInscrito</th>
                <th>Inscrito</th>
                <th>Eliminar</th>
              </tr>
            </thead>
            <tbody>
            	  <?php
				$son=count($nombres_personas);
				$van=0;
				$contador_lista=0;
                foreach($nombres_personas as $valor)
				{
					
					$contador_lista++;
				?>
                 <tr class="gradeA">
                 	<td align="center" valign="middle"><?php echo $contador_lista;?></td>
                    <td align="center" valign="middle"><?php echo $valor['dui'];?></td>
                	<td align="center" valign="middle"><?php echo $valor['nombres'];?></td>
                    <td align="center" valign="middle"><?php echo $valor['apellidos'];?></td>
                    
                    <td align="center" valign="middle">
                    <?php 
					if($valor['asistio']==1)
					{
						echo img('public/img/accept.png');
					}else{
						echo img('public/img/cancel.png');
						}
					?>
                    </td>
                    
                    <td align="center" valign="middle">
                     <?php 
					if($valor['aprobado']==1)
					{
						?>
                        <a onclick="inscribir_persona_uno(<?php echo $valor['asistio'].",0,".$valor['id_asistencia']; ?>);"><?php echo img('public/img/accept.png');?></a>
						<?php
					}else{
						?>
                        <a onclick="inscribir_persona_uno(<?php echo $valor['asistio'].",1,".$valor['id_asistencia']; ?>);"><?php echo img('public/img/cancel.png');?></a>
						<?php
						}
					?>
                    </td>
                    <td align="center" valign="middle">
                     <a onClick="eliminar_registro(<?php echo $valor['id_asistencia'].",".$valor['id_inscripcion_personas']; ?>);" title="Eliminar"><?php echo img('public/img/cancel.png');?></a>
                     </td>
                </tr>
                <?php
				}
				?>
            </tbody>
            </table>
          
			<?php
			
			echo form_close();
			
			}
			?>
            
              <!--<button onClick="imprimir_asistencia();">Imprimir Asistencia</button> -->
            <!--<button onClick="opinion();">Opinion de Participantes</button> -->

            <div id="lista_asistencia" style="display:none;">
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
                               	<td><p><?php echo $valor['correo'];?></p></td>
                            	
                            </tr>
                            <?php
							$contador_persona++;
						}
						?>
                    </table>
                </div>
                
            </div>
            
            
      </div>
    </div>
    <!-- end #dashboard --> 
  </div>
  
  <!-- end #sidebar --> 
  
</div>



<script type="text/javascript">


function inscribir_persona_uno(asistio,aprobado,id_asistencia)
{
	
	$.ajax({
		  url: "<?php echo site_url($this->nombre_controlador.'/inscribir_modulo_una_persona/'.$modulo['id_modulo']);?>",
		  type:"POST",
		  data:{'asistio':asistio, 'aprobo':aprobado,'id_asistencia':id_asistencia},
		  success:function(data){

		  	location.reload();
		  }
	
	});
}


function eliminar_registro(id,id_2)
{
	if(confirm("¿Esta seguro de eliminar?"))
	{
		$.ajax({
			  url: "<?php echo site_url($this->nombre_controlador.'/eliminar_asistencia/');?>",
			  type:"POST",
			  data:{'id':id,'id_2':id_2},
			  success:function(data){
	
				location.reload();
			  }
		
		});
	}
}

function opinion()
{
	window.location="<?php echo site_url("opinion/index/".$modulo['id_modulo']);?>";
}

function imprimir_asistencia()
{
	imprimir_select("lista_asistencia");
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

function registrar_persona()
{
	$.ajax({
		  url: "<?php echo site_url($this->nombre_controlador.'/registrar_persona/'.$modulo['id_capacitacion'].'/'.$modulo['id_modulo']);?>",
		  type:"POST",
		  success:function(data){
			  
			  	$('.form_user').html(data);
		  		$('.form_user').toggle();
		  }
		  
		});
}

function calificar(id)
{
	$.ajax({
		  url: "<?php echo site_url($this->nombre_controlador.'/calificar');?>/"+id,
		  type:"POST",
		  success:function(data){

		  	$.fancybox(data);
		  }
	
	});
}

$(document).ready(function() {
	    $('#example').dataTable( {
	        <?php echo config_lenguaje_tabla(25); ?>
	    } );
	} );

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