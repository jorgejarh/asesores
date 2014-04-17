<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Mante_personal_model extends CI_Model {
	
	public $nombre_tabla="mante_personal";
	
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
			$info_user=$this->datos_user['info_s'];
			$this->db->select("a.*, b.nombre_cargo, c.sucursal as nombre_sucursal");
			$this->db->where("a.id_cargo = b.id_cargo");
			$this->db->from("mante_cargos b");
			$this->db->where("a.id_sucursal = c.id_sucursal");
			$this->db->from("conf_sucursal c");
			if($info_user)
			{
				if($info_user['id_sucursal']!=0)
				{
					return $this->db->get_where($this->nombre_tabla." a",array('a.activo'=>1,'a.id_sucursal'=>$info_user['id_sucursal']))->result_array();
				}else{
					return $this->db->get_where($this->nombre_tabla." a",array('a.activo'=>1,'a.id_cooperativa'=>$info_user['id_cooperativa']))->result_array();
				}
			}else{
				
				return $this->db->get_where($this->nombre_tabla." a",array('a.activo'=>1))->result_array();
				
				}
				
		}else{
			
			return $this->db->get_where($this->nombre_tabla,array($this->id_tabla=>$id))->row_array();
			}
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
	
	function obtener_cooperativas($datos=array())
	{
		if($datos)
			{
				
				return $this->db->get_where("conf_cooperativa a",array('a.activo'=>1,'a.id_cooperativa'=>$datos['id_cooperativa']))->result_array();
			}else{
				
				return $this->db->get_where("conf_cooperativa a",array('a.activo'=>1))->result_array();
				
				}
	}
	
	function obtener_sucursales($id_cooperativa=0)
	{
		return $this->db->get_where("conf_sucursal a",array('a.id_cooperativa'=>$id_cooperativa))->result_array();
		 
	}
	
}