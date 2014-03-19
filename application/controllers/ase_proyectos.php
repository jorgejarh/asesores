<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Ase_proyectos extends CI_Controller {

	public $datos_user=array();

	public $carpeta_view="ase_proyectos";

	public $modelo_usar="ase_proyectos_model";

	public $nombre_controlador="ase_proyectos";
	
	public $nombre_titulo="Proyectos ";
	
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
		$this->set_campo("fecha_inicio","Fecha Inicio",'required|xss_clean','text',array(),'fecha__');
		$this->set_campo("nombre_proyecto","Nombre del Proyecto",'required|xss_clean');
		$this->set_campo("cantidad_tiempo_estimado","Cantidad",'is_numeric|required|xss_clean');
		$this->set_campo("nombre_tiempo_estimado","Tiempo",'required|xss_clean','select',array('days'=>'Dia(s)','months'=>'Mes(es)','years'=>'Año(s)'));
		
    }

	public function index($id=0)
	{
		
		$data['dato']=$this->ase_servicios_model->obtener($id);
		
		if($data['dato'])
		{
			$model=$this->modelo_usar;
			$data['title']=$this->nombre_titulo."de ".$data['dato']['nombre_solicitante'];
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
				
				$post['fecha_fin']=date('Y-m-d',strtotime($post['fecha_inicio']." +".$post['cantidad_tiempo_estimado']." ".$post['nombre_tiempo_estimado']));
				
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
				$post['fecha_fin']=date('Y-m-d',strtotime($post['fecha_inicio']." +".$post['cantidad_tiempo_estimado']." ".$post['nombre_tiempo_estimado']));

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
	
	
	public function asignar_tecnico($id=0)
	{
		$model=$this->modelo_usar;
		$data=array();
		$data['title']=$this->nombre_titulo." - Asignar";
		$data['id']=$id;
		$data['facilitadores']=preparar_select($this->$model->obtener_tecnicos(),'id_facilitador','nombre_completo');
		$this->load->view($this->carpeta_view.'/asignar_tecnico',$data);
	}
	
	
	public function ingresar_tecnico()
	{
		$model=$this->modelo_usar;
		$post=$this->input->post();
		
		
		if($post)
		{
			$json=array();
			
			
			$this->form_validation->set_rules('id_facilitador',"Técnico", "required|xss_clean");
			

			if($this->form_validation->run()==TRUE)
			{
				
				$resultado=$this->$model->asignar_tecnico($post);

				$json['error']=false;


			}else{

				$json['error']=true;
				$json['mensaje']=traer_errores_form();
			}


			echo json_encode($json);

		}

	}
	
	function eliminar_tecnico()
	{
		$id=$this->input->post('id');
		if($id)
		{
			$model=$this->modelo_usar;
			$this->$model->eliminar_tecnico($id);
		}
	}
	
}