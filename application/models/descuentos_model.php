<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Descuentos_model extends CI_Model {
	
	public $nombre_tabla="inscripcion_temas_descuentos";
	
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
			//$this->db->select("*, concat(nombres,' ',apellidos) as nombre_completo",false);
			return $this->db->select("a.id_descuento,b.cooperativa, a.descuento, d.nombre_capacitacion")->where("a.id_cooperativa = b.id_cooperativa and c.id_inscripcion_tema = a.id_inscripcion_tema and d.id_capacitacion = c.id_capacitacion")->get_where($this->nombre_tabla." a, conf_cooperativa b, inscripcion_temas c, pl_capacitaciones d",array('a.activo'=>1))->result_array();
		}else{
			return $this->db->get_where($this->nombre_tabla." a",array("a.".$this->id_tabla=>$id))->row_array();
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
	function obtener_inscripciones($id_cooperativa=0)
	{
		return $this->db->select("a.*, b.nombre_capacitacion")->where("b.id_capacitacion = a.id_capacitacion")->get_where("inscripcion_temas a, pl_capacitaciones b",array("a.activo"=>1,'a.id_cooperativa'=>$id_cooperativa))->result_array();
	}
	
	
}