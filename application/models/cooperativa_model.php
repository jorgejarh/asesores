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
			return $this->db->get('conf_cooperativa')->result_array();
			}
    }
	
    function obtener_sucursales($id=0)
    {
		if($id!=0)
		{
        	return $this->db->select('a.*,b.cooperativa')->get_where('conf_sucursal a, conf_cooperativa b','a.id_sucursal = '.$id.' and a.id_cooperativa = b.id_cooperativa')->row_array();
		}else{
        	return $this->db->select('a.*,b.cooperativa')->get_where('conf_sucursal a, conf_cooperativa b','a.id_cooperativa = b.id_cooperativa')->result_array();
			}
			
    }

    public function subeArc($dirTemp, $dirAct, $arc){
        $subido = $dirAct."/".$arc;
        move_uploaded_file($dirTemp, $subido);
        return $subido;
    }

    public function insertArc($id_cooperativa=0, $arc=''){
        $this->db->where('id_cooperativa', $id_cooperativa);
        return $this->db->update('conf_cooperativa', array('logotipo' => "logos/".$arc));
    }
}
