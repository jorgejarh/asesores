<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Roles extends CI_Controller {

	public $datos_user=array();

	function __construct()
    {
        parent::__construct();

        $this->datos_user=comprobar_login();

    }

	public function index()
	{
		
		$data['title']="Mantenimiento de Roles";
		$data['template']="sistema";
		$data['contenido']="roles/list_roles";
		$data['listado']=$this->users_model->obtener_roles();

		$this->load->view('template',$data);

	}
	
	public function nuevo()
	{
		$data=array();
		$data['tipos_usuarios']=preparar_select($this->users_model->obtener_tipos_usuarios(),'id_tipo_usuario','nombre_tipo_usuario');
		$this->load->view('roles/form_nuevo',$data);
	}
	
	public function insertar_rol()
	{
		$post=$this->input->post();
		if($post)
		{
						
			$guardar=$this->db->insert('usu_rol',$post);

			if($guardar)
			{
				echo "ok";
			}else{

				echo "Error al guardar el registro.";
			}

			
		}

	}
	
	public function editar($id=0)
	{
		
		$data['dato']=$this->users_model->obtener_roles($id);
		$data['tipos_usuarios']=preparar_select($this->users_model->obtener_tipos_usuarios(),'id_tipo_usuario','nombre_tipo_usuario');
		$this->load->view('roles/form_editar',$data);
	}
	
	
	public function editar_rol()
	{
		$post=$this->input->post();
		if($post)
		{
			$id=$post['id'];
			unset($post['id']);
						
			$resultado = $this->db->update('usu_rol',$post,array('id_rol'=>$id));

			if($resultado)
			{
				echo "ok";

			}else{
				echo "Error al actualizar el registro";
			}
		}
	}
	
	public function eliminar($id=0)
	{
		if ($id!=0)
		{
			//$resultado=$this->db->update('usu_usuario', array('estado'=>$this->input->post('activo')),array('id_usuario'=>$id));
			$resultado=$this->db->delete('usu_rol', array('id_rol'=>$id));
		}
		if($resultado)
		{
			echo "<h1>Registro Eliminado Correctamente</h1>";
		}else{
			echo "<h1>Error al eliminar el registro</h1>";
		}
	}
	
}