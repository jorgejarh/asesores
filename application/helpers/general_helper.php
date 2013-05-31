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


if ( ! function_exists('preparar_select'))
{
	function preparar_select($result,$campo_value,$campo_mostrar)
	{
		$nuevo_array=array();
		
		foreach($result as $valor)
		{
			
			$nuevo_array[$valor[$campo_value]]=$valor[$campo_mostrar];
			
		}
		return $nuevo_array;
	}
}

if ( ! function_exists('traer_errores_form'))
{
	function traer_errores_form()
	{
		//return validation_errors('<div class="fail" class="info_div"><span class="ico_error">','</span></div>');
		return validation_errors('<div class="warning" class="info_div"><span class="ico_error">','</span></div>');
	}
}


if ( ! function_exists('traer_exito_form'))
{
	function traer_exito_form($msj="")
	{
		//return validation_errors('<div class="fail" class="info_div"><span class="ico_error">','</span></div>');
		return '<div class="success" class="info_div"><span class="ico_error">'.$msj.'</span></div>';
	}
}

?>