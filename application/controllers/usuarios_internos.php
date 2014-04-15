<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Usuarios_internos extends CI_Controller {

	public $datos_user=array();

	public $carpeta_view="usuarios_internos";

	public $modelo_usar="usuarios_internos_model";

	public $nombre_controlador="usuarios_internos";

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
			//$this->form_validation->set_rules('clave','Contraseña',"required|matches[clave2]|xss_clean|min_length[6]");
			$this->form_validation->set_rules('correo','Email',"valid_email|xss_clean");



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
		$model=$this->modelo_usar;
		$data['subroles']=preparar_select($this->$model->obtener_subroles(),'id_subrol','subrol');
				
		$data['dato']=$this->$model->obtener_registro($id);

		if($data['dato'])
		{
			$this->load->view($this->carpeta_view.'/form_editar',$data);
		}else{
			redirect($this->nombre_controlador);

		}

		
	}
	
	
	public function actualizar()
	{
		$post=$this->input->post();
		$model=$this->modelo_usar;
		if($post)
		{
			$id=$post['id'];
			unset($post['id']);
						
			$json=array();
			$this->form_validation->set_rules('nombre_completo','Nombre Completo',"required|xss_clean");
			$this->form_validation->set_rules('telefono','Telefono',"required|xss_clean");

			if($post['usuario']!=$post['user'])
			{
				$this->form_validation->set_rules('usuario','Usuario',"required|is_unique[usu_usuario.usuario]|xss_clean");
			}

			if($post['clave']!="")
			{
				$this->form_validation->set_message('matches',"Las contraseñas no coinciden");
				//$this->form_validation->set_rules('clave','Contraseña',"required|matches[clave2]|xss_clean|min_length[6]");
			}else{
				unset($post['clave']);
			}
			
			if($this->form_validation->run()==TRUE)
			{
				

				$resultado=$this->$model->insertar($post,$id);

				$json['error']=false;


			}else{

				$json['error']=true;
				$json['mensaje']=traer_errores_form();
			}


			echo json_encode($json);
		}
	}
	
	public function eliminar($id=0)
	{
		$model=$this->modelo_usar;
		$post=$this->input->post();
		if ($id!=0)
		{
			//$resultado=$this->db->update('usu_usuario', array('estado'=>$this->input->post('activo')),array('id_usuario'=>$id));
			$resultado= $this->$model->eliminar($id,$post);
		}
	}

}