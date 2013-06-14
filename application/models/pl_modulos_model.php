<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Pl_modulos_model extends CI_Model {
	
	public $nombre_tabla="pl_modulos";
	
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
		return $this->db->get_where($this->nombre_tabla." a",array('a.activo'=>1,'a.id_capacitacion'=>$id))->result_array();
		
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
					
					unset($data_capacitacion);
					unset($data_modalidad_plan);
					
					$data['rubros']=$this->db->get_where('pl_rubro a',array('a.id_modulo'=>$id_modulo,'a.activo'=>1))->result_array();
					if($data['rubros'])
					{
						foreach($data['rubros'] as $key_ru=>$valor_ru)
						{
							$data['rubros'][$key_ru]['sub']=$this->db->get_where('pl_subrubro a',array('a.id_rubro'=>$valor_ru['id_rubro'],'a.activo'=>1))->result_array();
						}
					}
					
					return $data;
					/*echo "<pre>";
					print_r($data);
					echo "<pre>";*/
					
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