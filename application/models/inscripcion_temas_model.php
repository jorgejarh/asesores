<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Inscripcion_temas_model extends CI_Model {
	
	public $nombre_tabla="inscripcion_temas";
	
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
			
			$facilitadores=$this->db->get_where('pl_modulo_facilitador',array($this->id_tabla=>$id))->result_array();
			
			if($facilitadores)
			{
				foreach($facilitadores as $valor)
				{
					$dato['facilitadores[]'][]=$valor['id_facilitador'];
				}
			}else{
				$dato['facilitadores[]']=array();
				}
			
			
			
			return $dato;
			}
	}
	
	function lista($id=0)
	{
		$this->db->select("a.*, b.nombre_capacitacion,
										IFNULL((SELECT SUM(e.unidades*e.costo) 
											FROM 
												pl_modulos c, 
												pl_rubro d, 
												pl_subrubro e  
											WHERE 
												e.id_rubro = d.id_rubro AND 
												d.id_modulo = c.id_modulo AND 
												c.id_capacitacion = b.id_capacitacion and 
												e.activo = 1 and 
												c.activo = 1 and  
												d.activo = 1 ),0.00) AS sum_total 
												",false);
		
		$this->db->where("a.id_capacitacion = b.id_capacitacion");
		return $this->db->get_where($this->nombre_tabla." a, pl_capacitaciones b",array('a.activo'=>1))->result_array();
		
	}
	
	
	function actualizar($datos,$id)
	{
		
		$facilitadores=$datos['facilitadores'];
		unset($datos['facilitadores']);
		
		$result= $this->db->update($this->nombre_tabla,$datos,array($this->id_tabla=>$id));
		
		$this->db->delete('pl_modulo_facilitador',array('id_modulo'=>$id));
		
		foreach($facilitadores as $valor)
		{
			$this->db->insert('pl_modulo_facilitador',array('id_modulo'=>$id,'id_facilitador'=>$valor));
		}
		
		return $result;
	}
	
	function nuevo($datos)
	{
		$facilitadores=$datos['facilitadores'];
		unset($datos['facilitadores']);
		$datos['id_usuario']=$this->datos_user['id_usuario'];
		$datos['f_creacion']=date('Y-m-d H:i:s');
		$result= $this->db->insert($this->nombre_tabla,$datos);
		$id=$this->db->insert_id();
		foreach($facilitadores as $valor)
		{
			$this->db->insert('pl_modulo_facilitador',array('id_modulo'=>$id,'id_facilitador'=>$valor));
		}
		
		return $result;
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
	
	function obtener_presupuesto($id_modulo=0)
	{
		$data=$this->db->get_where('pl_modulos a',array('a.id_modulo'=>$id_modulo,'a.activo'=>1))->row_array();
		if($data)
		{
			$data_capacitacion=$this->db->get_where('pl_capacitaciones a',array('a.id_capacitacion'=>$data['id_capacitacion'],'a.activo'=>1))->row_array();
			if($data_capacitacion)
			{
				$data_modalidad_plan=$this->db->select('b.*,a.id_plan_modalidad, c.*')
									->where("a.id_modalidad = b.id_modalidad ")
									->where("a.id_plan = c.id_plan ")
									->where("b.activo = 1")
									->where("c.activo = 1")
									->get_where('pl_modalidades a, mante_modalidades b, pl_planes c',array('a.id_plan_modalidad'=>$data_capacitacion['id_plan_modalidad'],'a.activo'=>1))->row_array();
				
				if($data_modalidad_plan)
				{
					$data['data_capacitacion']=$data_capacitacion;
					$data['data_modalidad_plan']=$data_modalidad_plan;
					// libero memoria
					unset($data_capacitacion);
					unset($data_modalidad_plan);
					
					$this->db->select("a.*, b.nombre");
					$this->db->where("a.id_rubro_name = b.id_rubro");
					$data['rubros']=$this->db->get_where('pl_rubro a, mante_rubros b',array('a.id_modulo'=>$id_modulo,'a.activo'=>1))->result_array();
					if($data['rubros'])
					{
						foreach($data['rubros'] as $key_ru=>$valor_ru)
						{
							$data['rubros'][$key_ru]['sub']=$this->db->get_where('pl_subrubro a',array('a.id_rubro'=>$valor_ru['id_rubro'],'a.activo'=>1))->result_array();
						}
					}
					$data['facilitadores']=$this->db->select('b.*')->where('a.id_facilitador = b.id_facilitador')->get_where('pl_modulo_facilitador a, mante_facilitadores b',array('a.id_modulo'=>$id_modulo))->result_array();
					$data['lugar']=$this->db->get_where('mante_lugares a',array('a.id_lugar'=>$data['id_lugar'],'a.activo'=>1))->row_array();
					
					
					return $data;
					
				}else{
					echo "Modalidad o Plan no encontrado";
					exit();
					}
			}else{
				echo "Capacitacion no encontrada";
				exit();
				}
		}else{
			echo "Modulo no encontrado";
			exit();
			}
	}
	
	
}