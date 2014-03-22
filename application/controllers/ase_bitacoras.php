<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Ase_bitacoras extends CI_Controller {

	public $datos_user=array();

	public $carpeta_view="ase_bitacoras";

	public $nombre_controlador="ase_bitacoras";
	
	public $nombre_titulo="Bitacoras y Recomendaciones";
	
	public $campos=array();
	
	

	function __construct()
    {
        parent::__construct();
        $this->datos_user=comprobar_login();
        
		$this->load->model("ase_actividades_model");
		$this->load->model("ase_proyectos_model");
		$this->load->model("ase_servicios_model");	
    }

	public function index()
	{
		$data['title']=$this->nombre_titulo;
		$data['template']="sistema";
		$data['contenido']=$this->carpeta_view."/lista";
		$data['solicitantes']=preparar_select($this->ase_servicios_model->lista(),'id_servicio','nombre_solicitante');
		$this->load->view('template',$data);
		

	}
	
	public function obtener_proyectos()
	{
		$post=$this->input->post();
		if($post)
		{
			echo form_dropdown('id_proyecto',preparar_select($this->ase_proyectos_model->lista($post['id_servicio']),'id_proyecto','nombre_proyecto'));
		}
	}
	
	public function obtener_actividades()
	{
		$post=$this->input->post();
		if($post)
		{
			echo form_dropdown('id_actividad',preparar_select($this->ase_actividades_model->lista($post['id_proyecto']),'id_actividad','nombre_actividad'));
		}
	}
	
	
	
	
}