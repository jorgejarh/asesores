<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Estado_cuenta_model extends CI_Model {

    function __construct()
    {
        parent::__construct();
    }
	
	function obtener_cooperativas()
	{
		return $this->db->get_where("conf_cooperativa",array('activo'=>1))->result_array();
	}
	
	function obtener_una_cooperativa($id_cooperativa=0)
	{
		return $this->db->get_where("conf_cooperativa",array('activo'=>1,'id_cooperativa'=>$id_cooperativa))->row_array();
	}
	
	function obtener_inscripciones_x_cooperativa($id_cooperativa=0)
	{
		$this->db->select("a.*, b.nombre_capacitacion, (SELECT SUM(c.precio_venta) FROM  pl_modulos c WHERE c.id_capacitacion = b.id_capacitacion) AS precio_capacitacion ,
  														(SELECT COUNT(d.id_inscripcion_personas) FROM inscripcion_temas_personas d WHERE d.id_inscripcion_tema = a.id_inscripcion_tema) AS cantidad_inscritos,
														(SELECT SUM(e.cantidad_por) FROM notas_cargo e WHERE e.id_cooperativa = a.id_cooperativa) AS cantidad_pagada
  
  ",false);
		$this->db->where("a.id_capacitacion = b.id_capacitacion");
		return $this->db->get_where('inscripcion_temas a, pl_capacitaciones b',array('a.activo'=>1,'a.id_cooperativa'=>$id_cooperativa))->result_array();
	}
	
}
