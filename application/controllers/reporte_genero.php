<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Reporte_genero extends CI_Controller {

	public $datos_user=array();

	public $carpeta_view="reporte_genero";

	public $modelo_usar="reporte_genero_model";

	public $nombre_controlador="reporte_genero";
	
	public $nombre_titulo="Reporte Por Genero";
	
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
		$listado[0]="Todas";
		  ksort($listado);
		echo form_dropdown('',$listado,0,'id="id_plan_modalidad"');
	}
	
	
	public function obtener_capacitaciones()
	{
		echo "<p>Seleccione un tema</p>";
		$model=$this->modelo_usar;
		$listado=preparar_select($this->$model->obtener_capacitaciones($this->input->post('id_plan_modalidad')),'id_capacitacion','nombre_capacitacion');
		$listado[0]="Todas";
		  ksort($listado);
		echo form_dropdown('',$listado,0,'id="id_capacitacion"');
	}
	
	
	public function obtener_modulos()
	{
		echo '<p style="display:none;">Seleccione el modulo</p>';
		$model=$this->modelo_usar;
		$listado=preparar_select($this->$model->obtener_modulos($this->input->post('id_capacitacion')),'id_modulo','nombre_modulo');
		$listado[0]="Todas";
		 ksort($listado);
		echo form_dropdown('',$listado,0,'id="id_modulo" style="display:none;"');
		
	}
	
	public function obtener_grafico()
	{
		$json=array();
		$model=$this->modelo_usar;
		$post=$this->input->post();
		if($post)
		{
			$json=$this->$model->obtener_m_y_f($post['id_plan'],$post['id_plan_modalidad'],$post['id_capacitacion'],$post['id_modulo']);
			echo json_encode($json);
		}
		
	}
	
	
}