<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title><?php echo $title;?></title>
<script type="text/javascript" language="javascript" src="<?php echo base_url();?>public/js/datatable/media/js/jquery.js"></script>
<style>
body{
	font-family:Calibri,Arial;}
table
{
	margin:0;
	padding:0;
}
h1,h2,h3,h4
{
	margin:5px;
}
.t td
{
	border:#666 1px solid;
}
</style>
</head>

<body>

<div style="width:100%; margin:auto;" align="center">
 	<h2><?php echo ($dato["nombre_capacitacion"]);?></h2>
    <table width="100%">
    	<tr>
        	<th>Cooperativa</th>
            <th>Nombre</th>
            <?php
            foreach($modulos as $mod)
			{
				?>
                <th><?php echo $mod['nombre_modulo'];?></th>
                <?php
			}
			?>
        </tr>
        <?php
        foreach($info as $valor)
		{
			?>
            <tr>
        		<td align="left"><?php echo $valor['cooperativa'];?></td>
                <td align="left"><?php echo $valor['apellidos'].", ".$valor['nombres'];?></td>
                <?php
				foreach($valor['modulos'] as $mod)
				{
					?>
					<td><?php echo $mod['nota'];?></td>
					<?php
				}
			?>
        	</tr>
            <?php
		}
		?>
    </table>
    <pre>
    <?php
       // print_r($info);
		?>
    </pre>
</div>
</body>
</html>