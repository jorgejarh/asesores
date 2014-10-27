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
		$this->db->select("a.*, c.nombre_modalidad, e.nombre_plan, (SELECT 
							SUM(f.precio_venta) 
						  FROM
							pl_modulos f 
						  WHERE f.activo = 1 
							AND f.id_capacitacion = a.id_capacitacion) cuota_1, (SELECT 
							SUM(f.precio_venta_no) 
						  FROM
							pl_modulos f 
						  WHERE f.activo = 1 
							AND f.id_capacitacion = a.id_capacitacion) cuota_2",false);
		
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
				  SUM(c.costo * c.dias * c.unidades) AS total ,
				  SUM(c.costo_real * c.dias_reales * c.unidades_reales) AS total_real 
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
				  (c.costo_real * c.dias_reales * c.unidades_reales) AS total_real ,
					c.unidades,
					  c.dias,
						c.costo,
						c.unidades_reales,
					  c.dias_reales,
						c.costo_real
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
	
	function obtener_participantes($id_capacitacion,$modulos)
	{
		$datos=$this->db->query("SELECT 
							  a.`id_inscripcion_tema`,
							  b.`id_cooperativa`,
							  b.`cooperativa`,
							  c.`dui`,
							  c.`nombres`,
							  c.`apellidos` ,
							  c.`id_inscripcion_personas`
							FROM
							  inscripcion_temas a,
							  conf_cooperativa b,
							  inscripcion_temas_personas c
							WHERE a.id_capacitacion = ".$id_capacitacion." 
							  AND a.activo = 1 
							  AND b.`activo`=1
							  AND c.`activo`=1
							  AND a.`id_cooperativa`=b.`id_cooperativa`
							  AND a.`id_inscripcion_tema`=c.`id_inscripcion_tema`
							ORDER BY b.`cooperativa` ASC
							")->result_array();
		
		foreach($datos as $key=>$val)
		{
			$datos[$key]['modulos']=$modulos;
			$suma_nota=0;
			$suma_asistencia=0;
			foreach($datos[$key]['modulos'] as $key2=>$val2)
			{
				$datos[$key]['modulos'][$key2]['nota']=$this->obtener_nota_x_modulo($val2['id_modulo'],$val['id_inscripcion_personas']);
				$datos[$key]['modulos'][$key2]['asistencia']=$this->obtener_asistencia_x_modulo($val2['id_modulo'],$val['id_inscripcion_personas']);
				$suma_asistencia+=$datos[$key]['modulos'][$key2]['asistencia'];
				$suma_nota+=$datos[$key]['modulos'][$key2]['nota'];
			}
			$datos[$key]['nota_final']=$suma_nota/count($modulos);
			$datos[$key]['por_asistencia']=($suma_asistencia/count($modulos))*100;
			
			
		}
		
		return $datos;
		
	}
	
	function obtener_nota_x_modulo($id_modulo, $id_inscripcion_personas)
	{
		$nota=$this->db->query("SELECT 
								  SUM(a.`nota`* (b.`porcentaje`/100)) AS nota_final
								FROM
								  `pl_modulos_notas` a,
								  `pl_modulos_eval` b
								WHERE a.`id_modulo` = ".$id_modulo." 
								  AND a.`id_inscripcion_persona` = ".$id_inscripcion_personas."
								  AND a.`id_eval_x_mod`= b.`id_eval_x_mod`
								  AND b.`activo`=1
								  ")->row_array();
		if($nota)
		{
			return number_format($nota['nota_final'],2);
		}else{
			return 0;
			}
		
	}
	
	function obtener_asistencia_x_modulo($id_modulo, $id_inscripcion_personas)
	{
		$asistencia=$this->db->query("SELECT 
								  COUNT(*) AS asistencia
								FROM
								  `inscripcion_asistencia` 
								WHERE `id_modulo` = ".$id_modulo." 
								  AND `id_inscripcion_personas` = ".$id_inscripcion_personas."
								  AND `asistio`=1 AND `aprobado`=1
								  ")->row_array();
		if($asistencia)
		{
			return $asistencia['asistencia'];
		}else{
			return 0;
			}
		
	}
	
	function obtener_cooperativas_inscritas($id_capacitacion=0)
	{
		return $this->db->query("SELECT 
						  b.`cooperativa` AS nombre_cooperativa,
						  COUNT(c.id_inscripcion_personas) numero_participantes,
						  (SELECT 
							SUM(d.precio_venta) 
						  FROM
							pl_modulos d 
						  WHERE d.activo = 1 
							AND d.id_capacitacion = ".$id_capacitacion.") valor,
						  COUNT(c.id_inscripcion_personas) * 
						  (SELECT 
							SUM(e.precio_venta) 
						  FROM
							pl_modulos e 
						  WHERE e.activo = 1 
							AND e.id_capacitacion = ".$id_capacitacion.") total,
						  (SELECT 
							GROUP_CONCAT(CONCAT(f.descuento,'%'))
						  FROM
							inscripcion_temas_descuentos f 
						  WHERE f.activo = 1 
							AND f.id_inscripcion_tema = a.id_inscripcion_tema) descuento,
						  a.* 
						FROM
						  inscripcion_temas a,
						  conf_cooperativa b,
						  inscripcion_temas_personas c
						WHERE a.id_capacitacion = ".$id_capacitacion." 
						  AND a.`id_cooperativa` = b.`id_cooperativa` 
						  AND a.`activo` = 1 
						  AND b.`activo` = 1 
						  AND c.`activo` = 1 
						  AND c.`id_inscripcion_tema` = a.`id_inscripcion_tema` 
						GROUP BY a.`id_cooperativa`")->result_array();
	}
	
	
}