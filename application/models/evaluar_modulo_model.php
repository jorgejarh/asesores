<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Evaluar_modulo_model extends CI_Model {
	
    function __construct()
    {
        parent::__construct();
    }
	
   function obtener_planes()
   {
	   return $this->db->get_where('pl_planes',array('activo'=>1))->result_array();
}
	function obtener_modalidades($id_plan=0)
	{
		$this->db->select('a.*,b.nombre_modalidad');
		$this->db->where("a.id_modalidad =  b.id_modalidad");
		return $this->db->get_where('pl_modalidades a, mante_modalidades b',array('a.id_plan'=>$id_plan,'a.activo'=>1))->result_array();
	}
	
	function obtener_capacitaciones($id_plan_modalidad=0)
	{
		return $this->db->get_where('pl_capacitaciones',array('id_plan_modalidad'=>$id_plan_modalidad,'activo'=>1))->result_array();
	}
	
	function obtener_modulos($id_capacitacion=0)
	{
		//return $this->db->get_where('pl_modulos',array('id_capacitacion'=>$id_capacitacion,'activo'=>1,'puede_evaluar'=>1))->result_array();
		return $this->db->get_where('pl_modulos',array('id_capacitacion'=>$id_capacitacion,'activo'=>1))->result_array();
	}
	
	function obtener_modulo($id_modulo=0)
	{
		return $this->db->get_where('pl_modulos',array('id_modulo'=>$id_modulo,'activo'=>1))->row_array();
	}
	
	function obtener_personas($id_capacitacion=0,$id_modulo=0)
	{
		$this->db->select('b.*, c.*',false);
		$this->db->where("a.id_inscripcion_tema = b.id_inscripcion_tema");
		$this->db->where(" b.id_inscripcion_personas = c.id_inscripcion_personas",false,false);
		$personas= $this->db->order_by('b.apellidos')->get_where('inscripcion_temas a, inscripcion_temas_personas b, inscripcion_asistencia c',array('a.id_capacitacion'=>$id_capacitacion))->result_array();
		
		if($personas)
		{
			foreach($personas as $key_persona=>$una_persona)
			{
				$evaluaciones=$this->obtener_evaluaciones($id_modulo);
				$notas=array();
				foreach($evaluaciones as $eva)
				{
					$nota=$this->obtener_nota($id_modulo,$una_persona['id_inscripcion_personas'],$eva['id_eval_x_mod']);
					
					if(!$nota)
					{
						$this->db->insert("pl_modulos_notas",array(
							'id_modulo'=>$id_modulo,
							'id_inscripcion_persona'=>$una_persona['id_inscripcion_personas'],
							'id_eval_x_mod'=>$eva['id_eval_x_mod'],
							'nota'=>0.00
								));
						$nota=$this->obtener_nota($id_modulo,$una_persona['id_inscripcion_personas'],$eva['id_eval_x_mod']);
					}
					
					$notas[]=$nota;
				}
				
				$personas[$key_persona]['notas']=$notas;
			}
		}
		
		
		
		return $personas;
	}
	
	function obtener_nota($id_modulo,$id_inscripcion_personas,$id_eval_x_mod)
	{
		$nota=$this->db->select("a.*, b.porcentaje")->where("a.id_eval_x_mod = b.id_eval_x_mod and a.id_modulo = ".$id_modulo." and a.id_inscripcion_persona = ".$id_inscripcion_personas." and a.id_eval_x_mod = ".$id_eval_x_mod." ")->get("pl_modulos_notas a, pl_modulos_eval b")->row_array();
		return $nota;
	}
	
	
	function obtener_evaluaciones($id_modulo=0)
	{
		return $this->db->select("a.*, b.nombre_tipo_evaluacion",false)->where("a.id_tipo_evaluacion = b.id_tipo_evaluacion and a.id_modulo=".$id_modulo." and a.activo = 1 ")->order_by("a.id_eval_x_mod")->get('pl_modulos_eval a, mante_tipo_evaluacion b')->result_array();
	}
	
	function guardar_notas($notas=array(),$campo_id,$id_modulo)
	{
		if(is_array($notas))
		{
			foreach($notas as $key=>$nota)
			{
				$this->db->update("pl_modulos_notas",array('nota'=>$nota),array('id_nota_x_modulo'=>$key));
			}
		}
		$this->db->update("pl_modulos",array('puede_evaluar'=>0),array($campo_id=>$id_modulo));
		
	}
	
}