<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class abonos_cooperativas extends CI_Controller {

	public $datos_user=array();

	public $carpeta_view="abonos_cooperativas";

	public $modelo_usar="abonos_cooperativas_model";

	public $nombre_controlador="abonos_cooperativas";
	
	public $nombre_titulo="Abonos de cooperativas";
	
	public $campos=array();
	
	
	public function set_campo($nombre_campo, $nombre_mostrar, $reglas="", $tipo_input, $datos_select=array())
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
		$this->load->model('cooperativa_model');
		$model=$this->modelo_usar;
		$data=array();
		$data['title']=$this->nombre_titulo." - Nuevo";
		$data['cooperativas']=preparar_select( $this->cooperativa_model->obtener_cooperativa(),'id_cooperativa','cooperativa');
		
		$this->load->view($this->carpeta_view.'/form_nuevo',$data);
	}
	
	public function insertar()
	{
		$model=$this->modelo_usar;
		$post=$this->input->post();
		
		
		if($post)
		{
			$json=array();
			
			$this->form_validation->set_rules("id_cooperativa","cooperativa",'required|xss_clean');
			$this->form_validation->set_rules("id_capacitacion","tema",'required|xss_clean');
			$this->form_validation->set_rules("abono","abono",'required|numeric|xss_clean');


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
		$this->load->model('cooperativa_model');
		$model=$this->modelo_usar;
		$data['model']=$model;			
		$data['dato']=$this->$model->obtener($id);
		$data['cooperativas']=preparar_select( $this->cooperativa_model->obtener_cooperativa(),'id_cooperativa','cooperativa');
		
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
			
			$this->form_validation->set_rules("id_cooperativa","cooperativa",'required|xss_clean');
			$this->form_validation->set_rules("id_capacitacion","tema",'required|xss_clean');
			$this->form_validation->set_rules("abono","abono",'required|numeric|xss_clean');
			
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


	function select_cooperativas($id=0)
	{
		$model=$this->modelo_usar;
		$post=$this->input->post();
		if($post)
		{
			$json=array();

			$lista=preparar_select($this->$model->obtener_temas( $post['id'] ),'id_capacitacion','nombre_capacitacion');
			$lista['']="-Seleccione-";
			ksort($lista);
			$json['html']=form_dropdown('id_capacitacion',$lista,$id,'id="select_modalidades"');

			echo json_encode($json);
		}
			
	}

}