<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Temas_disponibles_model extends CI_Model {
	
	
	
    function __construct()
    {
        parent::__construct();
		
		
    }
	
   
	
	function obtener_plan_completo($id_plan=0)
	{
		
		
		
			$data=$this->db->get_where('pl_planes a',array('a.activo'=>1,'id_estado_plan'=>2))->result_array();
			if($data)
			{//11
				
				
				foreach($data as $key_plan=>$valor_plan)
				{//22
									
				$data[$key_plan]['modalidades']=$this->db->select("a.*, b.nombre_modalidad")
											->where("a.id_modalidad = b.id_modalidad")
											->where("b.activo",1)
											->get_where('pl_modalidades a, mante_modalidades b',array('a.id_plan'=>$valor_plan['id_plan'],'a.activo'=>1))->result_array();
				
				if($data[$key_plan]['modalidades'])
				{
					
					foreach($data[$key_plan]['modalidades'] as $key=>$val)
					{
						$data[$key_plan]['modalidades'][$key]['temas']=$this->db
															->get_where('pl_capacitaciones a',array('a.id_plan_modalidad'=>$val['id_plan_modalidad'],'a.activo'=>1))->result_array();
															
						if($data[$key_plan]['modalidades'][$key]['temas'])
						{//22
							foreach($data[$key_plan]['modalidades'][$key]['temas'] as $key_t=>$tema)
							{
								$data[$key_plan]['modalidades'][$key]['temas'][$key_t]['modulos']=$this->db
																						->get_where('pl_modulos a',
																												array('a.id_capacitacion'=>$tema['id_capacitacion'],
																													  'a.activo'=>1)
																													  )->result_array();
								
								if($data[$key_plan]['modalidades'][$key]['temas'][$key_t]['modulos'])
								{//33
									
									foreach($data[$key_plan]['modalidades'][$key]['temas'][$key_t]['modulos'] as $key_m=>$modulo)
									{
										$data[$key_plan]['modalidades'][$key]['temas'][$key_t]['modulos'][$key_m]['rubros']=$this->db
																												->get_where('pl_rubro a',
																																array('a.id_modulo'=>$modulo['id_modulo'],
																																	  'a.activo'=>1)
																																	  )->result_array();
										if($data[$key_plan]['modalidades'][$key]['temas'][$key_t]['modulos'][$key_m]['rubros'])
										{//44
											
											foreach($data[$key_plan]['modalidades'][$key]['temas'][$key_t]['modulos'][$key_m]['rubros'] as $key_r=>$rubro)
											{
												$data[$key_plan]['modalidades'][$key]['temas'][$key_t]['modulos'][$key_m]['rubros'][$key_r]['detalle']=$this->db
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
					
					
					
				}
					
					
				}//22
				
				return $data;
			
		}else{//11
		
			echo "Plan no encontrado";
			exit();
			}//11
		
	}
	
	
}