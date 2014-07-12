<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Pago_abono_model extends CI_Model {

    function __construct()
    {
        parent::__construct();
    }
	
	function obtener_cooperativas($datos=array())
	{
		$this->db->select("a.*, ( select sum(b.abono) from abono_x_cooperativa b where  a.id_cooperativa = b.id_cooperativa ) as abono",false);
		//$this->db->group_by("a.id_cooperativa");
		if(!$datos)
		{
			return $this->db->get_where("conf_cooperativa a",array('a.activo'=>1))->result_array();
		}else{
			return $this->db->get_where("conf_cooperativa a",array('a.id_cooperativa'=>$datos['id_cooperativa']))->result_array();
			}
	}
	
	function nuevo($datos=array())
	{
		unset($datos['tipo_abono']);
		$modulos=array();
		if(isset($datos['modulo']))
		{
			$modulos=$datos['modulo'];
			unset($datos['modulo']);
			
		}
		
		$this->db->insert('abono_x_cooperativa',$datos);
		$id_nota_cargo=$this->db->insert_id();
		foreach($modulos as $key=>$val)
		{
			$this->db->insert('abono_x_cooperativa_detalle',array('id_nota_cargo'=>$id_nota_cargo,'id_modulo'=>$key,'cantidad'=>$val));
			$this->db->query("update pl_modulos_saldo set saldo = saldo - ".$val." where id_cooperativa = ".$datos['id_cooperativa']." and id_modulo = ".$key);
			/*$this->db->update('pl_modulos_saldo',array('saldo -'=>$val),array('id_cooperativa'=>$datos['id_cooperativa'],'id_modulo'=>$key));
			echo $this->db->last_query();
			exit;*/
		}
		
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
		$this->load->model('descuentos_model');
		
		$datos= $this->obtener_info_mod_x_cooperativa($id_cooperativa);
  	
		foreach($datos as $val)
		{
			$dat_mod_sal=$this->db->get_where('pl_modulos_saldo',array('id_modulo'=>$val['id_modulo'],'id_cooperativa'=>$id_cooperativa))->row_array();
			if(!$dat_mod_sal)
			{
				$descuento=$this->descuentos_model->obtener_descuento_x_modulo($id_cooperativa,$val['id_modulo']);
				$saldo_normal=$val['inscritos']*$val['precio_venta'];
				$saldo_con_descuento=$saldo_normal-($saldo_normal*($descuento/100));
				$this->db->insert('pl_modulos_saldo',array('id_modulo'=>$val['id_modulo'],'id_cooperativa'=>$id_cooperativa,'saldo'=>$saldo_con_descuento));
			}
		}
  		$datos= $this->obtener_info_mod_x_cooperativa($id_cooperativa);
		return $datos;
	}
	
}
