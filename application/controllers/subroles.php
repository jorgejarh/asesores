<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Subroles extends CI_Controller {

	public $datos_user=array();

	function __construct()
    {
        parent::__construct();

        $this->datos_user=comprobar_login();
        $this->load->model('conf_menu_model');

    }

	public function index()
	{
		
		$data['title']="Mantenimiento de Sub Roles";
		$data['template']="sistema";
		$data['contenido']="subroles/list";
		$data['listado']=$this->users_model->obtener_subroles();

		$this->load->view('template',$data);

	}
	
	public function nuevo()
	{
		$data=array();
		$data['roles']=preparar_select($this->users_model->obtener_roles(),'id_rol','rol');
		$data['menus']=$this->conf_menu_model->obtener_menus_completo();
		$this->load->view('subroles/form_nuevo',$data);
	}
	
	public function insertar()
	{
		$post=$this->input->post();
		if($post)
		{
						
			$guardar=$this->users_model->actualizar_subrol($post);

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
		
		$data['dato']=$this->users_model->obtener_subroles($id);
		$data['roles']=preparar_select($this->users_model->obtener_roles(),'id_rol','rol');
		$data['menus']=$this->conf_menu_model->obtener_menus_completo();
		$data['permisos']=$this->conf_menu_model->obtener_permisos($id);
		$this->load->view('subroles/form_editar',$data);
	}
	
	
	public function actualizar()
	{
		$post=$this->input->post();
		if($post)
		{
			$id=$post['id'];
			unset($post['id']);
						
			$resultado = $this->users_model->actualizar_subrol($post,$id);

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
			$resultado=$this->users_model->eliminar_subrol($id);
		}
		if($resultado)
		{
			echo "ok";
		}else{
			echo "error";
		}
	}
	
}