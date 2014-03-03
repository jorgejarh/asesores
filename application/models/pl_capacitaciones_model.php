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
	
	function lista($id=0,$estado='')
	{
		$this->db->select("a.*, 
								(SELECT COUNT(*) 
								FROM pl_modulos b 
								WHERE 
									b.id_capacitacion = a.id_capacitacion and 
									b.activo = 1) AS num_modulos, 
									 
									concat(a.nombre_capacitacion,' ($',IFNULL((
																			SELECT ROUND(SUM(c.precio_venta),2)
																			FROM 
																				pl_modulos c
																			WHERE 
																				c.id_capacitacion = a.id_capacitacion and 
																				c.activo = 1),0.00),' )') as nombre_suma ",false);
		if($estado=='abiertos')
		{
			$this->db->where(array('a.cerrado'=>0));
		}
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
	function estado($id,$data)
	{
		return $this->db->update($this->nombre_tabla,$data,array($this->id_tabla=>$id));
		//return $this->db->delete($this->nombre_tabla,array($this->id_tabla=>$id));
	}
	
	function obtener_presupuesto($id_capacitacion=0)
	{
		$data=$this->db->get_where('pl_capacitaciones a',array('a.id_capacitacion'=>$id_capacitacion,'a.activo'=>1))->row_array();
		if($data)
		{
			$data['modalidad']=$this->db->select("a.*, b.nombre_modalidad, c.nombre_plan",false)->where("a.id_modalidad = b.id_modalidad and a.id_plan = c.id_plan")->get_where('pl_modalidades a, mante_modalidades b, pl_planes c',array('a.id_plan_modalidad'=>$data['id_plan_modalidad'],'a.activo'=>1))->row_array();
			
			if($data['modalidad'])
			{
				
				$data['modulos']=$this->db->get_where('pl_modulos a',array('a.id_capacitacion'=>$data['id_capacitacion'],'a.activo'=>1))->result_array();
				
				if($data['modulos'])
				{
					foreach($data['modulos'] as $key=>$val)
					{
						$data['modulos'][$key]['rubros']=$this->db->select("a.*, b.nombre as nombre_rubro")
														->where("a.id_rubro_name = b.id_rubro")
														->get_where('pl_rubro a, mante_rubros b',array('a.id_modulo'=>$val['id_modulo'],'a.activo'=>1))
														->result_array();
						
						if($data['modulos'][$key]['rubros'])
						{
							foreach($data['modulos'][$key]['rubros'] as $key2=>$val2)
							{
								$data['modulos'][$key]['rubros'][$key2]['sub']=$this->db->get_where('pl_subrubro a',array('a.id_rubro'=>$val2['id_rubro'],'a.activo'=>1))->result_array();
							}
						}
						
						
						
					}
					return $data;
					
				}else{
					echo "No hay modulos";
					exit();
					}
					
			}else{
				echo "Modalidad o PLan Incorrecto";
				exit();
				}
			
			
		}else{
			echo "Capacitación no encontrado";
			exit();
			}
		
		
	}
	
	function obtener_rubros_x_capacitacion($id_capacitacion=0)
	{
		return $this->db->query("SELECT 
				  b.`id_rubro_name`,
				  d.nombre,
				  SUM(c.costo * c.dias * c.unidades) AS total 
				FROM
				  `pl_modulos` a,
				  `pl_rubro` b,
				  `mante_rubros` d,
				  pl_subrubro c 
				WHERE a.`id_capacitacion` = ".$id_capacitacion." 
				  AND b.`id_modulo` = a.`id_modulo` 
				  AND b.`id_rubro` = c.`id_rubro` 
				  AND b.`id_rubro_name` = d.`id_rubro` 
				  AND a.`activo` = 1 
				  AND b.`activo` = 1 
				  AND c.`activo` = 1 
				  AND d.`activo` = 1 
				  GROUP BY b.`id_rubro_name`")->result_array();
	}
	
	function obtener_sub_rubros_x_capacitacion($id_capacitacion=0,$id_rubro=0)
	{
		return $this->db->query("SELECT 
				  b.`id_rubro_name`,
				  d.nombre,
				  c.`nombre` AS nombre_sub,
				  (c.costo * c.dias * c.unidades) AS total ,
					c.unidades,
					  c.dias,
						c.costo
				FROM
				  `pl_modulos` a,
				  `pl_rubro` b,
				  `mante_rubros` d,
				  pl_subrubro c 
				WHERE a.`id_capacitacion` = ".$id_capacitacion." 
				  AND b.`id_modulo` = a.`id_modulo` 
				  AND b.`id_rubro` = c.`id_rubro` 
				  AND b.`id_rubro_name` = d.`id_rubro` 
				  AND a.`activo` = 1 
				  AND b.`activo` = 1 
				  AND c.`activo` = 1 
				  AND d.`activo` = 1 
				  AND b.`id_rubro_name`=".$id_rubro."")->result_array();
	}
	
}