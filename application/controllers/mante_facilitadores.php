<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Mante_facilitadores extends CI_Controller {

	public $datos_user=array();

	public $carpeta_view="Mante_facilitadores";

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
		$this->set_campo("telefono","Tel. Casa",'required|xss_clean', 'text');
		$this->set_campo("t_oficina","Tel. Oficina",'xss_clean', 'text');
		$this->set_campo("celular","Tel. Celular",'required|xss_clean', 'text');
		$this->set_campo("correo","Email",'xss_clean|valid_email', 'text');
		$this->set_campo("id_tipo_facilitador", 'Tipo', 'required|xss_clean', 'select');

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
		$data['listado_facilitadores'] = $this->mante_tipos_facilitadores_model->obtener();
		
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
			$data['listado_facilitadores'] = $this->mante_tipos_facilitadores_model->obtener();
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