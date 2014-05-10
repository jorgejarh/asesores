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
         <div class="bot_atras">
    	<?php
        echo anchor($this->nombre_controlador."/abonar/".$cooperativa['id_cooperativa'],'<- Regresar');
		?>
    </div>
      		<div class="" style="width:90%; margin:auto;">
           <?php
           echo form_open('',array(
					'id'=>'form_nuevo'
						),
					array(
					'id_cooperativa'=>$cooperativa['id_cooperativa'],
					'fecha_creacion'=>date('Y-m-d H:i:s'),
					'id_usuario_add'=>$this->datos_user['id_usuario']
						)
				);
				?>
      	       <table width="100%">
               		<tr>
                    	<td>Abono: <input type="text" name="abono"/></td>
                    </tr>
               </table>
               <p align="center"><input  type="submit" value="Guardar" name="enviar"/></p>
		        <?php
                echo form_close();
				?>
    		</div>
    	</div>
    	<!-- end #dashboard --> 
  	</div>
  	
  	<!-- end #sidebar --> 
  
</div>