<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Pago_abono extends CI_Controller {
	
	
	public $datos_user=array();

	public $carpeta_view="pago_abono";

	public $modelo_usar="pago_abono_model";

	public $nombre_controlador="pago_abono";
	
	public $nombre_titulo="Abonos";

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
	
	public function modulos($id_inscripcion_tema=0)
	{
		$model=$this->modelo_usar;
		
		$this->load->model("inscripcion_temas_model");
		$data['inscripcion']=$this->inscripcion_temas_model->obtener($id_inscripcion_tema);
		if($data['inscripcion'])
		{
			
			$this->load->model("cooperativa_model");
			$this->load->model("pl_modulos_model");
			$data['cooperativa']=$this->cooperativa_model->obtener_cooperativa($data['inscripcion']['id_cooperativa']);
			
			$data['title']=$this->nombre_titulo." - Modulos inscritos - ".$data['cooperativa']['cooperativa'];
			
			$data['modulos']=$this->pl_modulos_model->lista($data['inscripcion']['id_capacitacion']);
			
			foreach($data['modulos'] as $key=>$valor)
			{
				$data['modulos'][$key]['info']=$this->$model->obtener_info_modulo($valor['id_modulo'],$id_inscripcion_tema);
				$data['modulos'][$key]['pre_inscritos']=count($data['modulos'][$key]['info']);
				$data['modulos'][$key]['asistencia']=$this->_obtener_cantidad_asistencia($data['modulos'][$key]['info']);
			}
			
			$data['contenido']=$this->carpeta_view."/modulos";
			$data['template']="sistema";
			$this->load->view('template',$data);
			
		}else{
			redirect($this->nombre_controlador);
			}
		
	}
	
	public function _obtener_cantidad_asistencia($datos=array())
	{
		$conta=0;
		foreach($datos as $val)
		{
			if($val['aprobado']==1)
			{
				$conta++;
			}
		}
		return $conta;
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
	
	public function ver_nota_cargo_modulo($id_cooperativa=0,$id_modulo=0,$id_inscripcion_tema=0)
	{
		$model=$this->modelo_usar;
		$this->load->model("inscripcion_temas_model");
		
		$data['inscripcion_tema']=$this->inscripcion_temas_model->obtener($id_inscripcion_tema);
		if($data['inscripcion_tema'])
		{
			$this->load->model("cooperativa_model");
			$this->load->model("pl_capacitaciones_model");
			$this->load->model("pl_modulos_model");
			$this->load->model("inscripcion_temas_personas_model");
			
			$data['cooperativa']=$this->cooperativa_model->obtener_cooperativa($data['inscripcion_tema']['id_cooperativa']);
			$data['capacitacion']=$this->pl_capacitaciones_model->obtener($data['inscripcion_tema']['id_capacitacion']);
			$data['modulo']=$this->pl_modulos_model->obtener($id_modulo);
			$data['personas']=$this->$model->obtener_info_modulo($id_modulo,$id_inscripcion_tema,1);
			$this->load->view($this->carpeta_view."/ver_nota_cargo_modulo",$data);
			
		}else{
			redirect($this->nombre_controlador);
			}
	}
	
}