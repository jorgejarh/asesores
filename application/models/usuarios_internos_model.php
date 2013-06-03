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

	function insertar($post,$id=0)
	{
        unset($post['clave2']);

        if($post['clave']!="")
        {
            $post['clave']=md5($post['clave']);
        }

        if($id==0)
        {
            return $this->db->insert('usu_usuario',$post);
        }else{
            unset($post['user']);
            return $this->db->update('usu_usuario',$post,array('id_usuario'=>$id));
        }
		
	}

    function obtener_registro($id=0)
    {
        return $this->db->get_where('usu_usuario',array('id_usuario'=>$id))->row_array();
    }

    function eliminar($id,$post)
    {
        return $this->db->update('usu_usuario',$post,array('id_usuario'=>$id));
    }

}