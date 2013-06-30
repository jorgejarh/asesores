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

if ( ! function_exists('cortar_texto'))
{
	function cortar_texto($string, $length=NULL,$text_s="...")
	{
		 //Si no se especifica la longitud por defecto es 50
		if ($length == NULL)
			$length = 50;
		//Primero eliminamos las etiquetas html y luego cortamos el string
		$stringDisplay = substr(strip_tags($string), 0, $length);
		//Si el texto es mayor que la longitud se agrega puntos suspensivos
		if (strlen(strip_tags($string)) > $length)
			$stringDisplay .= $text_s;
		return $stringDisplay;
	}
}


if ( ! function_exists('fecha_es'))
{
	function fecha_es($fecha="")
	{
		$dia=date("l",strtotime($fecha));
 
		if ($dia=="Monday") $dia="Lunes";
		if ($dia=="Tuesday") $dia="Martes";
		if ($dia=="Wednesday") $dia="Miércoles";
		if ($dia=="Thursday") $dia="Jueves";
		if ($dia=="Friday") $dia="Viernes";
		if ($dia=="Saturday") $dia="Sabado";
		if ($dia=="Sunday") $dia="Domingo";
		 
		$mes=date("F",strtotime($fecha));
		 
		if ($mes=="January") $mes="Enero";
		if ($mes=="February") $mes="Febrero";
		if ($mes=="March") $mes="Marzo";
		if ($mes=="April") $mes="Abril";
		if ($mes=="May") $mes="Mayo";
		if ($mes=="June") $mes="Junio";
		if ($mes=="July") $mes="Julio";
		if ($mes=="August") $mes="Agosto";
		if ($mes=="September") $mes="Setiembre";
		if ($mes=="October") $mes="Octubre";
		if ($mes=="November") $mes="Noviembre";
		if ($mes=="December") $mes="Diciembre";

		$fecha_ex=explode("-",$fecha);
		
		return array('dia_nombre'=>$dia,'mes_nombre'=>$mes,'dia'=>$fecha_ex[2],'mes'=>$fecha_ex[1],'anio'=>$fecha_ex[0]);
	}



	if( ! function_exists('get_un_campo')){
		/**
		 * Devueleve un campo en especifico
		 * @param  [type] $id         [valor del id]
		 * @param  [type] $campotabla [nombre del campo que contiene id]
		 * @param  [type] $campo      [nombre del campo que se quiere obtener]
		 * @param  [type] $tabla      [nombre de la tabla]
		 * @return [type]             [el tipo de valor que tenga el campo solicitado]
		 */
		function get_un_campo($id,$campotabla,$campo,$tabla) {
     		$CI =& get_instance();
     		$CI->db->select($campo);
     		$CI->db->where($campotabla,$id);
     		$query = $CI->db->get($tabla);

     		if($query->num_rows() > 0) {
        		$camporetornar = $query->row();
        		return $camporetornar->$campo;
     		} else {
        		return null;
     		}
  		}
	}
	


}


function idencode($string, $key="asesores") {
   $result = '';
   for($i=0; $i<strlen($string); $i++) {
      $char = substr($string, $i, 1);
      $keychar = substr($key, ($i % strlen($key))-1, 1);
      $char = chr(ord($char)+ord($keychar));
      $result.=$char;
   }
   return base64_encode($result);
}

function iddecode($string, $key="asesores") {
   $result = '';
   $string = base64_decode($string);
   for($i=0; $i<strlen($string); $i++) {
      $char = substr($string, $i, 1);
      $keychar = substr($key, ($i % strlen($key))-1, 1);
      $char = chr(ord($char)-ord($keychar));
      $result.=$char;
   }
   return $result;
}


?>