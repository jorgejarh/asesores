<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Pl_rubro_model extends CI_Model {
	
	public $nombre_tabla="pl_rubro";
	
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
	
    function obtener($id=0)
	{
		
		if($id==0)
		{
			
			return $this->db->get_where($this->nombre_tabla,array('a.activo'=>1))->result_array();
		}else{
			$this->db->select("a.*, b.nombre_modulo");
			$this->db->where("a.id_modulo = b.id_modulo");
			return $this->db->get_where($this->nombre_tabla." a, pl_modulos b",array($this->id_tabla=>$id))->row_array();
			}
	}
	
	function lista($id=0)
	{
		$this->db->select("a.* ");
		$datos=$this->db->get_where($this->nombre_tabla." a",array('a.activo'=>1,'a.id_modulo'=>$id))->result_array();
		if($datos)
		{
			foreach($datos as $key=>$valor)
			{
				$sub=$this->obtener_subrubros($valor['id_rubro']);
				$datos[$key]['sub']=$sub;
			}
		}
		
		return $datos;
	}
	
	function obtener_subrubros($id_rubro=0)
	{
		return $this->db->get_where("pl_subrubro a",array('a.id_rubro'=>$id_rubro))->result_array();
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
	
	function obtener_curriculas()
	{
		return $this->db->get_where('cu_curricula',array('estado'=>1))->result_array();
	}
	
	function obtener_perfiles($id)
	{
		return $this->db->get_where('cu_perfil',array('id_curricula'=>$id))->result_array();
	}
	
	function obtener_contenidos($id)
	{
		return $this->db->get_where('cu_perfil_contenido_aspectos',array('id_perfil'=>$id))->result_array();
	}
	
	
	
}