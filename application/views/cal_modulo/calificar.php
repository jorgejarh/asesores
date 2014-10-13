<h3 align="center"><?php echo $title;?></h3>
<hr>
<?php
echo form_open('',array(
					'id'=>'form_nuevo'
						),
					array(
					'id_modulo'=>$id_modulo
						)
				);
?>
<p>Exelente - 5, Muy Bueno - 4, Bueno - 3, Regular - 2, Malo - 1</p>
<table align="center" style="margin:auto; width:500px; ">
	<?php
	$contador=0;
    foreach($resultados as $valor)
	{
		$contador++;
		?>
        <tr>
        	<td colspan="2"><p><b><?php echo $contador." - ".$valor["nombre"];?></b></p></td>
        	  </tr>
            	<?php
                foreach($valor["aspectos"] as $valor2)
                {
                    ?>
                <tr>
                	<td align="left"><?php echo $valor2["nombre"];?></td>
                    <td align="left"><?php echo form_input(array('class'=>"texto_nota caja_para_numero",'name'=>"calificacion[".$valor2['id_aspectos_considerar']."]"));?></td>
                </tr>
                <?php
				}
				?>
            
      
        <?php
	}
	?>
	
	<tr>
		<td colspan="2"><hr></td>
	</tr>
	<tr>
		<td colspan="2" align="center"><div id="div_error" ></div></td>
	</tr>
	<tr>
		<td colspan="2" align="center">
			<input type="submit" id="save" value="Guardar" />
		</td>
	</tr>
</table>
<?php
echo form_close();
?>
<div class="cargando_">

</div>
<script type="text/javascript">
$(document).ready(function(e){


	$('#form_nuevo').submit(function(){

		form=$(this);

		form.fadeOut('fast',function(){

			$('.cargando_').fadeIn('fast');

			$.ajax({
				  url: "<?php echo site_url($this->nombre_controlador.'/enviar_calificacion');?>",
				  type:"POST",
				  dataType:"json",
				  data:$(this).serialize(),
				  success:function(data){

				  		if(data.error)
				  		{
				  			$('#div_error').html(data.mensaje);
				  			$('.cargando_').fadeOut('fast');
				  			form.fadeIn('fast');
				  		}else{
							$('.cargando_').fadeOut('fast');
							
							$.fancybox.close();
				  			//$.fancybox(data.mensaje);

				  			location.reload();
				  		}
				  		
				  },
				   error:function()
				  {
					 alert("Error al procesar, Intente de nuevo"); 
					 //location.reload();
				  }
			});

		});

		return false;
	});
	
	
});

jQuery(function($){
   $(".texto_nota").mask("99.99");
   
   $(".texto_nota").each(function(index, element) {
    	$(this).keyup(function(e) {
            if(parseInt($(this).val())>=1 && parseInt($(this).val())<=5)
			{
				
			}else{
				$(this).val("");
				return false;
				}
        });
		
	});
   
});

</script>