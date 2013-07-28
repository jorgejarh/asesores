<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Re_planes_model extends CI_Model {
	
		
    function __construct()
    {
        parent::__construct();
		
		
		
    }
	
	
	function obtener_total_cooperativas()
	{
		
		$cooperativas=$this->db->select('cooperativa, id_cooperativa')->get('conf_cooperativa')->result_array();
		
		foreach($cooperativas as $key_coo=>$valor_coo)
		{
			$cooperativas[$key_coo]['planes']=$this->db->get_where('pl_planes',array('activo'=>1))->result_array();
			
			foreach($cooperativas[$key_coo]['planes'] as $key_pla=>$valor_plan)
			{
				$cooperativas[$key_coo]['planes'][$key_pla]['modalidades']=$this->db->select("a.*, b.nombre_modalidad")->where('a.id_modalidad = b.id_modalidad')->get_where('pl_modalidades a, mante_modalidades b',array('a.activo'=>1,'b.activo'=>1,'a.id_plan'=>$valor_plan['id_plan']))->result_array();
				
				foreach($cooperativas[$key_coo]['planes'][$key_pla]['modalidades'] as $key_modalidad=>$valor_modalidad)
				{
					$cooperativas[$key_coo]['planes'][$key_pla]['modalidades'][$key_modalidad]['temas']=$this->db->get_where('pl_capacitaciones',array('activo'=>1,'id_plan_modalidad'=>$valor_modalidad['id_plan_modalidad']))->result_array();
					
					foreach($cooperativas[$key_coo]['planes'][$key_pla]['modalidades'][$key_modalidad]['temas'] as $key_temas=>$valor_tema)
					{
						$cooperativas[$key_coo]['planes'][$key_pla]['modalidades'][$key_modalidad]['temas'][$key_temas]['modulos']=$this->db->get_where('pl_modulos',array('activo'=>1,'id_capacitacion'=>$valor_tema['id_capacitacion']))->result_array();
						
						
					}
					
				}
				
			}
		}
		
		return $cooperativas;
	}
   
}