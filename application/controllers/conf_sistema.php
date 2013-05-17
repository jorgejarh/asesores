<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Conf_sistema extends CI_Controller {

	public $datos_user=array();

	function __construct()
    {
        parent::__construct();

        $this->datos_user=comprobar_login();

    }

	public function index()
	{
		
		$data['title']="Crear Respaldo de Datos";
		$data['template']="sistema";
		$data['contenido']="conf_sistema/index";
		
		//$data['listado']=$this->users_model->obtener_usuarios();

		$this->load->view('template',$data);

	}
}