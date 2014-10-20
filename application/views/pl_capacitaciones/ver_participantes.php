<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title><?php echo $title;?></title>

<script type="text/javascript" language="javascript" src="<?php echo base_url();?>public/js/datatable/media/js/jquery.js"></script>
 <!--Datatable-->
	<style type="text/css" title="currentStyle">
			@import "<?php echo base_url();?>public/js/datatable/media/css/demo_table.css";
	</style>
	
	<script type="text/javascript" language="javascript" src="<?php echo base_url();?>public/js/datatable/media/js/jquery.dataTables.js"></script>

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
    <table id="example" class="display" >
   		<thead>
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
            <th>Nota Final</th>
            <th>Asistencia</th>
        </tr>
      	</thead>
         <tbody>
        <?php
        foreach($info as $valor)
		{
			?>
            <tr class="gradeA">
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
            	<td><?php echo $valor['nota_final'];?></td>
                <td><?php echo $valor['por_asistencia'];?>%</td>
        	</tr>
            <?php
		}
		?>
        </tbody>
    </table>
    <pre>
    <?php
       // print_r($info);
		?>
    </pre>
</div>
<script type="text/javascript">
	/*$(document).ready(function() {
	    $('#example').dataTable( {
	        <?php echo config_lenguaje_tabla_sin_nada(100); ?>
	    } );
	} );*/
</script>
</body>
</html>