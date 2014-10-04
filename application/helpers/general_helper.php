<?php


function eva_dias_f($arreglo) 
{ 
	$feriados        = array( 
	'1-1'  //  Año Nuevo (irrenunciable) 
	/*'10-4',  //  Viernes Santo (feriado religioso) 
	'11-4',  //  Sábado Santo (feriado religioso) 
	'1-5',  //  Día Nacional del Trabajo (irrenunciable) 
	'21-5',  //  Día de las Glorias Navales 
	'29-6',  //  San Pedro y San Pablo (feriado religioso) 
	'16-7',  //  Virgen del Carmen (feriado religioso) 
	'15-8',  //  Asunción de la Virgen (feriado religioso) 
	'18-9',  //  Día de la Independencia (irrenunciable) 
	'19-9',  //  Día de las Glorias del Ejército 
	'12-10',  //  Aniversario del Descubrimiento de América 
	'31-10',  //  Día Nacional de las Iglesias Evangélicas y Protestantes (feriado religioso) 
	'1-11',  //  Día de Todos los Santos (feriado religioso) 
	'8-12',  //  Inmaculada Concepción de la Virgen (feriado religioso) 
	'13-12',  //  elecciones presidencial y parlamentarias (puede que se traslade al domingo 13) 
	'25-12',  //  Natividad del Señor (feriado religioso) (irrenunciable) */
	); 
	
	$j= count($arreglo); 
	$dia_=0;
	for($i=0;$i<=$j-1;$i++) 
	{ 
	
	$dia = $arreglo[$i]; 
	
			$fecha = getdate(time($dia)); 
				$feriado = $fecha['mday']."-".$fecha['mon']; 
						if($fecha["wday"]==0 or $fecha["wday"]==6) 
						{ 
							$dia_ ++; 
						} 
							elseif(in_array($feriado,$feriados)) 
							{    
								$dia_++; 
							} 
	} 
	$rlt = $j - $dia_; 
	return $rlt; 
}


function DiasHabiles($fecha_inicial,$fecha_final) 
{ 
	$newArray[]=array();
	$array_1=explode("-",$fecha_inicial);
	$fecha_inicial=$array_1[2]."-".$array_1[1]."-".$array_1[0];
	
	list($dia,$mes,$year) = explode("-",$fecha_inicial); 
	$ini = mktime(0, 0, 0, $mes , $dia, $year); 
	
	$array_2=explode("-",$fecha_final);
	$fecha_final=$array_2[2]."-".$array_2[1]."-".$array_2[0];
	
	list($diaf,$mesf,$yearf) = explode("-",$fecha_final); 
	$fin = mktime(0, 0, 0, $mesf , $diaf, $yearf); 
	
	$r = 1; 
	while($ini != $fin) 
	{ 
	$ini = mktime(0, 0, 0, $mes , $dia+$r, $year); 
	$newArray[] .=$ini;  
	$r++; 
	} 
	return $newArray; 
}

if ( ! function_exists('contar_dias'))
{
	function contar_dias($fecha1,$fecha2)
	{
		$array_f=explode("-",$fecha1);
		//defino fecha 1 
		$ano1 = $array_f[0]; 
		$mes1 = $array_f[1];
		$dia1 =	$array_f[2];
		
		$array_f1=explode("-",$fecha2);
		//defino fecha 2 
		$ano2 = $array_f1[0]; 
		$mes2 = $array_f1[1]; 
		$dia2 = $array_f1[2]; 
		
		//calculo timestam de las dos fechas 
		$timestamp1 = mktime(0,0,0,$mes1,$dia1,$ano1); 
		$timestamp2 = mktime(4,12,0,$mes2,$dia2,$ano2); 
		
		//resto a una fecha la otra 
		$segundos_diferencia = $timestamp1 - $timestamp2; 
		//echo $segundos_diferencia; 
		
		//convierto segundos en días 
		$dias_diferencia = $segundos_diferencia / (60 * 60 * 24); 
		
		//obtengo el valor absoulto de los días (quito el posible signo negativo) 
		$dias_diferencia = abs($dias_diferencia); 
		
		//quito los decimales a los días de diferencia 
		$dias_diferencia = floor($dias_diferencia); 
		
		return $dias_diferencia; 
	}
}



if ( ! function_exists('validar_fecha'))
{
	function validar_fecha($fecha)
	{
		if($fecha=="0000-00-00")
		{
			return "";
			}else{
				return $fecha;
				}
	}
}


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

