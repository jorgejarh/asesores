<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Reporte_general_model extends CI_Model {

    function __construct()
    {
        parent::__construct();
    }
	
	function obtener_reporte($datos=array())
	{
		$this->db->select("'Capacitación' as servicio, 
							b.cooperativa, 
							d.nombre_modulo, 
							(select count(e.id_inscripcion_tema) from inscripcion_temas_personas e, inscripcion_asistencia f where e.id_inscripcion_tema = a.id_inscripcion_tema and f.id_inscripcion_personas = e.id_inscripcion_personas and f.id_modulo = d.id_modulo and f.aprobado = 1) * d.precio_venta as total,
							ifnull((select SUM(h.cantidad) from abono_x_cooperativa g, abono_x_cooperativa_detalle h where g.id_cooperativa = a.id_cooperativa and h.id_nota_cargo = g.id_abono and h.id_modulo = d.id_modulo),0) as pagado
							
							",false);
							
		$this->db->where("a.id_cooperativa = b.id_cooperativa and 
							c.id_capacitacion = a.id_capacitacion and 
							d.id_capacitacion = c.id_capacitacion");
		return $this->db->get_where("inscripcion_temas a, 
									conf_cooperativa b, 
									pl_capacitaciones c, 
									pl_modulos d")->result_array();
	}
	
}
