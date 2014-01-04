<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Evaluar_capacitaciones extends CI_Controller {

	public $datos_user=array();

	public $carpeta_view="evaluar_capacitaciones";

	public $modelo_usar="evaluar_capacitaciones_model";

	public $nombre_controlador="evaluar_capacitaciones";
	
	public $nombre_titulo="Evaluar Capacitaciones";
	
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
		$data['listado']=preparar_select($this->$model->obtener_planes(),'id_plan','nombre_plan');
		$data['model']=$model;
		$this->load->view('template',$data);

	}
	
	
	public function obtener_modalidades()
	{
		echo "<p>Seleccione una modalidad</p>";
		$model=$this->modelo_usar;
		$listado=preparar_select($this->$model->obtener_modalidades($this->input->post('id_plan')),'id_plan_modalidad','nombre_modalidad');
		$listado[0]=".: Seleccione:.";
		  ksort($listado);
		echo form_dropdown('',$listado,0,'id="id_plan_modalidad"');
	}
	
	
	public function obtener_capacitaciones()
	{
		echo "<p>Seleccione una capacitación</p>";
		$model=$this->modelo_usar;
		$listado=preparar_select($this->$model->obtener_capacitaciones($this->input->post('id_plan_modalidad')),'id_capacitacion','nombre_capacitacion');
		  ksort($listado);
		echo form_dropdown('',$listado,0,'id="id_capacitacion"');
		echo '<div><button onclick="evaluar_capacitacion();">Evaluar capacitacion</button></div>';
	}
	
	public function inscribir_modulo($id_modulo=0)
	{
		$model=$this->modelo_usar;
		
		$data['modulo']=$this->$model->obtener_modulo($id_modulo);
		
		if($data['modulo'])
		{
			$data['mensaje']="";
			
			$post=$this->input->post();
			
			if($post)
			{
				$this->$model->guardar_asistencia($post,$data['modulo']);
				
				$data['mensaje']="Datos Guardados.";
			}
			
			if(isset($post['id_personas']))
			{
				
				
			}
			
			$data['title']="Inscripcion al modulo ".$data['modulo']['nombre_modulo'];
			$data['template']="sistema";
			$data['contenido']=$this->carpeta_view."/inscribir_modulo";
			$data['nombres_personas']=$this->$model->obtener_personas($data['modulo']['id_capacitacion'],$id_modulo);
			
			$data['model']=$model;
			$this->load->view('template',$data);
			
		}else{
			
			redirect(site_url());
			}
		
		
	}
	
	
}