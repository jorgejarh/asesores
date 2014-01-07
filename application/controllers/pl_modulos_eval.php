<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Pl_modulos_eval extends CI_Controller {

	public $datos_user=array();

	public $carpeta_view="pl_modulos_eval";

	public $modelo_usar="pl_modulos_eval_model";

	public $nombre_controlador="pl_modulos_eval";
	
	public $nombre_titulo="Evaluaciones";
	
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
		$this->load->model('mante_tipos_evaluacion_model');
		
		$this->set_campo("id_tipo_evaluacion","Tipo Evaluación",'required|xss_clean|callback_validar_evaluacion_existente','select',preparar_select($this->mante_tipos_evaluacion_model->obtener(),'id_tipo_evaluacion','nombre_tipo_evaluacion'));
		$this->set_campo("porcentaje","Porcentaje",'required|numeric|xss_clean|callback_validar_porcentaje');
		
		
    }
	
	public function validar_porcentaje($str)
	{
		$model=$this->modelo_usar;
		$suma_porcentaje=$this->$model->obtener_sum_porcentaje($this->input->post("id_modulo"));
		
		if($this->input->post('id'))
		{
			
			$data['dato']=$this->$model->obtener($this->input->post('id'));
			$suma_porcentaje=$suma_porcentaje-$data['dato']['porcentaje'];
		}
		
		if(($suma_porcentaje+$str)>100 || $str==0)
		{
			$this->form_validation->set_message('validar_porcentaje', 'La suma del %s no debe pasar del 100%');
			return FALSE;
		}else{
			return TRUE;
			}
	}
	
	public function validar_evaluacion_existente($str)
	{
		$model=$this->modelo_usar;
		if($this->input->post('id'))
		{
			$existe=$this->$model->validar_existente_editar($str,$this->input->post("id_modulo"),$this->input->post('id'));
		}else{
			$existe=$this->$model->validar_existente($str,$this->input->post("id_modulo"));
			}
		
		if($existe)
		{
			$this->form_validation->set_message('validar_evaluacion_existente', 'Este tipo de evaluacion ya existe');
			return FALSE;
		}else{
			return TRUE;
			}
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