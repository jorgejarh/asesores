<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Inscripcion_temas extends CI_Controller {

	public $datos_user=array();

	public $carpeta_view="inscripcion_temas";

	public $modelo_usar="inscripcion_temas_model";

	public $nombre_controlador="inscripcion_temas";
	
	public $nombre_titulo="Inscripcion a temas";
	
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
		$this->load->model('pl_modalidades_model');
		$this->load->model('pl_capacitaciones_model');
		
		$this->set_campo("n_personas","Nº de Personas",'required|xss_clean');
		
    }

	public function index()
	{
		
		$model=$this->modelo_usar;
		$data['title']=$this->nombre_titulo;
		$data['template']="sistema";
		$data['contenido']=$this->carpeta_view."/lista";
		$data['listado']=$this->$model->lista($this->datos_user['id_usuario']);
		$data['model']=$model;
		$this->load->view('template',$data);
		
	}
	
	public function nuevo()
	{
		$this->load->model('pl_planes_model');
		$model=$this->modelo_usar;
		$data=array();
		$data['title']=$this->nombre_titulo." - Nuevo";
		$data['planes']=preparar_select($this->pl_planes_model->obtener(),'id_plan','nombre_plan');
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
		/*echo "<pre>";
		print_r($data['dato']);
		echo "</pre>";
		exit();*/
		if($data['dato'])
		{
			$data['curriculas']=preparar_select($this->$model->obtener_curriculas(),'id_curricula','curricula');
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
	
	function select_planes($id=0)
	{
		$model=$this->modelo_usar;
		$post=$this->input->post();
		if($post)
		{
			$json=array();

			$lista=preparar_select($this->pl_modalidades_model->lista($post['id']),'id_plan_modalidad','nombre_modalidad');
			$lista[0]="-Seleccione-";
			ksort($lista);
			$json['html']=form_dropdown('',$lista,$id,'id="select_modalidades"');

			echo json_encode($json);
		}
			
	}
	
	function select_modalidades($id=0)
	{
		$model=$this->modelo_usar;
		$post=$this->input->post();
		if($post)
		{
			$json=array();

			$lista=preparar_select($this->pl_capacitaciones_model->lista($post['id']),'id_capacitacion','nombre_suma');
			
			/*foreach($lista as $key=>$valor)
			{
				$lista[$key]=cortar_texto($valor,40);
				
			}*/
			$lista[""]="-Seleccione-";
			ksort($lista);
			$json['html']=form_dropdown('id_capacitacion',$lista,'',' id="id_contenido"');

			echo json_encode($json);
		}
			
	}
	


}