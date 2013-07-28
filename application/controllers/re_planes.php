<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Re_planes extends CI_Controller {

	public $datos_user=array();

	public $carpeta_view="re_planes";

	public $modelo_usar="re_planes_model";

	public $nombre_controlador="re_planes";
	
	public $nombre_titulo="Reportes";
	
	public $campos=array();
	
	
	
	
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
		$data['title']=$this->nombre_titulo;
		$data['template']="sistema";
		$data['contenido']=$this->carpeta_view."/lista";
		$data['cooperativas']=$this->$model->obtener_total_cooperativas();
		$data['model']=$model;
		$this->load->view('template',$data);

	}
	
	
}