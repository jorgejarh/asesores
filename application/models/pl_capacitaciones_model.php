<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Pl_capacitaciones_model extends CI_Model {
	
	public $nombre_tabla="pl_capacitaciones";
	
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
		$this->db->select("a.*, c.nombre_modalidad, e.nombre_plan ");
		
		$this->db->where("a.id_capacitacion = d.id_capacitacion ");
		
		$this->db->where("d.id_plan_modalidad = b.id_plan_modalidad ");
		
		$this->db->where("b.id_modalidad = c.id_modalidad ");
		$this->db->where("b.id_plan = e.id_plan");
		
		if($id==0)
		{
			
			return $this->db->get_where($this->nombre_tabla." a, pl_modalidades b, mante_modalidades c, pl_capacitaciones d, pl_planes e",array('a.activo'=>1))->result_array();
		}else{
			return $this->db->get_where($this->nombre_tabla." a, pl_modalidades b, mante_modalidades c, pl_capacitaciones d,  pl_planes e",array("a.".$this->id_tabla=>$id))->row_array();
			}
	}
	
	function lista($id=0)
	{
		$this->db->select("a.* ");
		return $this->db->get_where($this->nombre_tabla." a",array('a.activo'=>1,'a.id_plan_modalidad'=>$id))->result_array();
		
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