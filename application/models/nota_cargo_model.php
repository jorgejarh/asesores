<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Nota_cargo_model extends CI_Model {

    function __construct()
    {
        parent::__construct();
    }
	
	function obtener()
	{
		return $this->db->get("notas_cargo")->result_array();
	}
	
	function obtener_cooperativas()
	{
		return $this->db->get_where("conf_cooperativa",array('activo'=>1))->result_array();
	}
	
	function obtener_no_afiliadas()
	{
		return $this->db->or_where(array("tipo_persona"=>"EX"))->or_where(array("tipo_persona"=>"NA"))->get("mante_personal")->result_array();
	}
	
	function obtener_capacitaciones($datos)
	{
		if($datos['tipo_persona']=="C")
		{
			return $this->db->select("b.*")->where("b.id_capacitacion = a.id_capacitacion")->get_where("inscripcion_temas a, pl_capacitaciones b",array("a.id_cooperativa"=>$datos['id_cooperativa']))->result_array();
		}
		
	}
}
