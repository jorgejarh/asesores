<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Inscripcion_temas_personas_model extends CI_Model {
	
	public $nombre_tabla="inscripcion_temas_personas";
	
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
			
			$dato=$this->db->get_where($this->nombre_tabla,array($this->id_tabla=>$id))->row_array();
			
			return $dato;
			}
	}
	
	function lista($id=0)
	{
		$this->db->select("a.*, b.nombre_capacitacion, d.sucursal, e.nombre_cargo");
		$this->db->where("b.id_capacitacion = c.id_capacitacion");
		$this->db->where("a.id_inscripcion_tema = c.id_inscripcion_tema");
		$this->db->where("d.id_sucursal = a.id_sucursal");
		$this->db->where("e.id_cargo = a.id_cargo");
		return $this->db->get_where($this->nombre_tabla." a, pl_capacitaciones b, inscripcion_temas c, conf_sucursal d, mante_cargos e",array('a.id_inscripcion_tema'=>$id,'a.activo'=>1))->result_array();
		
	}
		
	function actualizar($datos,$id)
	{
		
		$result= $this->db->update($this->nombre_tabla,$datos,array($this->id_tabla=>$id));
		return $result;
	}
	
	function nuevo($datos)
	{
		
		$datos['id_usuario']=$this->datos_user['id_usuario'];
		$datos['f_creacion']=date('Y-m-d H:i:s');
		$result= $this->db->insert($this->nombre_tabla,$datos);
		$id=$this->db->insert_id();
		
		
		return $result;
	}
	
	function eliminar($id)
	{
		
		return $this->db->delete($this->nombre_tabla,array($this->id_tabla=>$id));
	}
	
	
	function obtener_inscripcion($id)
	{
		$this->db->select("a.*, b.nombre_capacitacion");
		$this->db->where("a.id_capacitacion = b.id_capacitacion");
		return $this->db->get_where('inscripcion_temas a, pl_capacitaciones b',array('a.id_inscripcion_tema'=>$id))->row_array();
	}
	
	
	function obtener_sucursales($info_user=array())
	{
		if($info_user)
		{
			if($info_user['id_sucursal']!=0)
			{
				return $this->db->get_where('conf_sucursal a',array('a.activo'=>1,'a.id_sucursal'=>$info_user['id_sucursal']))->result_array();
			}else{
				return $this->db->get_where('conf_sucursal a',array('a.activo'=>1,'a.id_cooperativa'=>$info_user['id_cooperativa']))->result_array();
				}
		}else{
			
			return $this->db->get_where('conf_sucursal a',array('a.activo'=>1))->result_array();
			
			}
	}
	
	function obtener_cargos()
	{
		return $this->db->get_where('mante_cargos a',array('a.activo'=>1))->result_array();
	}
	
	
	function validar_inscrito($dui='',$id_inscripcion=0)
	{
		$datos=$this->db->get_where('inscripcion_temas_personas',array('dui'=>$dui,'id_inscripcion_tema'=>$id_inscripcion))->row_array();
		
		if($datos)
		{
			return true;
		}else{
			return false;
			}
		
	}
	
}