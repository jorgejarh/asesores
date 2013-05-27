<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Perfiles_model extends CI_Model {

	public function insertar_perfil($post=''){
		return $this->db->insert('cu_perfil',$post);
	}

	public function editar_perfil($post='',$id=0){
		return $this->db->update('cu_perfil',$post,array('id_perfil'=>$id));
	}

	public function eliminar($id=0){
		return $this->db->delete('cu_perfil', array('id_perfil'=>$id));
	}

	public function insertar_contenido($post=''){
		return $this->db->insert($post['tabla'],array('nombre'=>$post['nombre'],'id_perfil'=>$post['id_perfil']));
	}

	public function editar_y_actualizar_contenido($post=''){
		return $this->db->update($post['tabla'],array('nombre'=>$post['nombre']),array('id'=>$post['id']));
	}

	public function eliminar_contenido($post=''){
		return $this->db->delete($post['tabla'],array('id'=>$post['id']));
	}
	

}

/* End of file perfiles_model.php */
/* Location: ./application/models/perfiles_model.php */