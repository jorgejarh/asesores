<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Mante_provee_ser_model extends CI_Model {
	
	public $nombre_tabla="mante_proveedores_servicio";
	
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
			$this->db->select("a.*, b.nombre_tipo",false);
			$this->db->where("a.id_tipo_proveedor = b.id_tipo_proveedor");
			return $this->db->get_where($this->nombre_tabla." a, mante_tipos_proveedores b",array('a.activo'=>1))->result_array();
		}else{
			return $this->db->get_where($this->nombre_tabla,array($this->id_tabla=>$id))->row_array();
			}
	}
	
	function actualizar($datos,$id)
	{
		return $this->db->update($this->nombre_tabla,$datos,array($this->id_tabla=>$id));
	}
	
	function nuevo($datos)
	{
		$datos['usuario_add']=$this->datos_user['id_usuario'];
		$datos['fecha_add']=date('Y-m-d H:i:s');
		return $this->db->insert($this->nombre_tabla,$datos);
	}
	
	function eliminar($id)
	{
		return $this->db->update($this->nombre_tabla,array('activo'=>0),array($this->id_tabla=>$id));
		//return $this->db->delete($this->nombre_tabla,array($this->id_tabla=>$id));
	}
	
	
}