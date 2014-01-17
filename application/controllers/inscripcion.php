<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Inscripcion extends CI_Controller {

	public $datos_user=array();

	public $carpeta_view="inscripcion";

	public $modelo_usar="inscripcion_model";

	public $nombre_controlador="inscripcion";
	
	public $nombre_titulo="Inscripcion";
	
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
		
		$this->set_campo("dui","DUI",'required|xss_clean');
		$this->set_campo("nombres","Nombres",'required|xss_clean');
		$this->set_campo("apellidos","Apellidos",'required|xss_clean');
		$this->set_campo("id_sucursal","Sucursal",'required|xss_clean','select',preparar_select($this->$model->obtener_sucursales($this->datos_user['info_s']),'id_sucursal','sucursal'));
		$this->set_campo("id_cargo","Cargo",'required|xss_clean','select',preparar_select($this->$model->obtener_cargos(),'id_cargo','nombre_cargo'));

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
	
	public function nueva_persona()
	{
		$this->load->model('pl_planes_model');
		$model=$this->modelo_usar;
		$data=array();
		$data['title']=$this->nombre_titulo." - Nuevo";
		$data['id']=$id;
		$this->load->view($this->carpeta_view.'/form_nuevo',$data);
	}
	
}