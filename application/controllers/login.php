<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Login extends CI_Controller {
	
	public function index()
	{

		$data['title']="Entrada al sistema";
		$data['template']="login";
		$data['contenido']="login/index";
		$data['error']=array();
		
		if($this->input->post('entrar'))
		{
			// si viene post
			$datos_post=$this->input->post();
			
			$buscar_usuario=$this->users_model->validar_usuario($datos_post['user'],md5($datos_post['pass']));

			if($buscar_usuario)
			{
				$this->session->set_userdata('user',$buscar_usuario);
				
				$this->users_model->actualizar_acceso($buscar_usuario['id_usuario']);

				redirect('portal');

			}else{
				
				$data['error'][]="Usuario o Contraseña Invalida";
				
				$this->load->view('template',$data);
			}

		}else{

			$this->load->view('template',$data);
		}

		

	}
}

/* End of file users.php */
/* Location: ./application/controllers/users.php */