<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Opinion extends CI_Controller {

	public $datos_user=array();

	public $carpeta_view="opinion";

	public $modelo_usar="opinion_model";

	public $nombre_controlador="opinion";
	
	public $nombre_titulo="Opinion de Participantes";
	
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
		$this->load->model('pl_modulos_model');
		$this->load->model('cal_modulo_model');
		$this->load->model('mante_opiniones_model');
		
		
		$this->set_campo("mas_gusto","Lo que MAS les gusto del evento",'xss_clean','select',preparar_select($this->mante_opiniones_model->obtener(0),'id_opinion','nombre_opinion'));
		$this->set_campo("menos_gusto","Lo que MENOS les gusto del evento",'xss_clean','select',preparar_select($this->mante_opiniones_model->obtener(0),'id_opinion','nombre_opinion'));
		$this->set_campo("sugerencia","Sugerencia",'xss_clean','select',preparar_select($this->mante_opiniones_model->obtener(0),'id_opinion','nombre_opinion'));
		$this->set_campo("areas_capacitado","Areas que le gustaria ser Capacitado",'xss_clean','select',preparar_select($this->mante_opiniones_model->obtener(0),'id_opinion','nombre_opinion'));
		
    }

	public function index($id_modulo=0)
	{
		
		$data['modulo']=$this->pl_modulos_model->obtener($id_modulo);
		if($data['modulo'])
		{
			$model=$this->modelo_usar;
			$data['title']=$this->nombre_titulo;
			$data['template']="sistema";
			$data['contenido']=$this->carpeta_view."/lista";
			$data['listado']=$this->$model->lista($id_modulo);
			$data['model']=$model;
			$this->load->view('template',$data);
		}else{
			
			redirect('portal');
			}
		

	}
	
	public function nuevo($id=0)
	{
		$model=$this->modelo_usar;
		$data=array();
		$data['title']=$this->nombre_titulo." - Nuevo";
		$data['id']=$id;
		
		$this->set_campo("id_calificacion","Nº de Calificacion",'required|xss_clean','select',
									preparar_select(
											$this->cal_modulo_model->obtener_lista($id),"numero","numero"));
		
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
			$this->set_campo("id_calificacion","Nº de Calificacion",'required|xss_clean','select',
									preparar_select(
											$this->cal_modulo_model->obtener_lista($data['dato']['id_modulo']),"numero","numero"));
											
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