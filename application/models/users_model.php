<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Users_model extends CI_Model {

    function __construct()
    {
        parent::__construct();
    }

    function validar_usuario($user='',$password='')
    {
    	$datos=$this->db->get_where('usu_usuario',array(
    										'usuario'=>$user,
    										'clave'=>$password,
											'estado'=>1
    											)
    						)->row_array();
    	
    	if($datos)
    	{
			$datos['info_s']=$this->db->get_where('usu_coop_suc',array('id_usuario'=>$datos['id_usuario']))->row_array();
    		return $datos;
    	}else{

    		return false;
    	}

    	//echo $this->db->last_query();

    }

    function obtener_usuarios()
    {
    	return $this->db->get('usu_usuario')->result_array();
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
			$this->db->select("a.*, b.nombre_tipo_usuario");
			$this->db->where("a.id_tipo_usuario = b.id_tipo_usuario");
			return $this->db->get_where('usu_rol a, usu_tipo_usuario b', array('estado'=>1))->result_array();
			}
    }
	
	function obtener_subroles($id=0)
    {
		if($id!=0)
		{
        	return $this->db->get_where('usu_subrol',array('id_subrol'=>$id))->row_array();
		}else{
			$this->db->select("a.rol, b.*, c.nombre_tipo_usuario");
			$this->db->where("a.id_rol = b.id_rol and a.id_tipo_usuario = c.id_tipo_usuario");
			return $this->db->get_where('usu_rol a, usu_subrol b, usu_tipo_usuario c', array('b.estado'=>1))->result_array();
			}
    }
	
	function obtener_tipos_usuarios()
	{
		return $this->db->get_where('usu_tipo_usuario')->result_array();
	}
	
    function obtener_sub_roles($id_rol=0)
    {
        return $this->db->get_where('usu_subrol',array('estado'=>1,'id_rol'=>$id_rol))->result_array();
    }

    function obtener_cooperativas()
    {
        return $this->db->get_where('conf_cooperativa',array('activo'=>1))->result_array();
    }
    function obtener_sucursales($id_cooperativa)
    {
        return $this->db->get_where('conf_sucursal',array('id_cooperativa'=>$id_cooperativa))->result_array();
    }
	
	
	function obtener_menu($id_subrol=0)
	{
		
		
		//return $this->db->get_where('conf_menu',array('id_padre'=>0,'activo'=>1))->result_array();
		
		return $this->db->query("SELECT 
                                    menu.id_menu,
                                    nombre_menu,
                                    url,
									target
                                FROM
                                    usu_subrol AS subrol,
                                    usu_permisos_menu AS permisos,
                                    conf_menu AS menu
                                WHERE
                                    subrol.id_subrol = ".$id_subrol."
                                    AND permisos.id_subrol = subrol.id_subrol
                                    AND menu.id_menu = permisos.id_menu
                                    AND activo = 1
                                    AND id_padre = 0 order by menu.id_menu")->result_array();
	}
	
	function obtener_menus_por_id_padre($id_menu=0,$id_subrol=0)
	{
		//return $this->db->get_where('conf_menu',array('id_padre'=>$id_menu,'activo'=>1))->result_array();
		
		
		return $this->db->query("SELECT 
                                    menu.id_menu,
                                    nombre_menu,
                                    url,target
                                FROM
                                    usu_subrol AS subrol,
                                    usu_permisos_menu AS permisos,
                                    conf_menu AS menu
                                WHERE
                                    subrol.id_subrol = ".$id_subrol."
                                    AND permisos.id_subrol = subrol.id_subrol
                                    AND menu.id_menu = permisos.id_menu
                                    AND activo = 1
                                    AND id_padre = ".$id_menu." order by menu.orden ASC")->result_array();
	}
	
	
	function actualizar_subrol($post,$id=0)
	{
		if(isset($post['permisos']))
		{
			$permisos=$post['permisos'];
		}else{
			$permisos=array();
			}
        
        unset($post['permisos']);

		if($id==0)
		{

			$resultado=$this->db->insert('usu_subrol',$post);
            $id=$this->db->insert_id();

             $this->db->delete('usu_permisos_menu',array('id_subrol'=>$id));
            
            if($permisos)
            {
                foreach($permisos as $id_menu)
                {
                    
                    $data_permisos=array(
                        'id_subrol'=>$id,
                        'id_menu'=>$id_menu
                        );
                    $this->db->insert('usu_permisos_menu',$data_permisos);
                }
            }

            return $resultado;


		}else{

            $this->db->delete('usu_permisos_menu',array('id_subrol'=>$id));
            
            if($permisos)
            {
                foreach($permisos as $id_menu)
                {
                    
                    $data_permisos=array(
                        'id_subrol'=>$id,
                        'id_menu'=>$id_menu
                        );
                    $this->db->insert('usu_permisos_menu',$data_permisos);
                }
            }
            

			return $this->db->update('usu_subrol',$post,array('id_subrol'=>$id));
			}
	}
	
	function eliminar_subrol($id)
	{
		//$this->db->delete('usu_rol', array('id_rol'=>$id));
		
		return  $this->actualizar_subrol(array('estado'=>0),$id);
	}


    function cambiar_pass( $post = '' ){

        $id_usuario = $post['id_usuario'];
        unset( $post['id_usuario'] );
        unset( $post['confirma_clave'] );

        $this->db->where('id_usuario', $id_usuario);
        $this->db->update('usu_usuario', $post); 
    }
    
	function cambiar_contrasena( $post=array() ){

        $id_usuario = $post['id_usuario'];
        unset( $post['id_usuario'] );

        $this->db->where('id_usuario', $id_usuario);
        $this->db->update('usu_usuario', $post); 
    }
	
	
	
}
