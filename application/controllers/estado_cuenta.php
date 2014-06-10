<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Estado_cuenta extends CI_Controller {

	public $datos_user=array();

	function __construct()
    {
        parent::__construct();
        $this->datos_user=comprobar_login();
		$this->load->model('estado_cuenta_model');
    }

	public function index()
	{
		
		$data['title']="Estado de cuentas";
		$data['template']="sistema";
		$data['contenido']="estado_cuenta/lista";
		$data['listado']=$this->estado_cuenta_model->obtener_cooperativas($this->datos_user['info_s']);
		$data['lista']=preparar_select($this->estado_cuenta_model->obtener_cooperativas($this->datos_user['info_s']),'id_cooperativa','cooperativa');
		$this->load->view('template',$data);

	}
	public function ver($id_cooperativa=0)
	{
		$data['titulo']="Imprimir";
		$data['cooperativa']=$this->estado_cuenta_model->obtener_una_cooperativa($id_cooperativa);
		if($data['cooperativa'])
		{
			$data['inscripciones']=$this->estado_cuenta_model->obtener_inscripciones_x_cooperativa($id_cooperativa);
			
			//echo $this->db->last_query();
			$this->load->view('estado_cuenta/ver',$data);
		}
		
	}
	
	public function ver_total($id_cooperativa=0)
	{
		$data['titulo']="Imprimir";
		$data['cooperativa']=$this->estado_cuenta_model->obtener_una_cooperativa($id_cooperativa);
		if($data['cooperativa'])
		{
			$data['modulos']=$this->estado_cuenta_model->obtener_estado_x_cooperativa($id_cooperativa);
			
			//echo $this->db->last_query();
			$this->load->view('estado_cuenta/ver_total',$data);
		}
		
	}
	
	public function generar_resultado()
	{
		$post=$this->input->post();
		$data['cooperativa']=$this->estado_cuenta_model->obtener_una_cooperativa($post['id_cooperativa']);
		if($data['cooperativa'])
		{
			$data['modulos']=$this->estado_cuenta_model->obtener_estado_x_cooperativa($post['id_cooperativa']);
			$this->load->view('estado_cuenta/generar',$data);
		}
	}
	
}