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
      
            <div id="lista_asistencia" >
            <style type="text/css">
			body
{
	font-family:Calibri,Arial;
}
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
                    <p align="left"><b>Fecha:</b> <?php echo date('d/m/Y');?></p>
                    <p align="left"><b>Modalidad:</b> <?php echo $capacitacion['nombre_modalidad'];?></p>
                    <p align="left"><b>Capacitacion:</b> <?php echo $capacitacion['nombre_capacitacion'];?></p>
                    <p align="left"><b>Nombre del Evento:</b> <?php echo $modulo['nombre_modulo'];?></p>
                    <p align="left"><b>Dirigido a:</b> <?php echo $capacitacion['dirigido'];?></p>
                    <p align="left"><b>Lugar:</b> <?php echo $modulo['nombre_lugar'];?></p>
                    <p align="left"><b>Facilitadores:</b> <?php 
					$conta=count($modulo['facilitadores_nombres[]']); 
					$van=0; 
					foreach ($modulo['facilitadores_nombres[]'] as $valor)
					{
						$van++;
						echo $valor;
						if($conta!=$van)
						{
							echo ", ";
							}
					} 
					?> </p>
                    <table width="100%" class="l_tabla">
                    	<tr>
                        	<td align="center"><h3>#</h3></td>
                            <td align="center"><h3>DUI</h3></td>
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
                                 <td><p><?php echo $valor['dui'];?></p></td>
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
            <button onClick="imprimir_asistencia();">Imprimir Asistencia</button> 
            
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
	//imprimir_select("lista_asistencia");
	window.location="<?php echo site_url($this->nombre_controlador."/listado/".$modulo['id_modulo']."/1");?>";
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