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
		
	function abonar($id_cooperativa=0)
	{
		$model=$this->modelo_usar;
		
		$this->load->model("cooperativa_model");
		$data['cooperativa']=$this->cooperativa_model->obtener_cooperativa($id_cooperativa);
		if($data['cooperativa'])
		{
			$this->load->model("inscripcion_temas_model");
			$data['title']=$this->nombre_titulo." - ".$data['cooperativa']['cooperativa'];
			$data['lista']=$this->$model->lista($id_cooperativa);
			$data['contenido']=$this->carpeta_view."/abonar";
			$data['template']="sistema";
			$this->load->view('template',$data);
			
		}else{
			redirect($this->nombre_controlador);
			}
	}
	function nuevo($id_cooperativa=0)
	{
		$model=$this->modelo_usar;
		$this->load->model("cooperativa_model");
		$data['cooperativa']=$this->cooperativa_model->obtener_cooperativa($id_cooperativa);
		if($data['cooperativa'])
		{
			$post=$this->input->post();
			if($post)
			{
				unset($post['enviar']);
				$this->$model->nuevo($post);
				redirect($this->nombre_controlador."/abonar/".$id_cooperativa);
			}
			
			$data['title']=$this->nombre_titulo." - ".$data['cooperativa']['cooperativa'];
			$data['contenido']=$this->carpeta_view."/nuevo";
			$data['modulos']=$this->$model->obtener_modulos_x_cooperativa($id_cooperativa);
			
			$data['template']="sistema";
			$this->load->view('template',$data);
			
		}else{
			redirect($this->nombre_controlador);
			}
	}
	
}