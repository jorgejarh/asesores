<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Pl_capacitaciones_docs extends CI_Controller {

	public $datos_user=array();

	public $carpeta_view="pl_capacitaciones_docs";

	public $modelo_usar="pl_capacitaciones_docs_model";

	public $nombre_controlador="pl_capacitaciones_docs";
	
	public $nombre_titulo="Documentos - ";
	
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
		
    }

	public function index($id_capacitacion)
	{
		$model=$this->modelo_usar;
		$post=$this->input->post();
		$error=array();
		if($post)
		{
			if($post['nombre_doc']!="")
			{
				$config['upload_path'] = './public/archivos_capacitaciones/';
				$config['allowed_types'] = '*';
				$config['max_size'] =7168;
				
				$this->load->library('upload', $config);
				
				if($this->upload->do_upload('archivo_doc'))
				{
					$archivo= $this->upload->data();
					$this->$model->nuevo(array('id_capacitacion'=>$id_capacitacion,'nombre_doc'=>$post['nombre_doc'],'archivo'=>$archivo['orig_name']));
					redirect($this->nombre_controlador.'/index/'.$id_capacitacion);
				}else{
					 $error[]= $this->upload->display_errors('<div>','</div>');
					}
			}else{
				$error[]="<div>EL nombre del archivo es requerido.</div>";
				}
		}
		
		$this->load->model("pl_capacitaciones_model");
		$data["capacitacion"]=$this->pl_capacitaciones_model->obtener($id_capacitacion);
		$data['error']=$error;
		$data['title']=$this->nombre_titulo." ".$data["capacitacion"]['nombre_capacitacion'];
		$data['template']="sistema";
		$data['contenido']=$this->carpeta_view."/lista";
		$data['listado']=$this->$model->obtener($id_capacitacion);
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