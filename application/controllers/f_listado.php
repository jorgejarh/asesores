<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class F_listado extends CI_Controller {

	public $datos_user=array();

	public $carpeta_view="f_listado";

	public $modelo_usar="f_listado_model";

	public $nombre_controlador="f_listado";
	
	public $nombre_titulo="Listado";
	
	public $campos=array();
	
	
	public function set_campo($nombre_campo,$nombre_mostrar,$reglas="",$tipo_elemento="text",$datos_select=array())
	{
		$this->campos[]=array(
								'nombre_campo'=>$nombre_campo,
								'nombre_mostrar'=>$nombre_mostrar,
								'reglas'=>$reglas,
								'tipo_elemento'=>$tipo_elemento,
								'datos_select'=>$datos_select
								);
	}
	
	function __construct()
    {
        parent::__construct();
        $this->datos_user=comprobar_login();
        $model=$this->modelo_usar;
		$this->load->model($model);
		$this->load->model("cooperativa_model");
		$this->load->model("mante_cargos_model");
		$this->load->model("pl_capacitaciones_model");
		$this->load->model("pl_modulos_model");
		
		$this->set_campo("dui","DUI",'required|xss_clean');
		$this->set_campo("nombres","Nombres",'required|xss_clean');
		$this->set_campo("apellidos","Apellidos",'required|xss_clean');
		$this->set_campo("id_cooperativa","Cooperativa",'required|xss_clean','select',preparar_select($this->cooperativa_model->obtener_cooperativa(),'id_cooperativa','cooperativa'));
		$this->set_campo("id_sucursal","Sucursal",'xss_clean','select',array('0'=>'Ninguna'));
		$this->set_campo("id_cargo","Cargo",'required|xss_clean','select',preparar_select($this->mante_cargos_model->obtener(),'id_cargo','nombre_cargo'));

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
		echo "<p>Seleccione el modulo a inscribir</p>";
		$model=$this->modelo_usar;
		$listado=preparar_select($this->$model->obtener_modulos($this->input->post('id_capacitacion')),'id_modulo','nombre_modulo');
		/*$listado[0]=".: Seleccione:.";
		  ksort($listado);*/
		echo form_dropdown('',$listado,0,'id="id_modulo"');
		echo '<div><button onclick="inscribir_modulo();">Inscribir a este modulo</button></div>';
	}
	
	public function listado($id_modulo=0)
	{
		$model=$this->modelo_usar;
		
		$data['modulo']=$this->pl_modulos_model->obtener($id_modulo);
		
		if($data['modulo'])
		{
			$data['capacitacion']=$this->pl_capacitaciones_model->obtener($data['modulo']['id_capacitacion']);
			$data['mensaje']="";
			$data['title']="Listado del modulo ".$data['modulo']['nombre_modulo'];
			$data['template']="sistema";
			$data['contenido']=$this->carpeta_view."/listado";
			$data['nombres_personas']=$this->$model->obtener_personas($data['modulo']['id_capacitacion'],$id_modulo,1);
			
			$data['model']=$model;
			$this->load->view('template',$data);
			
		}else{
			
			redirect(site_url());
			}
		
		
	}
	
}