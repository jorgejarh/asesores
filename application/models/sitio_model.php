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
}
