<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Usuarios_externos_model extends CI_Model {

    function __construct()
    {
        parent::__construct();
    }

    function obtener_lista()
    {
    	$this->db->select("a.*, b.subrol as nombre_subrol");
    	$this->db->where('a.activo',1);
    	
    	$this->db->where("a.id_subrol = b.id_subrol and b.id_rol = c.id_rol and c.id_tipo_usuario = 2");

    	return $this->db->get('usu_usuario a, usu_subrol b, usu_rol c')->result_array();

    }

	function obtener_subroles()
	{
		$this->db->where("c.id_rol = a.id_rol and b.id_tipo_usuario = c.id_tipo_usuario and b.id_tipo_usuario = 2");
		return $this->db->get_where('usu_subrol a, usu_tipo_usuario b, usu_rol c',array('a.estado'=>1))->result_array();
	}

    function obtener_cooperativas()
    {
        $this->db->select('id_cooperativa, cooperativa');
        return $this->db->get_where('conf_cooperativa',array('activo'=>1))->result_array();
    }

    function obtener_sucursales($id_cooperativa=0)
    {
        return $this->db->get_where('conf_sucursal',array('id_cooperativa'=>$id_cooperativa))->result_array();
    }

	function insertar($post,$id=0)
	{
        unset($post['clave2']);

        if($post['clave']!="")
        {
            $post['clave']=md5($post['clave']);
        }

        $post2=array('id_cooperativa'=>$post['id_cooperativa'],'id_sucursal'=>$post['id_sucursal']);
        unset($post['id_cooperativa']);
        unset($post['id_sucursal']);

        if($id==0)
        {
           $this->db->insert('usu_usuario',$post);
           $id_usuario=$this->db->insert_id();

           $post2['id_usuario']=$id_usuario;

           return $this->db->insert('usu_coop_suc',$post2);

        }else{
            unset($post['user']);

            $this->db->update('usu_usuario',$post,array('id_usuario'=>$id));

            $this->db->delete('usu_coop_suc',array('id_usuario'=>$id));
            $post2['id_usuario']=$id;
            return $this->db->insert('usu_coop_suc',$post2);
        }
		
	}

    function obtener_coo_suc($id_usuario=0)
    {
        return $this->db->get_where('usu_coop_suc',array('id_usuario'=>$id_usuario))->row_array();
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