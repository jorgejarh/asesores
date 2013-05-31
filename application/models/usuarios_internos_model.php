<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Usuarios_internos_model extends CI_Model {

    function __construct()
    {
        parent::__construct();
    }

    function obtener_lista()
    {
    	$this->db->select("a.*, b.subrol as nombre_subrol");
    	$this->db->where('a.activo',1);
    	
    	$this->db->where("a.id_subrol = b.id_subrol and b.id_rol = c.id_rol and c.id_tipo_usuario = 1");

    	return $this->db->get('usu_usuario a, usu_subrol b, usu_rol c')->result_array();

    }

	function obtener_subroles()
	{
		$this->db->where("c.id_rol = a.id_rol and b.id_tipo_usuario = c.id_tipo_usuario and b.id_tipo_usuario = 1");
		return $this->db->get_where('usu_subrol a, usu_tipo_usuario b, usu_rol c',array('a.estado'=>1))->result_array();
	}

	function insertar($post)
	{
		unset($post['clave2']);
		$post['clave']=md5($post['clave']);
		return $this->db->insert('usu_usuario',$post);
	}

}
?>

