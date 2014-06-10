<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Notas_cargo_model extends CI_Model {

    function __construct()
    {
        parent::__construct();
    }
	
	function obtener_cooperativas($datos=array())
	{
		$this->db->select("(select count(c.id_inscripcion_personas) from inscripcion_temas_personas c where c.id_inscripcion_tema = b.id_inscripcion_tema ) as cantidad, a.*",false);
		$this->db->where("a.id_cooperativa = b.id_cooperativa");
		$this->db->from("inscripcion_temas b");
		$this->db->group_by("a.id_cooperativa");
		if(!$datos)
		{
			return $this->db->get_where("conf_cooperativa a",array('a.activo'=>1))->result_array();
		}else{
			return $this->db->get_where("conf_cooperativa a",array('a.id_cooperativa'=>$datos['id_cooperativa']))->result_array();
			}
	}
	
	function obtener_info_modulo($id_modulo=0,$id_inscripcion_tema=0,$asistencia=0)
	{
		if($asistencia!=0)
		{
			$this->db->where("b.aprobado = 1");
		}
		$this->db->select("a.*,b.*")->where("a.id_inscripcion_personas = b.id_inscripcion_personas");
		return $this->db->get_where('inscripcion_temas_personas a, inscripcion_asistencia b',array('b.id_modulo'=>$id_modulo,'a.id_inscripcion_tema'=>$id_inscripcion_tema))->result_array();
	}
	
}
