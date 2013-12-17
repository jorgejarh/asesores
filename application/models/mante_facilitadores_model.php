<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Mante_facilitadores_model extends CI_Model {
	
	public $nombre_tabla="mante_facilitadores";
	
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
			$this->db->select("*, concat(nombres,' ',apellidos) as nombre_completo",false);
			return $this->db->get_where($this->nombre_tabla,array('activo'=>1))->result_array();
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
	
	
	function obtener_profesiones($id_facilitador=0)
	{
		return $this->db->select("b.id_profesion",false)->where("a.id_profesion = b.id_profesion",false,false)->get_where('mante_profesion_x_facilitador a, mante_profesiones b',array('a.id_facilitador'=>$id_facilitador))->result_array();
	}
	
	function actualizar_profesiones($id_profesiones,$id_facilitador)
	{
		$this->db->delete('mante_profesion_x_facilitador',array('id_facilitador'=>$id_facilitador));
		foreach($id_profesiones as $profesion)
		{
			$this->db->insert('mante_profesion_x_facilitador',array('id_facilitador'=>$id_facilitador,'id_profesion'=>$profesion));
		}
		return true;
	}
	
	function obtener_especalidades($id_facilitador=0)
	{
		return $this->db->select("b.id_especialidad",false)->where("a.id_especialidad = b.id_especialidad",false,false)->get_where('mante_especialidades_x_facilitador a, mante_especialidades b',array('a.id_facilitador'=>$id_facilitador))->result_array();
	}
	
	function actualizar_especialidades($id_especialidades,$id_facilitador=0)
	{
		
		$this->db->delete('mante_especialidades_x_facilitador',array('id_facilitador'=>$id_facilitador));
		
		foreach($id_especialidades as $especialidad)
		{
			$this->db->insert('mante_especialidades_x_facilitador',array('id_facilitador'=>$id_facilitador,'id_especialidad'=>$especialidad));
		}
		return true;
	}
	
	
}