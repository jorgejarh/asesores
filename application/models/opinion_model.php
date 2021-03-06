<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Opinion_model extends CI_Model {
	
	public $nombre_tabla="pl_opiniones";
	
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
			
			return $this->db->get_where($this->nombre_tabla." a",array('a.activo'=>1))->result_array();
		}else{
			return $this->db->get_where($this->nombre_tabla." a",array($this->id_tabla=>$id))->row_array();
			}
	}
	
	function lista($id=0)
	{
		$this->db->select("a.*, (select nombre_opinion from mante_opiniones b where a.mas_gusto = b.id_opinion) as nombre_gusto, (select nombre_opinion from mante_opiniones b where a.menos_gusto = b.id_opinion) as nombre_menos, (select nombre_opinion from mante_opiniones b where a.sugerencia = b.id_opinion) as nombre_sugerencia, (select nombre_opinion from mante_opiniones b where a.areas_capacitado = b.id_opinion) as nombre_areas");
		
		
		$datos=$this->db->get_where($this->nombre_tabla." a",array('a.activo'=>1,'a.id_modulo'=>$id))->result_array();
				
		return $datos;
	}
	
	function obtener_subrubros($id_rubro=0)
	{
		return $this->db->get_where("pl_subrubro a",array('a.id_rubro'=>$id_rubro))->result_array();
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
	
	
}