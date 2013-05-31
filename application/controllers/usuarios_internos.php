<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Usuarios_internos extends CI_Controller {

	public $datos_user=array();

	public $carpeta_view="usuarios_internos";

	public $modelo_usar="usuarios_internos_model";

	public $nombre_controlador="Usuarios_internos";

	function __construct()
    {
        parent::__construct();
        $this->datos_user=comprobar_login();
        $model=$this->modelo_usar;
		$this->load->model($model);

    }

	public function index()
	{
		$model=$this->modelo_usar;
		$data['title']="Gestion de Usuarios Internos";
		$data['template']="sistema";
		$data['contenido']=$this->carpeta_view."/lista";
		$data['listado']=$this->$model->obtener_lista();
		
		$this->load->view('template',$data);

	}
	
	public function nuevo()
	{
		$model=$this->modelo_usar;
		$data=array();
		$data['subroles']=preparar_select($this->$model->obtener_subroles(),'id_subrol','subrol');
		//print_r($data['menus']);
		
		$this->load->view($this->carpeta_view.'/form_nuevo',$data);
	}
	
	public function insertar()
	{
		$model=$this->modelo_usar;
		$post=$this->input->post();
		if($post)
		{
			$json=array();
			$this->form_validation->set_rules('nombre_completo','Nombre Completo',"required|xss_clean");
			$this->form_validation->set_rules('telefono','Telefono',"required|xss_clean");
			$this->form_validation->set_rules('usuario','Usuario',"required|is_unique[usu_usuario.usuario]|xss_clean");
			$this->form_validation->set_message('matches',"Las contraseñas no coinciden");
			$this->form_validation->set_rules('clave','Contraseña',"required|matches[clave2]|xss_clean");


			if($this->form_validation->run()==TRUE)
			{
				
				//$json['mensaje']=print_r($post,true);

				$resultado=$this->$model->insertar($post);

				$json['error']=false;


			}else{

				$json['error']=true;
				$json['mensaje']=traer_errores_form();
			}


			echo json_encode($json);

		}

	}
	
	public function editar($id=0)
	{
		$data['menus']=preparar_select($this->conf_menu_model->obtener_menus(),'id_menu','nombre_menu');
		$data['menus'][0]="--Sin Padre--";
		ksort($data['menus']);
		
		$data['dato']=$this->conf_menu_model->obtener_info_menu($id);
		$this->load->view('conf_menu/form_editar',$data);
	}
	
	
	public function editar_datos()
	{
		$post=$this->input->post();
		if($post)
		{
			$id=$post['id'];
			unset($post['id']);
						
			$resultado = $this->conf_menu_model->actualizar_menu($post,$id);

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
			$resultado= $this->conf_menu_model->eliminar($id);
		}
		if($resultado)
		{
			echo "ok";
		}else{
			echo "error";
		}
	}

}