<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Pago_abono_model extends CI_Model {

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
	
	function nuevo($datos=array())
	{
		$this->db->insert('abono_x_cooperativa',$datos);
	}

	function lista($id_cooperativa=0)
	{
		return $this->db->get_where('abono_x_cooperativa',array('id_cooperativa'=>$id_cooperativa))->result_array();
	}
}
