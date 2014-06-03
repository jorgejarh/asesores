<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Estado_cuenta_model extends CI_Model {

    function __construct()
    {
        parent::__construct();
    }
	
	function obtener_cooperativas($datos=array())
	{
		if(!$datos)
		{
			return $this->db->get_where("conf_cooperativa",array('activo'=>1))->result_array();
		}else{
			return $this->db->get_where("conf_cooperativa",array('id_cooperativa'=>$datos['id_cooperativa']))->result_array();
			}
	}
	
	function obtener_una_cooperativa($id_cooperativa=0)
	{
		return $this->db->get_where("conf_cooperativa",array('activo'=>1,'id_cooperativa'=>$id_cooperativa))->row_array();
	}
	
	function obtener_inscripciones_x_cooperativa($id_cooperativa=0)
	{
		$this->db->select("a.*, b.nombre_capacitacion, 
			(SELECT SUM(e.descuento) FROM inscripcion_temas_descuentos e WHERE e.activo=1 AND e.id_inscripcion_tema=a.id_inscripcion_tema) AS descuento,
		(SELECT SUM(c.precio_venta) FROM  pl_modulos c WHERE c.id_capacitacion = b.id_capacitacion) AS precio_capacitacion ,
  														(SELECT COUNT(d.id_inscripcion_personas) FROM inscripcion_temas_personas d WHERE d.id_inscripcion_tema = a.id_inscripcion_tema) AS cantidad_inscritos,
														(SELECT SUM(e.cantidad_por) FROM notas_cargo e WHERE e.id_cooperativa = a.id_cooperativa) AS cantidad_pagada
  
  ",false);
		$this->db->where("a.id_capacitacion = b.id_capacitacion");
		return $this->db->get_where('inscripcion_temas a, pl_capacitaciones b',array('a.activo'=>1,'a.id_cooperativa'=>$id_cooperativa))->result_array();
	}
	
	function obtener_estado_x_cooperativa($id_cooperativa=0)
	{
		
		$datos=$this->db->query("SELECT 
								  e.fecha_creacion,
								  c.id_modulo,
								  c.nombre_modulo,
								  SUM(c.precio_venta) AS saldo,
								  COUNT(*) AS num_personas 
								FROM
								  inscripcion_temas a,
								  pl_capacitaciones b,
								  pl_modulos c,
								  inscripcion_temas_personas d,
								  inscripcion_asistencia e 
								WHERE a.id_cooperativa = ".$id_cooperativa." 
								  AND a.id_capacitacion = b.id_capacitacion 
								  AND c.id_capacitacion = b.id_capacitacion 
								  AND a.id_inscripcion_tema = d.id_inscripcion_tema 
								  AND c.id_modulo = e.id_modulo 
								  AND e.id_inscripcion_personas = d.id_inscripcion_personas 
								  AND e.aprobado = 1 
								  AND e.asistio = 1 
								GROUP BY c.id_modulo 
								ORDER BY e.fecha_creacion ASC ")->result_array();
		
		foreach($datos as $key=>$val)
		{
			$datos[$key]['abonos']=$this->obtener_abonos_x_modulo($val['id_modulo'],$id_cooperativa);
		}
		
		return $datos;
	}
	
	
	function obtener_abonos_x_modulo($id_cooperativa,$id_modulo)
	{
		return $this->db->query("SELECT 
								  a.fecha_creacion,
								  b.id_modulo,
								  b.cantidad 
								FROM
								  abono_x_cooperativa a,
								  abono_x_cooperativa_detalle b 
								WHERE a.id_cooperativa = 6 
								  AND a.id_abono = b.id_nota_cargo 
								  AND b.id_modulo=10
								ORDER BY a.fecha_creacion ASC ")->result_array();
	}
	
}
