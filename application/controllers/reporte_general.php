<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Reporte_general extends CI_Controller {

	public $datos_user=array();

	function __construct()
    {
        parent::__construct();
        $this->datos_user=comprobar_login();
		$this->load->model('reporte_general_model');
    }

	public function index()
	{
		
		$data['title']="Reporte";
		$data['template']="sistema";
		$data['contenido']="reporte_general/lista";
		$data['listado']=$this->reporte_general_model->obtener_reporte($this->datos_user['info_s']);
		
		$this->load->view('template',$data);

	}

	
}