<?php
if ( ! function_exists('comprobar_login'))
{
	function comprobar_login()
	{
		$CI = &get_instance();
		$datos_usuario=$CI->session->userdata('user');

		if(!$datos_usuario)
        {
        	redirect('login');
        }else{

        	return $datos_usuario;
        }
	}
}

function config_lenguaje_tabla()
{
	return '"sPaginationType": "full_numbers",
	        "oLanguage": {
			"sLengthMenu": "Mostrar _MENU_ registros por página",
			"sZeroRecords": "No se encontraron registros",
			"sInfo": "Mostrando _START_ a _END_ de _TOTAL_ registros",
			"sInfoEmpty": "Mostrando 0 a 0 de 0 registros",
			"sInfoFiltered": "(filtrado de _MAX_ total de registros)",
			"sSearch": "Buscar: ",
			"oPaginate": {
        		"sFirst": "Primero",
        		"sLast": "Ultimo",
        		"sNext": "Siguiente",
        		"sPrevious": "Anterior"
      		}
		}';
}

?>