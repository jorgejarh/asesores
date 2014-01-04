<?php
$temas=json_decode($dato['temas']);
?>
<h3 align="center"><?php echo $title;?></h3>
<hr>
<?php
echo form_open('',array(
							'id'=>'form_nuevo'
								),
					array('id'=>$dato[$this->$model->id_tabla])
				);
?>

<table align="center" style="margin:auto;  width:400px;">
	<tr>
    	<td align="center" colspan="2">
        <a onclick="agregar_tem();" style="cursor:pointer;">+ Agregar Tema</a>
        <div class="temas_textos" style="min-height:200px;">
        	<?php
            if($temas)
			{
				foreach($temas as $val)
				{
			?>
            <p><input name="tem[]" type="text" value="<?php echo $val;?>" /> <?php echo img(array(
																'src'=>'public/img/cancel.png',
																'class'=>'elim_tema'
																));?></p>
           <?php
				}
			}
		   ?>
        </div>
        
       
        </td>
    </tr>
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
 <div style="display:none;" class="tem_nuevo"><p><input name="tem[]" type="text" /> <?php echo img(array(
																'src'=>'public/img/cancel.png',
																'class'=>'elim_tema'
																));?></p></div>
<div class="cargando_">

</div>


<script type="text/javascript">
$(document).ready(function(e){
	
	

	

	$('#form_nuevo').submit(function(){

		form=$(this);

		form.fadeOut('fast',function(){

			$('.cargando_').fadeIn('fast');

			$.ajax({
				  url: "<?php echo site_url($this->nombre_controlador.'/actualizar_temas');?>",
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

				  			//$.fancybox(data.mensaje);
							$.fancybox.close();
				  			//location.reload();
				  		}
				  		
				  },
				   error:function()
				  {
					 alert("Error al procesar, Intente de nuevo"); 
					 location.reload();
				  }
			});

		});

		return false;
	});
	
	
	$('.elim_tema').live('click',function(){
		
		$(this).parent('p').remove();
		});

	
});

function agregar_tem()
{
	var text_tem=$('.tem_nuevo').html();
	
	$('.temas_textos').append(text_tem);
	
	$('.temas_textos').find('input:last').focus();
}


</script>