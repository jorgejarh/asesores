<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Pago_abono_model extends CI_Model {

    function __construct()
    {
        parent::__construct();
    }
	
	function obtener_cooperativas($datos=array())
	{
		if(!$datos)
		{
			return $this->db->get_where("conf_cooperativa",array('activo'=>1))->result_array();
		}else{
			return $this->db->get_where("conf_cooperativa",array('id_cooperativa'=>$datos['id_cooperativa']))->result_array();
			}
	}
	
	function nuevo($datos=array())
	{
		$this->db->insert('abono_x_cooperativa',$datos);
	}

	function lista($id_cooperativa=0)
	{
		return $this->db->get_where('abono_x_cooperativa',array('id_cooperativa'=>$id_cooperativa))->result_array();
	}
	
	function obtener_info_mod_x_cooperativa($id_cooperativa=0)
	{
		return $this->db->query("Select * from (
								SELECT 
								  b.*,
								  (SELECT 
									COUNT(*) 
								  FROM
									inscripcion_asistencia c,
									inscripcion_temas_personas d 
								  WHERE c.id_modulo = b.id_modulo 
									AND c.aprobado = 1 
									AND d.id_inscripcion_personas = c.id_inscripcion_personas 
									AND d.id_inscripcion_tema = a.id_inscripcion_tema) AS inscritos ,
									IFNULL((SELECT f.saldo FROM pl_modulos_saldo f WHERE f.id_modulo = b.id_modulo AND f.id_cooperativa= ".$id_cooperativa."),0) AS saldo
								FROM
								  inscripcion_temas a,
								  pl_modulos b 
								WHERE a.id_cooperativa = ".$id_cooperativa." 
								  AND b.id_capacitacion = a.id_capacitacion ) e WHERE e.inscritos!=0
  ")->result_array();
	}
	
	function obtener_modulos_x_cooperativa($id_cooperativa=0)
	{
		$datos= $this->obtener_info_mod_x_cooperativa($id_cooperativa);
  	
		foreach($datos as $val)
		{
			$dat_mod_sal=$this->db->get_where('pl_modulos_saldo',array('id_modulo'=>$val['id_modulo'],'id_cooperativa'=>$id_cooperativa))->row_array();
			if(!$dat_mod_sal)
			{
				$this->db->insert('pl_modulos_saldo',array('id_modulo'=>$val['id_modulo'],'id_cooperativa'=>$id_cooperativa,'saldo'=>$val['inscritos']*$val['precio_venta']));
			}
		}
  		$datos= $this->obtener_info_mod_x_cooperativa($id_cooperativa);
		return $datos;
	}
	
}
