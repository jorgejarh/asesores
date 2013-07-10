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

function obtener_costo_plan($id_plan=0)
{
	$CI =& get_instance();
	
	$dato=$CI->db->query("SELECT 
				IFNULL(SUM(g.unidades*g.costo),0.00) as costo
			  FROM
				pl_modalidades c,
				pl_capacitaciones d,
				pl_modulos e,
				pl_rubro f,
				pl_subrubro g 
			  WHERE c.id_plan =".$id_plan."
				AND c.id_plan_modalidad = d.id_plan_modalidad 
				AND e.id_capacitacion = d.id_capacitacion 
				AND f.id_modulo = e.id_modulo 
				AND f.id_rubro = g.id_rubro
				AND c.activo = 1
				AND d.activo = 1
				AND e.activo = 1
				AND f.activo = 1
				AND g.activo = 1")->row_array();
	return $dato['costo'];
	
}

function obtener_costo_plan_modalidad($id_plan_modalidad=0)
{
	$CI =& get_instance();
	
	$dato=$CI->db->query("SELECT 
				IFNULL(SUM(g.unidades*g.costo),0.00) as costo
			  FROM
				pl_capacitaciones d,
				pl_modulos e,
				pl_rubro f,
				pl_subrubro g 
			  WHERE d.id_plan_modalidad = ".$id_plan_modalidad."
				AND e.id_capacitacion = d.id_capacitacion 
				AND f.id_modulo = e.id_modulo 
				AND f.id_rubro = g.id_rubro
				AND d.activo = 1
				AND e.activo = 1
				AND f.activo = 1
				AND g.activo = 1")->row_array();
	return $dato['costo'];
}

function obtener_costo_capacitacion($id_capacitacion=0)
{
	$CI =& get_instance();
	
	$dato=$CI->db->query("SELECT 
				IFNULL(SUM(e.unidades*e.costo) ,0.00) as costo
						FROM 
							pl_modulos c, 
							pl_rubro d, 
							pl_subrubro e  
						WHERE 
							e.id_rubro = d.id_rubro AND 
							d.id_modulo = c.id_modulo AND 
							c.id_capacitacion = ".$id_capacitacion." and 
							e.activo = 1 and 
							c.activo = 1 and  
							d.activo = 1")->row_array();
	return $dato['costo'];
	
}

function obtener_costo_modulo($id_modulo=0)
{
	$CI =& get_instance();
	
	$dato=$CI->db->query("SELECT 
				IFNULL(SUM(c.unidades*c.costo)  ,0.00) as costo
						FROM 
							pl_rubro b, 
							pl_subrubro c 
						WHERE 
							b.id_rubro = c.id_rubro AND 
							b.id_modulo = ".$id_modulo." and 
							c.activo = 1 and  
							b.activo = 1")->row_array();
	return $dato['costo'];
	
}

function obtener_precio_modulo($id_modulo=0)
{
	$CI =& get_instance();
	
	$dato=$CI->db->get_where("pl_modulos",array('id_modulo'=>$id_modulo))->row_array();
	if($dato['precio_venta'])
	{
		return $dato['precio_venta'];
	}else{
		return 0.00;
		}
	
}

?>