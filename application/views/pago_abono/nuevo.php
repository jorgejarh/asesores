<pre>
<?php
//print_r($modulos);
?>
</pre>
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
                    	<td align="right">Abono:
                       $ <input type="text" name="abono"/></td>
                    </tr>
                    <tr>
                    	<td align="right">
                       Abonar equitativamente a todos los modulos<input value="1" type="checkbox" name="tipo_abono" />  </td>
                    </tr>
                    <tr>
                    	<td align="left">
                        	<table id="example" class="display">
                            <thead>
                            	 <tr>
                            	<th><b>Nombre del Modulo</b></th>
                                <th><b>Saldo Actual en $</b></th>
                                <th><b>Cantidad a abonar en $</b></th>
                                <th><b>Nuevo Saldo en $</b></th>
                            </tr>
                            </thead>
                           <tbody>
                            	<?php
								$total_saldo=0;
                                foreach($modulos as $valor)
								{
									?>
                                    <tr class="gradeA">
                                    	<td valign="middle" width="300"><?php echo $valor['nombre_modulo'];?></td>
                                        <td valign="middle" align="center" class="saldo_actual_<?php echo $valor['id_modulo'];?>"><?php echo $valor['saldo'];?></td>
                                        <td valign="middle" align="center"><?php echo form_input(array('id_mod'=>$valor['id_modulo'],'class'=>'caja_abono','name'=>'modulo['.$valor['id_modulo'].']')); $total_saldo+=$valor['saldo'];?></td>
                                        <td valign="middle"  align="center"><div class="nuevo_saldo_<?php echo $valor['id_modulo'];?>">00.00</div></td>
                                    </tr>
                                    <?php
								}
								?>
                                <tr class="gradeA">
                                	<td align="right"><b>Totales</b></td>
                                    <td align="center"><b class="saldo_total"><?php echo number_format($total_saldo,2);?></b></td>
                                    <td align="center"><b class="total_abonar">0.00</b></td>
                                    <td align="center"><b class="nuevo_saldo_total">0.00</b></td>
                                </tr>
                             </tbody>
                           </table>
                        </td>
                    </tr>
               </table>
               <!--<p align="center"><input  type="submit" value="Guardar" name="enviar"/></p>-->
		        <?php
                echo form_close();
				?>
    		</div>
    	</div>
    	<!-- end #dashboard --> 
  	</div>
  	
  	<!-- end #sidebar --> 
  
</div>
<script type="text/javascript">
$(document).ready(function(e) {
    $("input[name=tipo_abono]").click(function(e) {
        if($(this).is(':checked'))
		{
			var porcentaje=(parseFloat($("input[name=abono]").val())/parseFloat($(".saldo_total").html()));
			console.log(porcentaje);
			var total_abono=0;
			//var 
			$(".caja_abono").each(function(index, element) {
				
				$(this).val((parseFloat($(".saldo_actual_"+$(this).attr('id_mod')).html())*porcentaje).toFixed(2));
				$(".nuevo_saldo_"+$(this).attr('id_mod')).html((parseFloat($(".saldo_actual_"+$(this).attr('id_mod')).html())-parseFloat($(this).val())).toFixed(2));
				
				
				total_abono=total_abono+parseFloat($(this).val());
              	$(this).attr('readonly', true); 
				
            });
			
			$('.total_abonar').html((total_abono).toFixed(2));
			
		}else{
			$(".caja_abono").each(function(index, element) {
               $(this).attr('readonly', false); 
            });
		}
    });
});

jQuery(function($){
   $(".caja_abono").mask("#0.00", {reverse: true,maxlength: false});
});


</script>
<style type="text/css">
.caja_abono{ width:120px!important;}
</style>