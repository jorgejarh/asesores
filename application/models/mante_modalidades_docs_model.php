<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Mante_modalidades_docs_model extends CI_Model {
	
	public $nombre_tabla="pl_panes_docs";
	
	public $id_tabla="";
	
    function __construct()
    {
        parent::__construct();
		
		$campos = $this->db->field_data($this->nombre_tabla);
		
		foreach ($campos as $campo)
		{
			if($campo->primary_key==1)
			{
				$this->id_tabla=$campo->name;
			}
		}
		
    }
	
    function obtener($id_modalidad)
	{
		
		$this->db->select("a.*, b.nombre_completo as nombre_usuario");
		$this->db->where("a.id_usuario = b.id_usuario and a.id_plan = ".$id_modalidad);
		return $this->db->get_where($this->nombre_tabla." a, usu_usuario b",array('a.activo'=>1))->result_array();
		
	}
	
	function actualizar($datos,$id)
	{
		return $this->db->update($this->nombre_tabla,$datos,array($this->id_tabla=>$id));
	}
	
	function nuevo($datos)
	{
		$datos['id_usuario']=$this->datos_user['id_usuario'];
		$datos['f_creacion']=date('Y-m-d H:i:s');
		return $this->db->insert($this->nombre_tabla,$datos);
	}
	
	function eliminar($id)
	{
		return $this->db->update($this->nombre_tabla,array('activo'=>0),array($this->id_tabla=>$id));
		//return $this->db->delete($this->nombre_tabla,array($this->id_tabla=>$id));
	}
	
}