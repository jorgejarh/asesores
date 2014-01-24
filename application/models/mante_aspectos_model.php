<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Mante_aspectos_model extends CI_Model {
	
	public $nombre_tabla="mante_cat_resultado_aspectos";
	
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
			return $this->db->order_by($this->id_tabla,'ASC')->get_where($this->nombre_tabla,array('activo'=>1))->result_array();
		}else{
			return $this->db->get_where($this->nombre_tabla,array($this->id_tabla=>$id))->row_array();
			}
	}
	
	function lista($id=0)
	{
		
		return $this->db->order_by($this->id_tabla,'ASC')->get_where($this->nombre_tabla,array('activo'=>1,'id_mante_cat_resultado'=>$id))->result_array();
		
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
	}
	
	function obtener_por_modulo($id_modulo=0,$id_mante_cat_resultado)
	{
		return $this->db->order_by("a.".$this->id_tabla,'ASC')
						->where("b.id_aspecto = a.id_aspectos_considerar and b.id_modulo = ".$id_modulo)
						->get_where($this->nombre_tabla." a, pl_modulos_calificacion b ",array('a.activo'=>1,'a.id_mante_cat_resultado'=>$id_mante_cat_resultado))
						->result_array();
	}
	
}