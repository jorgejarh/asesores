<option value="0">Todas</option>
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