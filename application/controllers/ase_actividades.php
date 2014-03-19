<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Ase_actividades extends CI_Controller {

	public $datos_user=array();

	public $carpeta_view="ase_actividades";

	public $modelo_usar="ase_actividades_model";

	public $nombre_controlador="ase_actividades";
	
	public $nombre_titulo="Actividades ";
	
	public $campos=array();
	
	public function set_campo($nombre_campo,$nombre_mostrar,$reglas="",$tipo_elemento="text",$datos_select=array(),$clases='')
	{
		$this->campos[]=array(
								'nombre_campo'=>$nombre_campo,
								'nombre_mostrar'=>$nombre_mostrar,
								'reglas'=>$reglas,
								'tipo_elemento'=>$tipo_elemento,
								'datos_select'=>$datos_select,
								'clases'=>$clases
								);
	}
	
	function __construct()
    {
        parent::__construct();
        $this->datos_user=comprobar_login();
        $model=$this->modelo_usar;
		$this->load->model($model);
		$this->load->model("ase_servicios_model");
		$this->load->model("ase_proyectos_model");
		$this->set_campo("nombre_actividad","Nombre de la Actividad",'required|xss_clean');
		$this->set_campo("fecha_inicio","Fecha Inicio",'required|xss_clean','text',array(),'fecha__');
		$this->set_campo("fecha_fin","Fecha Fin",'required|xss_clean','text',array(),'fecha__');
		$this->set_campo("resultado_esperado","Producto Esperado",'required|xss_clean','textarea');
    }

	public function index($id=0)
	{
		$data['dato']=$this->ase_proyectos_model->obtener($id);
		if($data['dato'])
		{
			$model=$this->modelo_usar;
			$data['title']=$this->nombre_titulo."de ".$data['dato']['nombre_proyecto'];
			$data['template']="sistema";
			$data['contenido']=$this->carpeta_view."/lista";
			$data['listado']=$this->$model->lista($id);
			$data['model']=$model;
			$this->load->view('template',$data);
		}else{
			redirect('ase_servicios');
			}
	}
	
	public function nuevo($id=0)
	{
		$model=$this->modelo_usar;
		$data=array();
		$data['title']=$this->nombre_titulo." - Nuevo";
		$data['id']=$id;
		$this->load->view($this->carpeta_view.'/form_nuevo',$data);
	}
	
	public function insertar()
	{
		$model=$this->modelo_usar;
		$post=$this->input->post();
		if($post)
		{
			$json=array();
			foreach($this->campos as $llave=>$valor)		
			{
				$this->form_validation->set_rules($valor['nombre_campo'], $valor['nombre_mostrar'], $valor['reglas']);
			}
			if($this->form_validation->run()==TRUE)
			{
				$resultado=$this->$model->nuevo($post);
				$json['error']=false;
			}else{
				$json['error']=true;
				$json['mensaje']=traer_errores_form();
			}
			echo json_encode($json);
		}
	}
	public function editar($id=0)
	{
		$model=$this->modelo_usar;
		$data['model']=$model;			
		$data['dato']=$this->$model->obtener($id);
		if($data['dato'])
		{
			$data['title']=$this->nombre_titulo." - Editar";
			$this->load->view($this->carpeta_view.'/form_editar',$data);
		}else{
			redirect($this->nombre_controlador);
		}
	}
	public function actualizar()
	{
		$post=$this->input->post();
		$model=$this->modelo_usar;
		if($post)
		{
			$id=$post['id'];
			unset($post['id']);		
			$json=array();
			foreach($this->campos as $llave=>$valor)		
			{
				$this->form_validation->set_rules($valor['nombre_campo'], $valor['nombre_mostrar'], $valor['reglas']);
			}
			if($this->form_validation->run()==TRUE)
			{
				$resultado=$this->$model->actualizar($post,$id);
				$json['error']=false;
			}else{

				$json['error']=true;
				$json['mensaje']=traer_errores_form();
			}
			echo json_encode($json);
		}
	}
	
	public function eliminar()
	{
		$model=$this->modelo_usar;
		$post=$this->input->post();
		if ($post)
		{
			$id=$post['id'];
			unset($post['id']);
			$resultado= $this->$model->eliminar($id,$post);
		}
	}	
}