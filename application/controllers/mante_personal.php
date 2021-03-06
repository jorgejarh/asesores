<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Mante_personal extends CI_Controller {

	public $datos_user=array();

	public $carpeta_view="mante_personal";

	public $modelo_usar="mante_personal_model";

	public $nombre_controlador="mante_personal";
	
	public $nombre_titulo="Personal";
	
	public $campos=array();
	
	
	public function set_campo($nombre_campo,$nombre_mostrar,$reglas="",$tipo_elemento="text",$datos_select=array(),$dato='')
	{
		$this->campos[]=array(
								'nombre_campo'=>$nombre_campo,
								'nombre_mostrar'=>$nombre_mostrar,
								'reglas'=>$reglas,
								'tipo_elemento'=>$tipo_elemento,
								'datos_select'=>$datos_select,
								'dato'=>$dato
								);
	}
	
	function __construct()
    {
        parent::__construct();
        $this->datos_user=comprobar_login();
        $model=$this->modelo_usar;
		$this->load->model($model);
		$this->load->model('inscripcion_temas_personas_model');
		$this->set_campo("id_cooperativa","Cooperativa",'required|xss_clean','select',preparar_select($this->$model->obtener_cooperativas($this->datos_user['info_s']),'id_cooperativa','cooperativa'));
		$this->set_campo("dui","DUI",'required|xss_clean');
		$this->set_campo("nombres","Nombres",'required|xss_clean');
		$this->set_campo("apellidos","Apellidos",'required|xss_clean');
		$this->set_campo("correo","Correo",'valid_email|xss_clean');
		//$this->set_campo("id_sucursal","Sucursal",'required|xss_clean','select',preparar_select($this->inscripcion_temas_personas_model->obtener_sucursales($this->datos_user['info_s']),'id_sucursal','sucursal'));
		$this->set_campo("id_sucursal","Sucursal",'required|xss_clean','select',array());
		$this->set_campo("id_cargo","Cargo",'required|xss_clean','select',preparar_select($this->inscripcion_temas_personas_model->obtener_cargos(),'id_cargo','nombre_cargo'));
		$this->set_campo("genero","Genero",'required|xss_clean','select',array('M'=>'Masculino','F'=>'Femenino'));

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
			
			$this->set_campo("dui","DUI",'required|is_unique[mante_personal.dui]|xss_clean');
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
			
			$this->set_campo("dui","DUI",'required|xss_clean');
			
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
	
	public function obtener_sucursales()
	{
		$post=$this->input->post();
		if($post)
		{
			$model=$this->modelo_usar;
			$sucursales=$this->$model->obtener_sucursales($post['id_cooperativa']);
			$html="";
			foreach($sucursales as $valor)
			{
				$html.= '<option value="'.$valor['id_sucursal'].'">'.$valor['sucursal'].'</option>';
			}
			echo $html;
		}
	}
	
}