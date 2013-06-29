<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Sitio_model extends CI_Model {

    function __construct()
    {
        parent::__construct();
    }

	function obtener_imagenes_slider()
	{
		return $this->db->get('sitio_slider')->result_array();
	}
	
	function obtener_capacitaciones()
	{
		
		$this->db->order_by("rand()");
		$this->db->limit(6);
		return $this->db->get_where('pl_capacitaciones',array('activo'=>1))->result_array();
	}
		
}
