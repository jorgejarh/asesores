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
			
			return $dato;
			}
	}
	
	function lista($id=0)
	{
		
		$this->db->select("a.*, b.nombre_capacitacion, b.precio_venta , 
										IFNULL((select count(*) from inscripcion_temas_personas c where c.id_inscripcion_tema = a.id_inscripcion_tema ) ,0) as n_personas",false);
		
		$this->db->where("a.id_capacitacion = b.id_capacitacion");
		
		$this->db->where("a.id_usuario",$id);
		
		return $this->db->get_where($this->nombre_tabla." a, pl_capacitaciones b",array('a.activo'=>1))->result_array();
		
	}
	
	
	function actualizar($datos,$id)
	{
		
		//$facilitadores=$datos['facilitadores'];
		//unset($datos['facilitadores']);
		
		$result= $this->db->update($this->nombre_tabla,$datos,array($this->id_tabla=>$id));
		
		//$this->db->delete('pl_modulo_facilitador',array('id_modulo'=>$id));
		
		/*foreach($facilitadores as $valor)
		{
			$this->db->insert('pl_modulo_facilitador',array('id_modulo'=>$id,'id_facilitador'=>$valor));
		}*/
		
		return $result;
	}
	
	function nuevo($datos)
	{
		//$facilitadores=$datos['facilitadores'];
		//unset($datos['facilitadores']);
		$datos['id_usuario']=$this->datos_user['id_usuario'];
		$datos['f_creacion']=date('Y-m-d H:i:s');
		$result= $this->db->insert($this->nombre_tabla,$datos);
		$id=$this->db->insert_id();
		/*foreach($facilitadores as $valor)
		{
			$this->db->insert('pl_modulo_facilitador',array('id_modulo'=>$id,'id_facilitador'=>$valor));
		}*/
		
		return $result;
	}
	
	function eliminar($id)
	{
		//return $this->db->update($this->nombre_tabla,array('activo'=>0),array($this->id_tabla=>$id));
		
		$this->db->delete('inscripcion_temas_personas',array($this->id_tabla=>$id));
		return $this->db->delete($this->nombre_tabla,array($this->id_tabla=>$id));
	}
	
}