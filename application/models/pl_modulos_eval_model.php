<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Pl_modulos_eval_model extends CI_Model {
	
	public $nombre_tabla="pl_modulos_eval";
	
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
			
			return $this->db->select("a.*, b.nombre_tipo_evaluacion")->where("a.id_tipo_evaluacion = b.id_tipo_evaluacion")->get_where($this->nombre_tabla." a, mante_tipo_evaluacion b",array('a.activo'=>1))->result_array();
		}else{
			
			$dato=$this->db->get_where($this->nombre_tabla,array($this->id_tabla=>$id))->row_array();
			
						
			
			return $dato;
			}
	}
	
	function lista($id=0)
	{
		return $this->db->select("a.*, b.nombre_tipo_evaluacion ",false)->where("a.id_tipo_evaluacion = b.id_tipo_evaluacion")->get_where($this->nombre_tabla." a, mante_tipo_evaluacion b",array('a.activo'=>1,'a.id_modulo'=>$id))->result_array();
		
	}
	
	function obtener_sum_porcentaje($id_modulo=0)
	{
		
		$resultado=$this->db->select("SUM(a.porcentaje) as suma ",false)->get_where($this->nombre_tabla." a",array('a.activo'=>1,'a.id_modulo'=>$id_modulo))->row_array();
		
		return $resultado["suma"];
		
	}
	
	function validar_existente($id_tipo_evaluacion,$id_modulo)
	{
		$resultado=$this->db->get_where($this->nombre_tabla." a",array('a.activo'=>1,'a.id_modulo'=>$id_modulo,'a.id_tipo_evaluacion'=>$id_tipo_evaluacion))->row_array();
		if($resultado)
		{
			return true;
		}else{
			return false;
			}
	}
	
	function validar_existente_editar($id_tipo_evaluacion,$id_modulo,$id=0)
	{
		$resultado=$this->db->get_where($this->nombre_tabla." a",array('a.activo'=>1,'a.id_modulo'=>$id_modulo,'a.id_tipo_evaluacion'=>$id_tipo_evaluacion,$this->id_tabla." !="=>$id))->row_array();
		if($resultado)
		{
			return true;
		}else{
			return false;
			}
	}
		
	function nuevo($datos)
	{
		
		$datos['id_usuario']=$this->datos_user['id_usuario'];
		$datos['f_creacion']=date('Y-m-d H:i:s');
		$result= $this->db->insert($this->nombre_tabla,$datos);
		return $result;
	}
	
	function eliminar($id)
	{
		return $this->db->update($this->nombre_tabla,array('activo'=>0),array($this->id_tabla=>$id));
		//return $this->db->delete($this->nombre_tabla,array($this->id_tabla=>$id));
	}
	function actualizar($datos,$id)
	{
		return $this->db->update($this->nombre_tabla,$datos,array($this->id_tabla=>$id));
	}
		
}