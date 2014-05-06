<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Notas_cargo_model extends CI_Model {

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
	
	
	
}
