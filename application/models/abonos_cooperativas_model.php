<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class abonos_cooperativas_model extends CI_Model {
	
	public $nombre_tabla="abonos_cooperativas";
	
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
			return $this->db->get_where($this->nombre_tabla,array('activo'=>1))->result_array();
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

	function obtener_temas( $id_cooperativa ){
		$this->db->select('d.id_capacitacion, d.nombre_capacitacion');
		$this->db->from('conf_cooperativa a');
		$this->db->join('usu_coop_suc b', 'a.id_cooperativa = b.id_cooperativa');
		$this->db->join('inscripcion_temas c', 'b.id_usuario = c.id_usuario');
		$this->db->join('pl_capacitaciones d', 'c.id_capacitacion = d.id_capacitacion');
		$this->db->where('a.id_cooperativa', $id_cooperativa);
		return $this->db->get()->result_array();
	}
	
}