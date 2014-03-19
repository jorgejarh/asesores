<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Ase_proyectos_model extends CI_Model {
	
	public $nombre_tabla="asesoria_proyectos";
	
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
			return $this->db->get_where($this->nombre_tabla,array($this->id_tabla=>$id))->row_array();
			}
	}
	
	function lista($id=0)
	{
		$this->db->select("a.* ");
		$datos= $this->db->get_where($this->nombre_tabla." a",array('a.activo'=>1,'a.id_servicio'=>$id))->result_array();
		
		foreach($datos as $key=>$valor)
		{
			$datos[$key]['tecnicos']=$this->db->where("a.id_facilitador = b.id_facilitador")->get_where("asesoria_tecnicos_x_proyecto a, mante_facilitadores b",array('a.id_proyecto'=>$valor['id_proyecto']))->result_array();
		}
		
		return $datos;		
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
	
	function obtener_tecnicos()
	{
		
		return $this->db->select("a.*, concat(a.nombres, ' ', a.apellidos) as nombre_completo",false)->get_where("mante_facilitadores a",array("a.id_tipo_facilitador"=>2))->result_array();
	}
	
	function asignar_tecnico($datos=array())
	{
		return $this->db->insert("asesoria_tecnicos_x_proyecto",$datos);
	}
	
	function eliminar_tecnico($id_asignacion=0)
	{
		return $this->db->delete("asesoria_tecnicos_x_proyecto",array('id_tecnico_asignado'=>$id_asignacion));
	}
	
}