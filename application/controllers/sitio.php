<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Sitio extends CI_Controller {
	
	function __construct()
    {
        parent::__construct();
		$this->load->model('sitio_model');
    }
	
	public function index()
	{
		$data['imagenes']=$this->sitio_model->obtener_imagenes_slider();
		$data['capacitaciones']=$this->sitio_model->obtener_capacitaciones();
		$data['title']="Entrada al sistema";
		$data['vista']="inicio";
		$this->load->view('contenido_sitio/template/template',$data);
	}
	
	public function login()
	{
		$json=array();
		
		if($this->input->post())
		{
			// si viene post
			$datos_post=$this->input->post();
			
			$buscar_usuario=$this->users_model->validar_usuario($datos_post['user'],md5($datos_post['pass']));

			if($buscar_usuario)
			{
				$this->session->set_userdata('user',$buscar_usuario);
				
				$this->users_model->actualizar_acceso($buscar_usuario['id_usuario']);

				$json['error']=false;
				$json['url']=site_url('portal');
			}else{
				
				$json['error']=true;
				$json['mensaje']="Usuario o Contraseña Invalida";
			}
			
			echo json_encode($json);
		}

		
	}
}

/* End of file users.php */
/* Location: ./application/controllers/users.php */