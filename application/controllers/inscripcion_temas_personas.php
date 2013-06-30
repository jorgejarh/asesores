<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Inscripcion_temas_personas extends CI_Controller {

	public $datos_user=array();

	public $carpeta_view="inscripcion_temas_personas";

	public $modelo_usar="inscripcion_temas_personas_model";

	public $nombre_controlador="inscripcion_temas_personas";
	
	public $nombre_titulo="Inscribir personas al tema";
	
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
		
		$this->set_campo("nombres","Nombres",'required|xss_clean');
		$this->set_campo("apellidos","Apellidos",'required|xss_clean');
		$this->set_campo("id_sucursal","Sucursal",'required|xss_clean','select',preparar_select($this->$model->obtener_sucursales($this->datos_user['info_s']),'id_sucursal','sucursal'));
		$this->set_campo("id_cargo","Cargo",'required|xss_clean','select',preparar_select($this->$model->obtener_cargos(),'id_cargo','nombre_cargo'));
		
    }

	public function index($id="")
	{
		$id=iddecode($id);
		
		if(is_numeric($id))
		{
			$model=$this->modelo_usar;
			$data['inscripcion']=$this->$model->obtener_inscripcion($id);
			$data['listado']=$this->$model->lista($id);
			
			$data['title']=$this->nombre_titulo;
			$data['template']="sistema";
			$data['contenido']=$this->carpeta_view."/lista";
			
			$data['model']=$model;
			$this->load->view('template',$data);
		}else{
			redirect('inscripcion_temas');
			}
		
		
		
	}
	
	public function nuevo($id=0)
	{
		$this->load->model('pl_planes_model');
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
			unset($post['a']);
			$json=array();
			
			foreach($this->campos as $llave=>$valor)		
			{
				$this->form_validation->set_rules($valor['nombre_campo'], $valor['nombre_mostrar'], $valor['reglas']);
			}
			
			
			
			if($this->form_validation->run()==TRUE)
			{
				
				//$json['mensaje']=print_r($post,true);

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
			$this->load->model('pl_planes_model');
			$data['planes']=preparar_select($this->pl_planes_model->obtener(),'id_plan','nombre_plan');
			
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
			unset($post['a']);
			
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