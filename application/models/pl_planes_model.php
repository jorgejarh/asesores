<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Pl_planes_model extends CI_Model {
	
	public $nombre_tabla="pl_planes";
	
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
			
			$this->db->select("a.*, b.nombre_estado, IFNULL((SELECT 
										SUM(g.unidades*g.costo) 
									  FROM
										pl_modalidades c,
										pl_capacitaciones d,
										pl_modulos e,
										pl_rubro f,
										pl_subrubro g 
									  WHERE a.id_plan = c.id_plan
									  	AND c.id_plan_modalidad = d.id_plan_modalidad 
										AND e.id_capacitacion = d.id_capacitacion 
										AND f.id_modulo = e.id_modulo 
										AND f.id_rubro = g.id_rubro
										AND c.activo = 1
										AND d.activo = 1
										AND e.activo = 1
										AND f.activo = 1
										AND g.activo = 1
										),0.00) AS sum_total",false);
			
			$this->db->where("a.id_estado_plan = b.id_estado_plan");
			return $this->db->get_where($this->nombre_tabla." a, mante_estados_planes b",array('a.activo'=>1))->result_array();
		}else{
			
			return $this->db->get_where($this->nombre_tabla." a",array("a.".$this->id_tabla=>$id))->row_array();
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
	
}