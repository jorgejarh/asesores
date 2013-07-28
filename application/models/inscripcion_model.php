<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Inscripcion_model extends CI_Model {
	
	
	
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
	
	function obtener_personas($id_capacitacion=0,$id_modulo=0)
	{
		$this->db->select('b.*, (select count(*) from inscripcion_asistencia c where b.id_inscripcion_personas = c.id_inscripcion_personas) as asistio',false);
		$this->db->where("a.id_inscripcion_tema = b.id_inscripcion_tema");
		
		return $this->db->order_by('b.apellidos')->get_where('inscripcion_temas a, inscripcion_temas_personas b',array('a.id_capacitacion'=>$id_capacitacion))->result_array();
	}
	
	function guardar_asistencia($id_inscripcion_personas=array(),$modulo)
	{
				
		$this->db->delete('inscripcion_asistencia',array('id_modulo'=>$modulo['id_modulo']));
		
		foreach($id_inscripcion_personas as $valor)
		{
			$this->db->insert('inscripcion_asistencia',array('id_modulo'=>$modulo['id_modulo'],
															'id_inscripcion_personas'=>$valor,
															'fecha_creacion'=>date('Y-m-d H:i:s'),
															'id_usuario'=>$this->datos_user['id_usuario']));
		}
		
	}
	
	
}