function config_lenguaje_tabla($pag=10)
{
	return '"sPaginationType": "full_numbers",
			"iDisplayLength": '.$pag.',
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

function obtener_precio_capacitacion($id_capacitacion=0)
{
	$CI =& get_instance();
	
	$dato=$CI->db->query("SELECT 
				IFNULL(SUM(c.precio_venta) ,0.00) as precio
						FROM 
							pl_modulos c
						WHERE 
							c.id_capacitacion = ".$id_capacitacion." and 
							c.activo = 1")->row_array();
	return $dato['precio'];
	
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


function obtener_total_por_modulo($id_capacitacion=0, $id_modulo=0,$id_cooperativa=0)
{
	$CI =& get_instance();
	$CI->db->where('a.activo',1);
	$CI->db->where('id_cooperativa',$id_cooperativa);
	$CI->db->where('a.id_capacitacion',$id_capacitacion);
	$inscripciones=$CI->db->get("inscripcion_temas a")->result_array();
	$total=0;
	foreach($inscripciones as $incripcion)
	{
		$personas_asistidas=$CI->db->select('count(*) as asistencia')->where('a.id_inscripcion_personas = b.id_inscripcion_personas')->get_where('inscripcion_temas_personas a, inscripcion_asistencia b',array('b.id_modulo'=>$id_modulo,'a.id_inscripcion_tema'=>$incripcion['id_inscripcion_tema']))->row_array();
		
		$total=$total+($personas_asistidas['asistencia']*obtener_precio_modulo($id_modulo));
		
		
	}
	
	return $total;
	
}

function obtener_total_por_capacitacion($id_capacitacion=0,$id_cooperativa=0)
{
	$CI =& get_instance();
	$CI->db->where('a.activo',1);
	$CI->db->where('id_cooperativa',$id_cooperativa);
	$CI->db->where('a.id_capacitacion',$id_capacitacion);
	$inscripciones=$CI->db->get("inscripcion_temas a")->result_array();
	$total=0;
	foreach($inscripciones as $incripcion)
	{
		$personas_asistidas=$CI->db->select('b.*')->where('a.id_inscripcion_personas = b.id_inscripcion_personas')->get_where('inscripcion_temas_personas a, inscripcion_asistencia b',array('a.id_inscripcion_tema'=>$incripcion['id_inscripcion_tema']))->result_array();
		
		foreach($personas_asistidas as $valor_a)
		{
			$total=$total+(1*obtener_precio_modulo($valor_a['id_modulo']));
		}
		
		
		
		
	}
	
	return $total;
	
}

function obtener_total_por_modalidad($id_plan_modalidad=0,$id_cooperativa=0)
{
	$CI =& get_instance();
	$total=0;
	
	
	$capacitaciones=$CI->db->get_where('pl_capacitaciones',array('activo'=>1,'id_plan_modalidad'=>$id_plan_modalidad))->result_array();
	
	foreach($capacitaciones as $capacitacion)
	{
		$inscripciones=$CI->db->get_where("inscripcion_temas a",array('a.activo'=>1,'a.id_cooperativa'=>$id_cooperativa, 'a.id_capacitacion'=>$capacitacion['id_capacitacion']))->result_array();
	
		foreach($inscripciones as $incripcion)
		{
			$personas_asistidas=$CI->db->select('b.*')->where('a.id_inscripcion_personas = b.id_inscripcion_personas')->get_where('inscripcion_temas_personas a, inscripcion_asistencia b',array('a.id_inscripcion_tema'=>$incripcion['id_inscripcion_tema']))->result_array();
			
			foreach($personas_asistidas as $valor_a)
			{
				$total=$total+(1*obtener_precio_modulo($valor_a['id_modulo']));
			}	
			
		}
	}
	
	
	
	return $total;
	
}


function obtener_total_por_plan($id_plan=0,$id_cooperativa=0)
{
	$CI =& get_instance();
	$total=0;
	
	
	$modalidades=$CI->db->get_where('pl_modalidades',array('activo'=>1,'id_plan'=>$id_plan))->result_array();
	
	foreach($modalidades as $modalidad)
	{
		$capacitaciones=$CI->db->get_where('pl_capacitaciones',array('activo'=>1,'id_plan_modalidad'=>$modalidad['id_plan_modalidad']))->result_array();
	
		foreach($capacitaciones as $capacitacion)
		{
			$inscripciones=$CI->db->get_where("inscripcion_temas a",array('a.activo'=>1,'a.id_cooperativa'=>$id_cooperativa, 'a.id_capacitacion'=>$capacitacion['id_capacitacion']))->result_array();
		
			foreach($inscripciones as $incripcion)
			{
				$personas_asistidas=$CI->db->select('b.*')->where('a.id_inscripcion_personas = b.id_inscripcion_personas')->get_where('inscripcion_temas_personas a, inscripcion_asistencia b',array('a.id_inscripcion_tema'=>$incripcion['id_inscripcion_tema']))->result_array();
				
				foreach($personas_asistidas as $valor_a)
				{
					$total=$total+(1*obtener_precio_modulo($valor_a['id_modulo']));
				}	
				
			}
		}
		
	}
	
	return $total;
	
}


function obtener_total_por_cooperativa($id_cooperativa=0)
{
	$CI =& get_instance();
	$total=0;
	
	$planes=$CI->db->get_where('pl_planes',array('activo'=>1))->result_array();
	
	foreach($planes as $plan)
	{
		
		$modalidades=$CI->db->get_where('pl_modalidades',array('activo'=>1,'id_plan'=>$plan['id_plan']))->result_array();
	
		foreach($modalidades as $modalidad)
		{
			$capacitaciones=$CI->db->get_where('pl_capacitaciones',array('activo'=>1,'id_plan_modalidad'=>$modalidad['id_plan_modalidad']))->result_array();
		
			foreach($capacitaciones as $capacitacion)
			{
				$inscripciones=$CI->db->get_where("inscripcion_temas a",array('a.activo'=>1,'a.id_cooperativa'=>$id_cooperativa, 'a.id_capacitacion'=>$capacitacion['id_capacitacion']))->result_array();
			
				foreach($inscripciones as $incripcion)
				{
					$personas_asistidas=$CI->db->select('b.*')->where('a.id_inscripcion_personas = b.id_inscripcion_personas')->get_where('inscripcion_temas_personas a, inscripcion_asistencia b',array('a.id_inscripcion_tema'=>$incripcion['id_inscripcion_tema']))->result_array();
					
					foreach($personas_asistidas as $valor_a)
					{
						$total=$total+(1*obtener_precio_modulo($valor_a['id_modulo']));
					}	
					
				}
			}
			
		}
		
	}
	
	
	
	return $total;
	
}



function obtener_monto_pagado_por_cooperativa( $id_cooperativa = 0 )
{
	$CI =& get_instance();
	$total=0;

	$abonos=$CI->db->get_where('abonos_cooperativas', array( 'id_cooperativa'=>$id_cooperativa,'activo'=>1 ) )->result_array(); 
	if( $abonos )
	{
		foreach ($abonos as $abono) {
			$total = $total + $abono['abono'];
		}
	}
	return $total;
}

function formato_dinero($cantidad)
{
	return number_format($cantidad,2);
}


function ver_dias($fecha_i,$fecha_f)
{
	$dias	= (strtotime($fecha_i)-strtotime($fecha_f))/86400;
	$dias 	= abs($dias); $dias = floor($dias);		
	return $dias+1;
}


/*! 
  @function num2letras () 
  @abstract Dado un n?mero lo devuelve escrito. 
  @param $num number - N?mero a convertir. 
  @param $fem bool - Forma femenina (true) o no (false). 
  @param $dec bool - Con decimales (true) o no (false). 
  @result string - Devuelve el n?mero escrito en letra. 

*/ 
function num2letras($num, $fem = false, $dec = true) { 
   $matuni[2]  = "dos"; 
   $matuni[3]  = "tres"; 
   $matuni[4]  = "cuatro"; 
   $matuni[5]  = "cinco"; 
   $matuni[6]  = "seis"; 
   $matuni[7]  = "siete"; 
   $matuni[8]  = "ocho"; 
   $matuni[9]  = "nueve"; 
   $matuni[10] = "diez"; 
   $matuni[11] = "once"; 
   $matuni[12] = "doce"; 
   $matuni[13] = "trece"; 
   $matuni[14] = "catorce"; 
   $matuni[15] = "quince"; 
   $matuni[16] = "dieciseis"; 
   $matuni[17] = "diecisiete"; 
   $matuni[18] = "dieciocho"; 
   $matuni[19] = "diecinueve"; 
   $matuni[20] = "veinte"; 
   $matunisub[2] = "dos"; 
   $matunisub[3] = "tres"; 
   $matunisub[4] = "cuatro"; 
   $matunisub[5] = "quin"; 
   $matunisub[6] = "seis"; 
   $matunisub[7] = "sete"; 
   $matunisub[8] = "ocho"; 
   $matunisub[9] = "nove"; 

   $matdec[2] = "veint"; 
   $matdec[3] = "treinta"; 
   $matdec[4] = "cuarenta"; 
   $matdec[5] = "cincuenta"; 
   $matdec[6] = "sesenta"; 
   $matdec[7] = "setenta"; 
   $matdec[8] = "ochenta"; 
   $matdec[9] = "noventa"; 
   $matsub[3]  = 'mill'; 
   $matsub[5]  = 'bill'; 
   $matsub[7]  = 'mill'; 
   $matsub[9]  = 'trill'; 
   $matsub[11] = 'mill'; 
   $matsub[13] = 'bill'; 
   $matsub[15] = 'mill'; 
   $matmil[4]  = 'millones'; 
   $matmil[6]  = 'billones'; 
   $matmil[7]  = 'de billones'; 
   $matmil[8]  = 'millones de billones'; 
   $matmil[10] = 'trillones'; 
   $matmil[11] = 'de trillones'; 
   $matmil[12] = 'millones de trillones'; 
   $matmil[13] = 'de trillones'; 
   $matmil[14] = 'billones de trillones'; 
   $matmil[15] = 'de billones de trillones'; 
   $matmil[16] = 'millones de billones de trillones'; 
   
   //Zi hack
   $float=explode('.',$num);
   $num=$float[0];

   $num = trim((string)@$num); 
   if ($num[0] == '-') { 
      $neg = 'menos '; 
      $num = substr($num, 1); 
   }else 
      $neg = ''; 
   while ($num[0] == '0') $num = substr($num, 1); 
   if ($num[0] < '1' or $num[0] > 9) $num = '0' . $num; 
   $zeros = true; 
   $punt = false; 
   $ent = ''; 
   $fra = ''; 
   for ($c = 0; $c < strlen($num); $c++) { 
      $n = $num[$c]; 
      if (! (strpos(".,'''", $n) === false)) { 
         if ($punt) break; 
         else{ 
            $punt = true; 
            continue; 
         } 

      }elseif (! (strpos('0123456789', $n) === false)) { 
         if ($punt) { 
            if ($n != '0') $zeros = false; 
            $fra .= $n; 
         }else 

            $ent .= $n; 
      }else 

         break; 

   } 
   $ent = '     ' . $ent; 
   if ($dec and $fra and ! $zeros) { 
      $fin = ' coma'; 
      for ($n = 0; $n < strlen($fra); $n++) { 
         if (($s = $fra[$n]) == '0') 
            $fin .= ' cero'; 
         elseif ($s == '1') 
            $fin .= $fem ? ' una' : ' un'; 
         else 
            $fin .= ' ' . $matuni[$s]; 
      } 
   }else 
      $fin = ''; 
   if ((int)$ent === 0) return 'Cero ' . $fin; 
   $tex = ''; 
   $sub = 0; 
   $mils = 0; 
   $neutro = false; 
   while ( ($num = substr($ent, -3)) != '   ') { 
      $ent = substr($ent, 0, -3); 
      if (++$sub < 3 and $fem) { 
         $matuni[1] = 'una'; 
         $subcent = 'as'; 
      }else{ 
         $matuni[1] = $neutro ? 'un' : 'uno'; 
         $subcent = 'os'; 
      } 
      $t = ''; 
      $n2 = substr($num, 1); 
      if ($n2 == '00') { 
      }elseif ($n2 < 21) 
         $t = ' ' . $matuni[(int)$n2]; 
      elseif ($n2 < 30) { 
         $n3 = $num[2]; 
         if ($n3 != 0) $t = 'i' . $matuni[$n3]; 
         $n2 = $num[1]; 
         $t = ' ' . $matdec[$n2] . $t; 
      }else{ 
         $n3 = $num[2]; 
         if ($n3 != 0) $t = ' y ' . $matuni[$n3]; 
         $n2 = $num[1]; 
         $t = ' ' . $matdec[$n2] . $t; 
      } 
      $n = $num[0]; 
      if ($n == 1) { 
         $t = ' ciento' . $t; 
      }elseif ($n == 5){ 
         $t = ' ' . $matunisub[$n] . 'ient' . $subcent . $t; 
      }elseif ($n != 0){ 
         $t = ' ' . $matunisub[$n] . 'cient' . $subcent . $t; 
      } 
      if ($sub == 1) { 
      }elseif (! isset($matsub[$sub])) { 
         if ($num == 1) { 
            $t = ' mil'; 
         }elseif ($num > 1){ 
            $t .= ' mil'; 
         } 
      }elseif ($num == 1) { 
         $t .= ' ' . $matsub[$sub] . '?n'; 
      }elseif ($num > 1){ 
         $t .= ' ' . $matsub[$sub] . 'ones'; 
      }   
      if ($num == '000') $mils ++; 
      elseif ($mils != 0) { 
         if (isset($matmil[$sub])) $t .= ' ' . $matmil[$sub]; 
         $mils = 0; 
      } 
      $neutro = true; 
      $tex = $t . $tex; 
   } 
   $tex = $neg . substr($tex, 1) . $fin; 
   //Zi hack --> return ucfirst($tex);
   
   $end_num=ucfirst($tex).' pesos '.$float[1].'/100 M.N.';
   return $end_num; 
} 


class EnLetras
{
  var $Void = "";
  var $SP = " ";
  var $Dot = ".";
  var $Zero = "0";
  var $Neg = "Menos";
  
function ValorEnLetras($x, $Moneda ) 
{
    $s="";
    $Ent="";
    $Frc="";
    $Signo="";
        
    if(floatVal($x) < 0)
     $Signo = $this->Neg . " ";
    else
     $Signo = "";
    
    if(intval(number_format($x,2,'.','') )!=$x) //<- averiguar si tiene decimales
      $s = number_format($x,2,'.','');
    else
      $s = number_format($x,0,'.','');
       
    $Pto = strpos($s, $this->Dot);
        
    if ($Pto === false)
    {
      $Ent = $s;
      $Frc = $this->Void;
    }
    else
    {
      $Ent = substr($s, 0, $Pto );
      $Frc =  substr($s, $Pto+1);
    }

    if($Ent == $this->Zero || $Ent == $this->Void)
       $s = "Cero ";
    elseif( strlen($Ent) > 7)
    {
       $s = $this->SubValLetra(intval( substr($Ent, 0,  strlen($Ent) - 6))) . 
             "Millones " . $this->SubValLetra(intval(substr($Ent,-6, 6)));
    }
    else
    {
      $s = $this->SubValLetra(intval($Ent));
    }

    if (substr($s,-9, 9) == "Millones " || substr($s,-7, 7) == "Millón ")
       $s = $s . "de ";

    $s = $s . $Moneda;

    if($Frc != $this->Void)
    {
       $s = $s . " Con " . $this->SubValLetra(intval($Frc)) . "Centavos";
       //$s = $s . " " . $Frc . "/100";
    }
    return ($Signo . $s . " ");
   
}


function SubValLetra($numero) 
{
    $Ptr="";
    $n=0;
    $i=0;
    $x ="";
    $Rtn ="";
    $Tem ="";

    $x = trim("$numero");
    $n = strlen($x);

    $Tem = $this->Void;
    $i = $n;
    
    while( $i > 0)
    {
       $Tem = $this->Parte(intval(substr($x, $n - $i, 1). 
                           str_repeat($this->Zero, $i - 1 )));
       If( $Tem != "Cero" )
          $Rtn .= $Tem . $this->SP;
       $i = $i - 1;
    }

    
    //--------------------- GoSub FiltroMil ------------------------------
    $Rtn=str_replace(" Mil Mil", " Un Mil", $Rtn );
    while(1)
    {
       $Ptr = strpos($Rtn, "Mil ");       
       If(!($Ptr===false))
       {
          If(! (strpos($Rtn, "Mil ",$Ptr + 1) === false ))
            $this->ReplaceStringFrom($Rtn, "Mil ", "", $Ptr);
          Else
           break;
       }
       else break;
    }

    //--------------------- GoSub FiltroCiento ------------------------------
    $Ptr = -1;
    do{
       $Ptr = strpos($Rtn, "Cien ", $Ptr+1);
       if(!($Ptr===false))
       {
          $Tem = substr($Rtn, $Ptr + 5 ,1);
          if( $Tem == "M" || $Tem == $this->Void)
             ;
          else          
             $this->ReplaceStringFrom($Rtn, "Cien", "Ciento", $Ptr);
       }
    }while(!($Ptr === false));

    //--------------------- FiltroEspeciales ------------------------------
    $Rtn=str_replace("Diez Un", "Once", $Rtn );
    $Rtn=str_replace("Diez Dos", "Doce", $Rtn );
    $Rtn=str_replace("Diez Tres", "Trece", $Rtn );
    $Rtn=str_replace("Diez Cuatro", "Catorce", $Rtn );
    $Rtn=str_replace("Diez Cinco", "Quince", $Rtn );
    $Rtn=str_replace("Diez Seis", "Dieciseis", $Rtn );
    $Rtn=str_replace("Diez Siete", "Diecisiete", $Rtn );
    $Rtn=str_replace("Diez Ocho", "Dieciocho", $Rtn );
    $Rtn=str_replace("Diez Nueve", "Diecinueve", $Rtn );
    $Rtn=str_replace("Veinte Un", "Veintiun", $Rtn );
    $Rtn=str_replace("Veinte Dos", "Veintidos", $Rtn );
    $Rtn=str_replace("Veinte Tres", "Veintitres", $Rtn );
    $Rtn=str_replace("Veinte Cuatro", "Veinticuatro", $Rtn );
    $Rtn=str_replace("Veinte Cinco", "Veinticinco", $Rtn );
    $Rtn=str_replace("Veinte Seis", "Veintiseís", $Rtn );
    $Rtn=str_replace("Veinte Siete", "Veintisiete", $Rtn );
    $Rtn=str_replace("Veinte Ocho", "Veintiocho", $Rtn );
    $Rtn=str_replace("Veinte Nueve", "Veintinueve", $Rtn );

    //--------------------- FiltroUn ------------------------------
    If(substr($Rtn,0,1) == "M") $Rtn = "Un " . $Rtn;
    //--------------------- Adicionar Y ------------------------------
    for($i=65; $i<=88; $i++)
    {
      If($i != 77)
         $Rtn=str_replace("a " . Chr($i), "* y " . Chr($i), $Rtn);
    }
    $Rtn=str_replace("*", "a" , $Rtn);
    return($Rtn);
}


function ReplaceStringFrom(&$x, $OldWrd, $NewWrd, $Ptr)
{
  $x = substr($x, 0, $Ptr)  . $NewWrd . substr($x, strlen($OldWrd) + $Ptr);
}


function Parte($x)
{
    $Rtn='';
    $t='';
    $i='';
    Do
    {
      switch($x)
      {
         case 0:  $t = "Cero";break;
         case 1:  $t = "Un";break;
         case 2:  $t = "Dos";break;
         case 3:  $t = "Tres";break;
         case 4:  $t = "Cuatro";break;
         case 5:  $t = "Cinco";break;
         case 6:  $t = "Seis";break;
         case 7:  $t = "Siete";break;
         case 8:  $t = "Ocho";break;
         case 9:  $t = "Nueve";break;
         case 10: $t = "Diez";break;
         case 20: $t = "Veinte";break;
         case 30: $t = "Treinta";break;
         case 40: $t = "Cuarenta";break;
         case 50: $t = "Cincuenta";break;
         case 60: $t = "Sesenta";break;
         case 70: $t = "Setenta";break;
         case 80: $t = "Ochenta";break;
         case 90: $t = "Noventa";break;
         case 100: $t = "Cien";break;
         case 200: $t = "Doscientos";break;
         case 300: $t = "Trescientos";break;
         case 400: $t = "Cuatrocientos";break;
         case 500: $t = "Quinientos";break;
         case 600: $t = "Seiscientos";break;
         case 700: $t = "Setecientos";break;
         case 800: $t = "Ochocientos";break;
         case 900: $t = "Novecientos";break;
         case 1000: $t = "Mil";break;
         case 1000000: $t = "Millón";break;
      }

      If($t == $this->Void)
      {
        $i = $i + 1;
        $x = $x / 1000;
        If($x== 0) $i = 0;
      }
      else
         break;
           
    }while($i != 0);
   
    $Rtn = $t;
    switch($i)
    {
       case 0: $t = $this->Void;break;
       case 1: $t = " Mil";break;
       case 2: $t = " Millones";break;
       case 3: $t = " Billones";break;
    }
    return($Rtn . $t);
}

}

function traducir_tipo_tiempo($tiempo="")
{
	$respuesta="";
	switch($tiempo)
	{
		case "days":
			$respuesta="Dia(s)";
			break;
		case "months":
			$respuesta="Mes(es)";
			break;
		case "years":
			$respuesta="Año(s)";
			break;
	}
	return $respuesta;
}


?>