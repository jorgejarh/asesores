<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Plan_model extends CI_Model {

    function __construct()
    {
        parent::__construct();
    }

    function validar_usuario($user='',$password='')
    {
    	$datos=$this->db->get_where('usu_usuario',array(
    										'usuario'=>$user,
    										'clave'=>$password
    											)
    						)->row_array();
    	
    	if($datos)
    	{
    		return $datos;
    	}else{

    		return false;
    	}

    	//echo $this->db->last_query();

    }

    function obtener_planes()
    {
    	return $this->db->get('pl_plan')->result_array();
    }

    function actualizar_acceso($id_user=0)
    {
        $this->db->update('usu_usuario',array(
                                        'ultimo_acceso'=>date('Y-m-d H:i:s')
                                            ),
                                        array(
                                        'id_usuario'=>$id_user
                                            )
                            );
    }

function obtener_datos_usuario($id)
    {
        return $this->db->get_where('usu_usuario', "id_usuario = ".$id)->row_array();
    }




    function obtener_modulos()
    {

        return $this->db->get('conf_modulo')->result_array();

    }

    function obtener_opciones($id_subrol,$id_modulo)
    {
        return $this->db->query("SELECT 
                                  a.`id_permisos`,
                                  b.* 
                                FROM
                                  `usu_permisos` a,
                                  `conf_opcion` b,
                                  `conf_modulo` c 
                                WHERE a.`id_subrol` = ".$id_subrol." 
                                  AND b.`id_modulo` = ".$id_modulo." 
                                  AND a.`id_opcion` = b.`id_opcion` 
                                  AND c.`id_modulo` = b.`id_modulo` 
                                  AND a.`estado` = 1 
                                  AND b.`estado` = 1 
                                ORDER BY c.`orden` ASC ")->result_array();
    }

    function obtener_roles($id=0)
    {
		if($id!=0)
		{
        	return $this->db->get_where('usu_rol',array('id_rol'=>$id))->row_array();
		}else{
			return $this->db->get_where('usu_rol', array('estado'=>1))->result_array();
			}
    }

    function obtener_sub_roles($id_rol)
    {
        return $this->db->get_where('usu_subrol',array('estado'=>1,'id_rol'=>$id_rol))->result_array();
    }

    function obtener_cooperativas()
    {
        return $this->db->get('conf_cooperativa')->result_array();
    }
    function obtener_sucursales($id_cooperativa)
    {
        return $this->db->get_where('conf_sucursal',array('id_cooperativa'=>$id_cooperativa))->result_array();
    }
}
