<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Conf_menu_model extends CI_Model {

    function __construct()
    {
        parent::__construct();
    }
	
	function obtener_menus_completo()
	{
		$menu_padre=$this->db->get_where('conf_menu',array('id_padre'=>0,'activo'=>1))->result_array();
		
		if($menu_padre)
		{
			foreach($menu_padre as $key_padre=>$val_padre)
			{
				$menu_padre[$key_padre]['submenu']=$this->db->get_where('conf_menu',array('id_padre'=>$val_padre['id_menu'],'activo'=>1))->result_array();
				if($menu_padre[$key_padre]['submenu'])
				{
					foreach($menu_padre[$key_padre]['submenu'] as $key_sub=>$val_sub_menu)
					{
						$menu_padre[$key_padre]['submenu'][$key_sub]['submenu']=$this->db->get_where('conf_menu',array('id_padre'=>$val_sub_menu['id_menu'],'activo'=>1))->result_array();
					}
				}
			}
		}
		
		return $menu_padre;
	}
	
	function obtener_info_menu($id=0)
	{
		return $this->db->get_where('conf_menu',array('id_menu'=>$id))->row_array();
	}
	
	
	function obtener_menus()
	{
		return $this->db->get_where('conf_menu',array('activo'=>1))->result_array();
	}
	
	function actualizar_menu($post,$id)
	{
		if($post['url']=="")
			{
				$post['url']="#";
			}
		return $this->db->update('conf_menu',$post,array('id_menu'=>$id));
	}
	function insertar_menu($post)
	{
		if($post['url']=="")
			{
				$post['url']="#";
			}
		
		return $this->db->insert('conf_menu',$post);
	}
	
	function eliminar($id=0)
	{
		
		return $this->db->update('conf_menu',array('activo'=>0), array('id_menu'=>$id));
	}

	function obtener_permisos($id_subrol=0)
	{
		return $this->db->get_where('usu_permisos_menu',array('id_subrol'=>$id_subrol))->result_array();
	}
	
	function existe_permiso($permisos,$id_menu)
	{
		if($permisos)
		{
			foreach($permisos as $valor)
			{
				
				if($valor['id_menu']==$id_menu)
				{

					return true;

				}
			}

		}else{
			return false;
		}
	}
	
}
