<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Reporte_genero_model extends CI_Model {
	
	
	
    function __construct()
    {
        parent::__construct();
		
		
		
    }
	
   function obtener_planes()
   {
	   return $this->db->get_where('pl_planes',array('activo'=>1))->result_array();
}
	function obtener_modalidades($id_plan=0)
	{
		$this->db->select('a.*,b.nombre_modalidad');
		$this->db->where("a.id_modalidad =  b.id_modalidad");
		return $this->db->get_where('pl_modalidades a, mante_modalidades b',array('a.id_plan'=>$id_plan,'a.activo'=>1))->result_array();
	}
	
	function obtener_capacitaciones($id_plan_modalidad=0)
	{
		return $this->db->get_where('pl_capacitaciones',array('id_plan_modalidad'=>$id_plan_modalidad,'activo'=>1))->result_array();
	}
	
	function obtener_modulos($id_capacitacion=0)
	{
		return $this->db->get_where('pl_modulos',array('id_capacitacion'=>$id_capacitacion,'activo'=>1))->result_array();
	}
	
	function obtener_modulo($id_modulo=0)
	{
		return $this->db->get_where('pl_modulos',array('id_modulo'=>$id_modulo,'activo'=>1))->row_array();
	}
	
	function obtener_m_y_f($id_plan,$id_plan_modalidad,$id_capacitacion,$id_modulo)
	{
		$datos=$this->db->query("SELECT 
								  (SELECT 
									COUNT(a.genero) 
								  FROM
									`inscripcion_temas_personas` a,
									`inscripcion_temas` b,
									`pl_capacitaciones` c,
									`pl_modalidades` d 
								  WHERE a.genero = 'M' 
									AND a.`activo` = 1 
									AND c.`activo` = 1 
									AND b.`activo` = 1 
									AND b.`id_inscripcion_tema` = a.`id_inscripcion_tema` 
									AND b.`id_capacitacion` = c.`id_capacitacion` 
									AND c.`activo` = 1 
									AND d.`activo` = 1 
									AND d.`id_plan_modalidad` = c.`id_plan_modalidad` 
									".(($id_plan!=0)?"AND d.`id_plan` = ".$id_plan:"")." 
									".(($id_plan_modalidad!=0)?"AND d.`id_plan_modalidad` = ".$id_plan_modalidad:"")." 
									".(($id_capacitacion!=0)?"AND c.`id_capacitacion` = ".$id_capacitacion:"")." )
									 m,
								  (SELECT 
									COUNT(a.genero) 
								  FROM
									`inscripcion_temas_personas` a,
									`inscripcion_temas` b,
									`pl_capacitaciones` c,
									`pl_modalidades` d 
								  WHERE a.genero = 'F' 
									AND a.`activo` = 1 
									AND c.`activo` = 1 
									AND b.`activo` = 1 
									AND b.`id_inscripcion_tema` = a.`id_inscripcion_tema` 
									AND b.`id_capacitacion` = c.`id_capacitacion` 
									AND c.`activo` = 1 
									AND d.`activo` = 1 
									AND d.`id_plan_modalidad` = c.`id_plan_modalidad` 
									".(($id_plan!=0)?"AND d.`id_plan` = ".$id_plan:"")." 
									".(($id_plan_modalidad!=0)?"AND d.`id_plan_modalidad` = ".$id_plan_modalidad:"")." 
									".(($id_capacitacion!=0)?"AND c.`id_capacitacion` = ".$id_capacitacion:"")." )
									f ")->row_array();
		return $datos;
	}
}