<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Portal extends CI_Controller {

	public $datos_user=array();

	function __construct()
    {
        parent::__construct();
        $this->datos_user=comprobar_login();
    }

	public function index()
	{
		$data['title']="Bienvenido al Sistema";
		$data['template']="sistema";
		$data['contenido']="main";

		$data['listado']=$this->users_model->obtener_usuarios();
		
		$this->load->view('template',$data);
	}

	public function salir()
	{
		$this->session->unset_userdata('user');
		redirect('login');
	}

}

/* End of file users.php */
/* Location: ./application/controllers/users.php */