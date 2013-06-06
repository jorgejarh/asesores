<h3 align="center">Gestion de Sucursales - Nuevo</h3>
<hr>
<?php
echo form_open('',array(
						'id'=>'form_nuevo'
							)
				);
?>

<table>
	<tr>
		<td colspan="2" align="center"><div id="error" style="color:red;"></div></td>
	</tr>
    <tr>
		<td valign="middle">Cooperativa: </td>
		<td valign="middle">
        <select id="id_cooperativa" name="id_cooperativa" class="requerido">
            <?php
            if($cooperativas)
			{
				foreach($cooperativas as $valor)
				{
					?>
                    <option value="<?php echo $valor['id_cooperativa'];?>"><?php echo $valor['cooperativa'];?></option>
                    <?php
				}
			}
			?>
        </select>
        </td>
	</tr>
	<tr>
		<td valign="middle">Nombre de la sucursal: </td>
		<td valign="middle"><input type="text" id="sucursal" name="sucursal" class="requerido" /></td>
	</tr>
    <tr>
		<td valign="middle">Telefono: </td>
		<td valign="middle"><input type="text"  name="telefono" class="requerido" /></td>
	</tr>
    <tr>
		<td valign="middle">Fax: </td>
		<td valign="middle"><input type="text"  name="fax" class="requerido" /></td>
	</tr>
	<tr>
		<td colspan="2"><hr></td>
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
		
		valido=validar_form("#"+$(this).attr('id'));
		
		
		if(valido==false)
		{
			return false;
		}

		form=$(this);
		
		form.fadeOut('fast',function(){
			
			
			$('.cargando_').fadeIn('fast');

			$.ajax({
				  url: "<?php echo site_url('sucursales/insertar_sucursal');?>",
				  type:"POST",
				  data:$(this).serialize(),
				  success:function(data){
	
						if(data=="ok")
						{
							alert('Registro guardado correctamente.');
							location.reload();
						}else{
							$('.cargando_').fadeOut('fast');
								form.fadeIn('fast');	
							alert(data);
						}
						
				  }
			});

		});
		
			return false;
	});
	
	

});

</script>