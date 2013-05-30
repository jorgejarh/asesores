<h3 align="center">Subir Logo de Cooperativa</h3>
<hr>
<?php
echo form_open_multipart('cooperativas/do_upload',array(
						'id'=>'form_nuevo',
						"target" => "subeArc"
							)
				);
?>
<div id="ok"  style="display:none"></div>
<div id="error" style="display:none"></div>
<table>
	<tr>
		<td valign="middle">Logo: </td>
		<td valign="middle"><input type="file" name="file" is="file" size="25" /></td>
	</tr>
	<tr>
		<td></td>
		<td>
			<div style="float:left"><input type="submit" id="save" value="Subir"/></div>
			<div id="cerrar" style="float:right;display:none"><button onClick="cerrar();">Cerrar</button></div>
		</td>
		<input type="hidden" value="<?php echo $id_cooperativa; ?>" name="id_cooperativa">
	</tr>
</table>

<?php
echo form_close();
?>

<iframe name="subeArc" id="subeArc" style="display:none"></iframe>
<hr>


<style>
#ok{
	background-color: #D0F5A9;
	margin: auto;
	text-align: center;
	display: block;
}
#error{
	background-color: #F5A9A9;
	margin: auto;
	text-align: center;
	display: block;
}
</style>

<script>
		function cerrar(){
			location.reload();
		}

		$(document).ready(function() {


			var arc = ""; 

			$('input:file').change(function(){
				arc = this.files[0].name;
			});

			$('#form_nuevo').submit(function(){
				if(arc == ""){
					alert("No ha seleccionado ningun archivo")
					return false;
				}
				else if((!arc.match(/.(png)$/)) && (!arc.match(/.(jpg)$/))){
					alert("Error: solo se permiten extensiones: *.png y *.jpg");
					return false;
				}else{
					$('#save').attr("disabled", true);
				}
			});


		});
</script>