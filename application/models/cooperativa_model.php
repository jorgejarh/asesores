<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Cooperativa_model extends CI_Model {

    function __construct()
    {
        parent::__construct();
    }

    function obtener_cooperativa($id=0)
    {
		if($id!=0)
		{
        	return $this->db->get_where('conf_cooperativa',array('id_cooperativa'=>$id))->row_array();
		}else{
			return $this->db->get_where('conf_cooperativa',array('activo'=>1))->result_array();
			}
    }
	
    function obtener_sucursales($id=0)
    {
		if($id!=0)
		{
        	return $this->db->select('a.*,b.cooperativa')->get_where('conf_sucursal a, conf_cooperativa b','a.id_sucursal = '.$id.' and a.id_cooperativa = b.id_cooperativa')->row_array();
		}else{
        	return $this->db->select('a.*,b.cooperativa')->get_where('conf_sucursal a, conf_cooperativa b','a.id_cooperativa = b.id_cooperativa and a.activo = 1')->result_array();
			}
			
    }

    /*FUNCIONES DE ARCHIVOS*/
    public function subeArc($dirTemp='', $dirAct='', $arc=''){
        $subido = $dirAct."/".$arc;
        return move_uploaded_file($dirTemp, $subido);
    }
    public function eliminarArc($arc=''){
        return unlink($arc);
    }

    public function existeArc($arc=''){
        return file_exists($arc);
    }


    /*SENTENCIAS UPDATE INSERT Y DELETE*/
    public function insertArc($id_cooperativa=0, $arc=''){
        $this->db->where('id_cooperativa', $id_cooperativa);
        return $this->db->update('conf_cooperativa', array('logotipo' => "logos/".$arc));
    }

    public function insertar_cooperativa($post=array()){
		$datos['id_usuario']=$this->datos_user['id_usuario'];
		$datos['f_creacion']=date('Y-m-d H:i:s');
        return $this->db->insert('conf_cooperativa',$post);
    }

    public function editar_cooperativa($post=array(), $id=0){
        return $this->db->update('conf_cooperativa',$post,array('id_cooperativa'=>$id));
    }

    public function eliminar($id=0){
        return $resultado=$this->db->update('conf_cooperativa', array('activo'=>0),array('id_cooperativa'=>$id));
        //return $this->db->delete('conf_cooperativa', array('id_cooperativa'=>$id));        
    }
}
