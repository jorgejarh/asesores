<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Mante_facilitadores extends CI_Controller {

	public $datos_user=array();

	public $carpeta_view="mante_facilitadores";

	public $modelo_usar="mante_facilitadores_model";

	public $nombre_controlador="mante_facilitadores";
	
	public $nombre_titulo="Gestion de facilitadores";
	
	public $campos=array();
	
	
	public function set_campo($nombre_campo, $nombre_mostrar, $reglas="", $tipo_input)
	{
		$this->campos[]=array(
								'nombre_campo'=>$nombre_campo,
								'nombre_mostrar'=>$nombre_mostrar,
								'reglas'=>$reglas,
								'tipo_input'=>$tipo_input 
								);
	}
	
	function __construct()
    {
        parent::__construct();
        $this->datos_user=comprobar_login();
        $this->load->helper('general_helper');
        $model=$this->modelo_usar;
		$this->load->model($model);
		$this->load->model('mante_tipos_facilitadores_model');
		
		$this->set_campo("nombres","Nombres",'required|xss_clean', 'text');
		$this->set_campo("apellidos","Apellidos",'required|xss_clean', 'text');
		$this->set_campo("direccion","Direccion",'xss_clean', 'textarea');
		$this->set_campo("telefono","Tel. Casa",'callback_validar_telefonos|xss_clean', 'text');
		$this->set_campo("t_oficina","Tel. Oficina",'xss_clean', 'text');
		$this->set_campo("celular","Tel. Celular",'xss_clean', 'text');
		$this->set_campo("correo","Email",'xss_clean|valid_email', 'text');

    }
	
	
	public function validar_telefonos($str)
	{
		$user=comprobar_login();
		
		if (!$str && !$this->input->post('t_oficina') && !$this->input->post('celular'))
		{
			$this->form_validation->set_message('validar_telefonos', 'Debe tener al menos un numero telefonico');
			return FALSE;
		}
		else
		{
			return TRUE;
		}
	}
	
	public function index()
	{
		$model=$this->modelo_usar;
		$data['title']=$this->nombre_titulo;
		$data['template']="sistema";
		$data['contenido']=$this->carpeta_view."/lista";
		$data['listado']=$this->$model->obtener();
		$data['model']=$model;
		$this->load->view('template',$data);

	}
	
	public function nuevo()
	{
		$model=$this->modelo_usar;
		$data=array();
		$data['title']=$this->nombre_titulo." - Nuevo";
		
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
	
	
	public function profesiones($id=0)
	{
		$model=$this->modelo_usar;
		$data['model']=$model;			
		$data['dato']=$this->$model->obtener($id);
		
		if($data['dato'])
		{
			$this->load->model("mante_profesiones_model");
			$data['profesiones']=preparar_select($this->mante_profesiones_model->obtener(),'id_profesion','nombre_profesion');
			$data['profesiones_actuales']=$this->$model->obtener_profesiones($id);
			$data['title']=$this->nombre_titulo." - Asignar Profesiones";
			$this->load->view($this->carpeta_view.'/profesiones',$data);
		}

		
	}
	
	public function actualizar_profesiones()
	{
		$model=$this->modelo_usar;
		$data['model']=$model;			
		$post=$this->input->post();
		if($post)
		{
			$id=$post['id'];
			if(isset($post['id_profesion']))
			{
				$resultado=$this->$model->actualizar_profesiones($post['id_profesion'],$id);
								
			}else{
				$resultado=$this->$model->actualizar_profesiones(array(),$id);
				}
			
		}
		$json['error']=false;
		
		echo json_encode($json);
		
	}
	
	public function especialidades($id=0)
	{
		$model=$this->modelo_usar;
		$data['model']=$model;			
		$data['dato']=$this->$model->obtener($id);
		if($data['dato'])
		{
			$this->load->model("mante_especialidades_model");
			$data['especialidades']=preparar_select($this->mante_especialidades_model->obtener(),'id_especialidad','nombre_especialidad');
			$data['especialidades_actuales']=$this->$model->obtener_especalidades($id);
			$data['title']=$this->nombre_titulo." - Asignar Especialidades";
			$this->load->view($this->carpeta_view.'/especialidades',$data);
		}

		
	}
	
	public function actualizar_especialidades()
	{
		$model=$this->modelo_usar;
		$data['model']=$model;			
		$post=$this->input->post();
		
		if($post)
		{
			$id=$post['id'];
			
			if(isset($post['id_especialidad']))
			{
				
				$resultado=$this->$model->actualizar_especialidades($post['id_especialidad'],$id);
								
			}else{
				$resultado=$this->$model->actualizar_especialidades(array(),$id);
				}
			
		}
		$json['error']=false;
		
		echo json_encode($json);
		
	}

}