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
			
			$this->db->select("a.*, b.nombre_estado",false);
			
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
	
	
	function obtener_plan_completo($id_plan=0)
	{
		if($id_plan!=0)
		{
			$data=$this->db->get_where('pl_planes a',array('a.id_plan'=>$id_plan,'a.activo'=>1))->row_array();
			if($data)
			{
				$data['modalidades']=$this->db->select("a.*, b.nombre_modalidad")
											->where("a.id_modalidad = b.id_modalidad")
											->where("b.activo",1)
											->get_where('pl_modalidades a, mante_modalidades b',array('a.id_plan'=>$data['id_plan'],'a.activo'=>1))->result_array();
				if($data['modalidades'])
				{
					
					foreach($data['modalidades'] as $key=>$val)
					{
						$data['modalidades'][$key]['temas']=$this->db
															->get_where('pl_capacitaciones a',array('a.id_plan_modalidad'=>$val['id_plan_modalidad'],'a.activo'=>1))->result_array();
															
						if($data['modalidades'][$key]['temas'])
						{//22
							foreach($data['modalidades'][$key]['temas'] as $key_t=>$tema)
							{
								$data['modalidades'][$key]['temas'][$key_t]['modulos']=$this->db
																						->get_where('pl_modulos a',
																												array('a.id_capacitacion'=>$tema['id_capacitacion'],
																													  'a.activo'=>1)
																													  )->result_array();
								
								if($data['modalidades'][$key]['temas'][$key_t]['modulos'])
								{//33
									
									foreach($data['modalidades'][$key]['temas'][$key_t]['modulos'] as $key_m=>$modulo)
									{
										$data['modalidades'][$key]['temas'][$key_t]['modulos'][$key_m]['rubros']=$this->db
																												->get_where('pl_rubro a',
																																array('a.id_modulo'=>$modulo['id_modulo'],
																																	  'a.activo'=>1)
																																	  )->result_array();
										if($data['modalidades'][$key]['temas'][$key_t]['modulos'][$key_m]['rubros'])
										{//44
											
											foreach($data['modalidades'][$key]['temas'][$key_t]['modulos'][$key_m]['rubros'] as $key_r=>$rubro)
											{
												$data['modalidades'][$key]['temas'][$key_t]['modulos'][$key_m]['rubros'][$key_r]['detalle']=$this->db
																																	->get_where('pl_subrubro a',
																																				array('a.id_rubro'=>$rubro['id_rubro'],
																																						  'a.activo'=>1)
																																						  )->result_array();
											}
											
										}//44
									}
									
								}//33
								
							}
						}//22
					}
					
					return $data;
					
				}else{
					echo "Modalidades no encontradas";
					exit();
					}
			}else{
				echo "Plan no encontrado";
				exit();
				}
		}
		
	}
	
	
}