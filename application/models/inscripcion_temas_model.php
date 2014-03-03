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
		
		$this->db->select("a.*, b.nombre_capacitacion, 
										IFNULL((select count(*) from inscripcion_temas_personas c where c.id_inscripcion_tema = a.id_inscripcion_tema ) ,0) as n_personas",false);
		
		$this->db->where("a.id_capacitacion = b.id_capacitacion");
		
		$this->db->where("a.id_usuario",$id);
		
		return $this->db->get_where($this->nombre_tabla." a, pl_capacitaciones b",array('a.activo'=>1))->result_array();
		
	}
	
	
	function actualizar($datos,$id)
	{
		
		$result= $this->db->update($this->nombre_tabla,$datos,array($this->id_tabla=>$id));
		
		return $result;
	}
	
	function nuevo($datos)
	{
		
		$cooperativa=$this->db->get_where('usu_coop_suc',array('id_usuario'=>$this->datos_user['id_usuario']))->row_array();
		
		
		$datos['id_cooperativa']=$cooperativa['id_cooperativa'];
		$datos['id_usuario']=$this->datos_user['id_usuario'];
		$datos['f_creacion']=date('Y-m-d H:i:s');
		
		$result= $this->db->insert($this->nombre_tabla,$datos);
		$id=$this->db->insert_id();
		
		return $id;
	}
	
	function nuevo_inscripcion($datos)
	{
		$datos['f_creacion']=date('Y-m-d H:i:s');
		
		$result= $this->db->insert($this->nombre_tabla,$datos);
		$id=$this->db->insert_id();
		
		return $id;
	}
	
	function eliminar($id)
	{
		$this->db->delete('inscripcion_temas_personas',array($this->id_tabla=>$id));
		return $this->db->delete($this->nombre_tabla,array($this->id_tabla=>$id));
	}
	
	function obtener_inscripcion($datos)
	{
		if($datos['tipo_persona']!="A")
		{
			$datos['id_cooperativa']=0;
		}
		$dato=$this->db->get_where($this->nombre_tabla,array('id_capacitacion'=>$datos['id_capacitacion'],'id_cooperativa'=>$datos['id_cooperativa']))->row_array();
		
		if(!$dato)
		{
			$usuario=$this->db->get_where("usu_coop_suc",array("id_cooperativa"=>$datos['id_cooperativa']))->row_array();
			if(!$usuario)
			{
				$id_user=0;
			}else{
				$id_user=$usuario['id_usuario'];
				}
			$id=$this->nuevo_inscripcion(array('id_usuario'=>$id_user,'id_capacitacion'=>$datos['id_capacitacion'],'id_cooperativa'=>$datos['id_cooperativa']));
			$dato=$this->obtener($id);
		}
		
		return $dato;
	}
	
	
}