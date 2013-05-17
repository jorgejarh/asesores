<option value="0">Todas</option>
<?php
if($sucursales)
{
	foreach($sucursales as $valor)
	{
		?>
		<option value="<?php echo $valor['id_sucursal'];?>"><?php echo $valor['sucursal'];?></option>
		<?php
	}
}
?>