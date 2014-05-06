<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Notas_cargo extends CI_Controller {
	
	
	public $datos_user=array();

	public $carpeta_view="notas_cargo";

	public $modelo_usar="notas_cargo_model";

	public $nombre_controlador="notas_cargo";
	
	public $nombre_titulo="Notas de cargo";

	function __construct()
    {
        parent::__construct();
        $this->datos_user=comprobar_login();
		$this->load->model($this->modelo_usar);
    }

	public function index()
	{
		$model=$this->modelo_usar;
		$data['title']=$this->nombre_titulo;
		$data['template']="sistema";
		$data['contenido']=$this->carpeta_view."/lista";
		$data['listado']=$this->$model->obtener_cooperativas($this->datos_user['info_s']);
		$this->load->view('template',$data);

	}
		
	public function capacitaciones($id_cooperativa=0)
	{
		$model=$this->modelo_usar;
		
		$this->load->model("cooperativa_model");
		$data['cooperativa']=$this->cooperativa_model->obtener_cooperativa($id_cooperativa);
		if($data['cooperativa'])
		{
			$this->load->model("inscripcion_temas_model");
			$data['title']=$this->nombre_titulo." - Capacitaciones - ".$data['cooperativa']['cooperativa'];
			$data['inscripciones']=$this->inscripcion_temas_model->lista_x_cooperativa($id_cooperativa);
			$data['contenido']=$this->carpeta_view."/capacitaciones";
			$data['template']="sistema";
			$this->load->view('template',$data);
			
		}else{
			redirect($this->nombre_controlador);
			}
		
	}
	
	
	public function ver_nota_cargo($id_inscripcion_tema=0)
	{
		$model=$this->modelo_usar;
		$this->load->model("inscripcion_temas_model");
		
		$data['inscripcion_tema']=$this->inscripcion_temas_model->obtener($id_inscripcion_tema);
		if($data['inscripcion_tema'])
		{
			$this->load->model("cooperativa_model");
			$this->load->model("pl_capacitaciones_model");
			$this->load->model("inscripcion_temas_personas_model");
			
			$data['cooperativa']=$this->cooperativa_model->obtener_cooperativa($data['inscripcion_tema']['id_cooperativa']);
			$data['capacitacion']=$this->pl_capacitaciones_model->obtener($data['inscripcion_tema']['id_capacitacion']);
			$data['personas']=$this->inscripcion_temas_personas_model->lista($id_inscripcion_tema);
			$this->load->view($this->carpeta_view."/ver_nota_cargo",$data);
			
		}else{
			redirect($this->nombre_controlador);
			}
	}
	
}