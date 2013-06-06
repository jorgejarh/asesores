<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Curricula_model extends CI_Model {

    function __construct()
    {
        parent::__construct();
    }


    function obtener_curricula($id=0)
    {
    	if($id!=0)
		{
        	return $this->db->get_where('cu_curricula',array('id_curricula'=>$id))->row_array();
		}else{
			return $this->db->get_where('cu_curricula',array('activo'=>1))->result_array();
			}
    }
	
	
	function obtener_perfiles($id=0)
    {
		if($id!=0)
		{
        	return $this->db->select('a.*,b.curricula')->get_where('cu_perfil a, cu_curricula b','a.id_perfil = '.$id.' and a.id_curricula = b.id_curricula')->row_array();
		}else{
        	return $this->db->select('a.*,b.curricula')->get_where('cu_perfil a, cu_curricula b','a.id_curricula = b.id_curricula')->result_array();
			}
			
    }

    function obtener_perfiles_por_id_curricula($id_curricula){
    	if($id_curricula!=0)
		{
			$this->db->where(array('a.activo'=>1));
        	return $this->db->select('a.*,b.curricula')->get_where('cu_perfil a, cu_curricula b','a.id_curricula = '.$id_curricula.' and a.id_curricula = b.id_curricula')->result_array();
		}
    }
	
	function obtener_tipos_contenido($id=0)
	{
		if($id==0)
		{
			return $this->db->get('cu_tablas_contenido')->result_array();
		}else{
			return $this->db->get_where('cu_tablas_contenido',array('id_tabla_contenido'=>$id))->row_array();
			}
		
	}
	
	function obtener_listado_contenido($tabla='',$id_perfil=0)
	{
		if($tabla!='')
		{
			return $this->db->get_where($tabla,array('id_perfil'=>$id_perfil))->result_array();
		}
	}
	
	function obtener_contenido($tabla='',$id=0)
	{
		if($tabla!='' && $id!=0)
		{
			return $this->db->get_where($tabla,array('id'=>$id))->row_array();
		}
	}

	//Funciones Insert Update y Delete

	public function insertar_curricula($post=array()){
		$post['id_usuario']=$this->datos_user['id_usuario'];
		$post['f_creacion']=date('Y-m-d H:i:s');
		return $this->db->insert('cu_curricula',$post);
	} 

	public function editar_curricula($post=array(), $id=0){
		return $this->db->update('cu_curricula',$post,array('id_curricula'=>$id));
	}

	public function eliminar($id=0){
		return $this->db->update('cu_curricula',array('activo'=>0),array('id_curricula'=>$id));
		// $this->db->delete('cu_curricula', array('id_curricula'=>$id));
	}
	
}
