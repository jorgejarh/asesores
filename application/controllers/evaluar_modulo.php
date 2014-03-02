<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Evaluar_modulo extends CI_Controller {

	public $datos_user=array();

	public $carpeta_view="evaluar_modulo";

	public $modelo_usar="evaluar_modulo_model";

	public $nombre_controlador="evaluar_modulo";
	
	public $nombre_titulo="Evaluar Modulo";
	
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
		echo "<p>Seleccione un tema</p>";
		$model=$this->modelo_usar;
		$listado=preparar_select($this->$model->obtener_capacitaciones($this->input->post('id_plan_modalidad')),'id_capacitacion','nombre_capacitacion');
		$listado[0]=".: Seleccione:.";
		  ksort($listado);
		echo form_dropdown('',$listado,0,'id="id_capacitacion"');
	}
	
	
	public function obtener_modulos()
	{
		echo "<p>Seleccione el modulo a evaluar</p>";
		$model=$this->modelo_usar;
		$listado=preparar_select($this->$model->obtener_modulos($this->input->post('id_capacitacion')),'id_modulo','nombre_modulo');
		/*$listado[0]=".: Seleccione:.";
		  ksort($listado);*/
		echo form_dropdown('',$listado,0,'id="id_modulo"');
		echo '<div><button onclick="evaluar_modulo();">Evaluar modulo</button></div>';
	}
	
	public function evaluar($id_modulo=0)
	{
		$model=$this->modelo_usar;
		
		$data['modulo']=$this->$model->obtener_modulo($id_modulo);
		
		if($data['modulo'])
		{
			$this->load->model("pl_capacitaciones_model");
			$this->load->model("pl_modalidades_model");
			
			$data['capacitacion']=$this->pl_capacitaciones_model->obtener($data['modulo']['id_capacitacion']);
			$data['modalidad']=$this->pl_modalidades_model->obtener($data['capacitacion']['id_plan_modalidad']);
			
			
			$data['mensaje']="";
			
			$notas=$this->input->post('notas');
			
			if($notas)
			{
				$this->load->model("pl_modulos_model");
				$this->$model->guardar_notas($notas,$this->pl_modulos_model->id_tabla,$id_modulo);
				$data['mensaje']="Notas Actualizadas Correctamente.";
				$data['modulo']=$this->$model->obtener_modulo($id_modulo);
			}
			
			
			$data['title']="Evaluación al modulo ".$data['modulo']['nombre_modulo'];
			$data['template']="sistema";
			$data['contenido']=$this->carpeta_view."/evaluar_modulo";
			$data['nombres_personas']=$this->$model->obtener_personas($data['modulo']['id_capacitacion'],$id_modulo);
			$data['evaluaciones']=$this->$model->obtener_evaluaciones($id_modulo);
			$data['model']=$model;
			$this->load->view('template',$data);
			
		}else{
			
			redirect(site_url());
			}
		
		
	}
	
}