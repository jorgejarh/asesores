<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Control_ofertas_model extends CI_Model {
	
	public $nombre_tabla="ofertas_lista";
	
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
			$this->db->select("a.*, b.nombre_capacitacion, c.cooperativa, d.nombre as nombre_servicio, e.nombre as nombre_resolucion, f.nombre as nombre_estado ");
			$this->db->where("a.id_capacitacion = b.id_capacitacion and a.id_cooperativa = c.id_cooperativa and d.id_servicio = a.id_servicio and a.id_resolucion = e.id_resolucion and a.id_estado = f.id_estado");
			return $this->db->get_where($this->nombre_tabla." a, pl_capacitaciones b, conf_cooperativa c, ofertas_servicios d, ofertas_resolucion e, ofertas_estados f",array('a.activo'=>1))->result_array();
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
		$datos['id_usuario']=$this->datos_user['id_usuario'];
		$datos['f_creacion']=date('Y-m-d H:i:s');
		return $this->db->insert($this->nombre_tabla,$datos);
	}
	
	function eliminar($id)
	{
		return $this->db->update($this->nombre_tabla,array('activo'=>0),array($this->id_tabla=>$id));
		//return $this->db->delete($this->nombre_tabla,array($this->id_tabla=>$id));
	}
	
	
	function servicios()
	{
		return $this->db->get("ofertas_servicios")->result_array();
	}
	
	function obtener_resoluciones()
	{
		return $this->db->get("ofertas_resolucion")->result_array();
	}
	
	function obtener_estados()
	{
		return $this->db->get("ofertas_estados")->result_array();
	}
	
}