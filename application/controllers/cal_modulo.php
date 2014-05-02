<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Cal_modulo extends CI_Controller {

	public $datos_user=array();

	public $carpeta_view="cal_modulo";

	public $modelo_usar="cal_modulo_model";

	public $nombre_controlador="cal_modulo";
	
	public $nombre_titulo="Calificar Modulo";
	
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
		$this->load->model("cooperativa_model");
		$this->load->model("mante_cargos_model");
		
		$this->set_campo("dui","DUI",'required|xss_clean');
		$this->set_campo("nombres","Nombres",'required|xss_clean');
		$this->set_campo("apellidos","Apellidos",'required|xss_clean');
		$this->set_campo("id_cooperativa","Cooperativa",'required|xss_clean','select',preparar_select($this->cooperativa_model->obtener_cooperativa(),'id_cooperativa','cooperativa'));
		$this->set_campo("id_sucursal","Sucursal",'xss_clean','select',array('0'=>'Ninguna'));
		$this->set_campo("id_cargo","Cargo",'required|xss_clean','select',preparar_select($this->mante_cargos_model->obtener(),'id_cargo','nombre_cargo'));

    }

	public function index()
	{
		$model=$this->modelo_usar;
		$data['title']=$this->nombre_titulo;
		$data['template']="sistema";
		$data['contenido']=$this->carpeta_view."/lista";
		$data['listado']=preparar_select($this->$model->obtener_planes(),'id_plan','nombre_plan');
		$data['model']=$model;
		$this->load->view('template',$data);

	}
	
	
	public function obtener_modalidades()
	{
		echo "<p>Seleccione una modalidad</p>";
		$model=$this->modelo_usar;
		$listado=preparar_select($this->$model->obtener_modalidades($this->input->post('id_plan')),'id_plan_modalidad','nombre_modalidad');
		$listado[0]=".: Seleccione:.";
		  ksort($listado);
		echo form_dropdown('',$listado,0,'id="id_plan_modalidad"');
	}
	
	
	public function obtener_capacitaciones()
	{
		echo "<p>Seleccione un tema</p>";
		$model=$this->modelo_usar;
		$listado=preparar_select($this->$model->obtener_capacitaciones($this->input->post('id_plan_modalidad')),'id_capacitacion','nombre_capacitacion');
		$listado[0]=".: Seleccione:.";
		  ksort($listado);
		echo form_dropdown('',$listado,0,'id="id_capacitacion"');
	}
	
	
	public function obtener_modulos()
	{
		echo "<p>Seleccione el modulo a inscribir</p>";
		$model=$this->modelo_usar;
		$listado=preparar_select($this->$model->obtener_modulos($this->input->post('id_capacitacion')),'id_modulo','nombre_modulo');
		/*$listado[0]=".: Seleccione:.";
		  ksort($listado);*/
		echo form_dropdown('',$listado,0,'id="id_modulo"');
		echo '<div><button onclick="inscribir_modulo();">Seleccionar modulo</button></div>';
	}
	
	public function inscribir_modulo($id_modulo=0)
	{
		$model=$this->modelo_usar;
		$this->load->model('mante_resultados_model');
		$this->load->model('mante_aspectos_model');
		$data['modulo']=$this->$model->obtener_modulo($id_modulo);
		
		if($data['modulo'])
		{
						
			$data['title']="Calificaion del modulo ".$data['modulo']['nombre_modulo'];
			$data['template']="sistema";
			$data['contenido']=$this->carpeta_view."/inscribir_modulo";
			
			$data['resultados']=$this->mante_resultados_model->obtener();
			foreach($data['resultados'] as $key=>$val)
			{
				$data['resultados'][$key]['aspectos']=$this->mante_aspectos_model->lista($val['id_mante_cat_resultado']);
				foreach($data['resultados'][$key]['aspectos'] as $key_3=>$val_3)
				{
					
					$data['resultados'][$key]['aspectos'][$key_3]['nota_aspecto']=$this->$model->obtener_suma_modulo_aspecto($id_modulo,$val_3["id_aspectos_considerar"]);
				}
			}
			
			$data['model']=$model;
			$this->load->view('template',$data);
			
		}else{
			
			redirect(site_url());
			}
		
		
	}
	
	public function nueva_persona($id_capacitacion=0,$id_modulo=0)
	{
		$this->load->model('pl_planes_model');
		$model=$this->modelo_usar;
		$data=array();
		$data['title']=$this->nombre_titulo." - Nuevo";
		$data['id']=$id_capacitacion;
		$data['id_modulo']=$id_modulo;
		$this->load->view($this->carpeta_view.'/form_nuevo',$data);
	}
	
	public function sucursales($id_cooperativa=0)
	{
		$lista=array();
		$lista[0]="Ninguna";
		$sucursales=$this->cooperativa_model->obtener_sucursales_x_cooperativas($id_cooperativa);
		
		foreach($sucursales as $indice=>$valor)
		{
			$lista[$valor['id_sucursal']]=$valor["sucursal"];
		}
		foreach($lista as $key=>$val)
		{
			echo '<option value="'.$key.'">'.$val.'</option>';
		}
	}
	
	public function insertar($id_modulo=0)
	{
		$model=$this->modelo_usar;
		$post=$this->input->post();
		
		
		if($post)
		{
			unset($post['a']);
			$json=array();
			
			$this->load->model("inscripcion_temas_model");
			
			$inscripcion_tema=$this->inscripcion_temas_model->obtener_inscripcion($post);
			
			$post['id_inscripcion_tema']=$inscripcion_tema['id_inscripcion_tema'];
			unset($post['id_cooperativa']);
			$id_capacitacion=$post['id_capacitacion'];
			unset($post['id_capacitacion']);			
			$inscrito=$this->$model->validar_inscrito($post['dui'],$post['id_inscripcion_tema']);
			
			if(!$inscrito)
			{
				foreach($this->campos as $llave=>$valor)		
				{
					$this->form_validation->set_rules($valor['nombre_campo'], $valor['nombre_mostrar'], $valor['reglas']);
				}
				
				if($this->form_validation->run()==TRUE)
				{
					
					//$json['mensaje']=print_r($post,true);
					$this->load->model("inscripcion_temas_personas_model");
					
					$resultado=$this->inscripcion_temas_personas_model->nuevo($post);
					
					$inscripcion_persona=$this->inscripcion_temas_personas_model->obtener($resultado);
					
					$data['nombres_personas']=$this->$model->obtener_personas($id_capacitacion,$id_modulo);
					
					$json['datos']=$this->$model->obtener_una_persona($inscripcion_persona['id_inscripcion_personas'],$id_capacitacion);
					
					$json['error']=false;
	
	
				}else{
	
					$json['error']=true;
					$json['mensaje']=traer_errores_form();
				}
			}else{
				
				$json['error']=true;
				$json['mensaje']='<div class="warning" class="info_div"><span class="ico_error">La persona con DUI '.$post['dui'].' ya esta inscrita</dv>';
				
				}
			
			echo json_encode($json);

		}
	}
	
	public function calificar($id_modulo=0)
	{
		$this->load->model('mante_resultados_model');
		$this->load->model('mante_aspectos_model');
		$model=$this->modelo_usar;
		$data=array();
		$data['title']="Calificar Modulo";
		$data['resultados']=$this->mante_resultados_model->obtener();
		foreach($data['resultados'] as $key=>$val)
		{
			$data['resultados'][$key]['aspectos']=$this->mante_aspectos_model->lista($val['id_mante_cat_resultado']);
		}
		$data['id_modulo']=$id_modulo;
		$this->load->view($this->carpeta_view.'/calificar',$data);
	}
	
	public function enviar_calificacion()
	{
		$model=$this->modelo_usar;
		$post=$this->input->post();
		
		if($post)
		{
			unset($post['a']);
			$json=array();
			
			$id_modulo=$post["id_modulo"];
			$this->$model->guardar_calificacion($post['calificacion'],$id_modulo);
					
			$json['error']=false;
			echo json_encode($json);

		}
	}
	
	public function ver_resultados($id_modulo=0)
	{
		$data=array();
		$this->load->model("pl_modulos_model");
		$this->load->model("mante_facilitadores_model");
		$this->load->model("mante_resultados_model");
		$this->load->model("mante_aspectos_model");
		$data['modulo']=$this->pl_modulos_model->obtener($id_modulo);
		if($data['modulo'])
		{
			$data['modulo']['nombres_facilitadores']=array();
			foreach($data['modulo']['facilitadores[]'] as $val)
			{
				$data['modulo']['nombres_facilitadores'][]=$this->mante_facilitadores_model->obtener($val);
			}
			
			$data['resultados']=$this->mante_resultados_model->obtener();
			
			foreach($data['resultados'] as $key=>$val)
			{
				$data['resultados'][$key]['aspectos']=$this->mante_aspectos_model->obtener_por_modulo($id_modulo,$val['id_mante_cat_resultado']);
			}
			
			
			$this->load->view($this->carpeta_view.'/ver_resultados',$data);
		}
		
	}
	
}