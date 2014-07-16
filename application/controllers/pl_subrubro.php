<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Pl_subrubro extends CI_Controller {

	public $datos_user=array();

	public $carpeta_view="pl_subrubro";

	public $modelo_usar="pl_subrubro_model";

	public $nombre_controlador="pl_subrubro";
	
	public $nombre_titulo="Detalle - Rubros";
	
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
		$this->load->model('pl_rubro_model');
		
		$this->set_campo("nombre","Nombre",'required|xss_clean');
		$this->set_campo("dias","Dias",'required|xss_clean');
		$this->set_campo("unidades","Unidades",'required|integer|xss_clean');
		$this->set_campo("costo","Costo por unidad",'numeric|xss_clean');
		$this->set_campo("dias_reales","Dias Reales",'xss_clean');
		$this->set_campo("unidades_reales","Unidades Reales",'integer|xss_clean');
		$this->set_campo("costo_real","Costo por unidad Reales",'required|numeric|xss_clean');
		
    }

	public function index($id_rubro=0)
	{
		$data['rubro']=$this->pl_rubro_model->obtener($id_rubro);
		if($data['rubro'])
		{
			$model=$this->modelo_usar;
			$data['title']=$this->nombre_titulo;
			$data['template']="sistema";
			$data['contenido']=$this->carpeta_view."/lista";
			$data['listado']=$this->$model->lista($id_rubro);
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
		$data['n_participantes'] = $this->$model->obtener_n_participantes( $id );
		$data['capacitacion']=$this->$model->obtener_modulo($id);
		$data['dias']=ver_dias($data['capacitacion']['fecha_prevista'],$data['capacitacion']['fecha_prevista_fin']);
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
			//$data['curriculas']=preparar_select($this->$model->obtener_curriculas(),'id_curricula','curricula');
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
	
	function select_curricula($id=0)
	{
		$model=$this->modelo_usar;
		$post=$this->input->post();
		if($post)
		{
			$json=array();

			$lista=preparar_select($this->$model->obtener_perfiles($post['id']),'id_perfil','perfil');
			$lista[0]="-Seleccione-";
			ksort($lista);
			$json['html']=form_dropdown('',$lista,$id,'id="perfiles_select"');

			echo json_encode($json);
		}
			
	}
	
	function select_perfil($id=0)
	{
		$model=$this->modelo_usar;
		$post=$this->input->post();
		if($post)
		{
			$json=array();

			$lista=preparar_select($this->$model->obtener_contenidos($post['id']),'nombre','nombre');
			
			foreach($lista as $key=>$valor)
			{
				$lista[$key]=cortar_texto($valor,40);
				
			}
			$lista[""]="-Seleccione-";
			ksort($lista);
			$json['html']=form_dropdown('id_contenido',$lista,$id,' id="id_contenido"');

			echo json_encode($json);
		}
			
	}
	
	

}